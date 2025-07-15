import { useForm } from "@inertiajs/vue3"
import { useStore } from "@nanostores/vue"
import { atom } from "nanostores"
import { route } from "ziggy-js"

export class PageStore {
    private static instance: PageStore | null

    public readonly $inProgress = atom<boolean>(false)

    public readonly $graphDone = atom<boolean>(false)

    public readonly $status = atom<string>("")

    public readonly $requiredInputs = atom<boolean>(false)

    public readonly $allImages = atom<string[]>([])

    public readonly $newPage = useForm({
        url: "",
        title: "",
        tag_id: "",
        icon: "",
    })

    public setTage(tagId: string) {
        this.$newPage.tag_id = tagId
    }

    public static get(): PageStore {
        if (!PageStore.instance) {
            PageStore.instance = new PageStore()
        }

        return PageStore.instance
    }

    private requiredInputs() {
        fetch(route(`sear-xng`, { name: this.$newPage.url })).then(async (response) => {
            const json: { images: string[] } = await response.json()

            this.$allImages.set(json.images ?? [])
            this.$inProgress.set(false)
            this.$requiredInputs.set(true)
        })
    }

    public setPageIcon(url: string) {
        this.$newPage.icon = url
    }

    public async openGraph() {
        const pageUrl = this.$newPage.url

        this.$inProgress.set(true)

        try {
            const response = await fetch(route(`open-graph`, { url: pageUrl }))

            if (response.status === 404) {
                this.requiredInputs()

                return
            }

            const json: {
                title: string
                image?: string
            } = await response.json()

            if (!json.title && !json.image) {
                this.requiredInputs()
                return
            }

            this.$newPage.title = json.title ?? ""
            this.$newPage.icon = json.image ?? "resources/assets/404_retro.png"

            setTimeout(() => {
                this.$inProgress.set(false)
                this.$graphDone.set(true)
            }, 750)
        } catch {
            this.requiredInputs()

            this.$inProgress.set(false)
            this.$requiredInputs.set(true)
        }
    }

    public async resetState(value?: string) {
        this.$newPage.title = ""
        this.$newPage.icon = ""
        this.$newPage.url = value ?? ""
        this.$graphDone.set(false)
        this.$requiredInputs.set(false)
        this.$newPage.clearErrors()
        this.$status.set("")
    }

    public async savePage() {
        this.$newPage.post(route("create-page"), {
            onSuccess: (args) => {
                this.$status.set("success")
            },
            onError: () => {
                this.$status.set("failed")
            },
        })
    }

    private constructor() {}
}

export function usePage() {
    const store = PageStore.get()
    const inProgress = useStore(store.$inProgress)
    const graphDone = useStore(store.$graphDone)
    const status = useStore(store.$status)
    const requiredInputs = useStore(store.$requiredInputs)
    const allImages = useStore(store.$allImages)

    return {
        status,
        store,
        newPageForm: store.$newPage,
        inProgress,
        graphDone,
        requiredInputs,
        allImages,
    }
}
