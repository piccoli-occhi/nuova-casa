import { useForm } from "@inertiajs/vue3"
import { atom } from "nanostores"
import { route } from "ziggy-js"

export class TagStore {
    private static instance: TagStore | null

    public readonly $inProgress = atom<boolean>(false)

    public readonly $searDone = atom<boolean>(false)

    public readonly $status = atom<string>("")

    public readonly $allImages = atom<string[]>([])

    public readonly newTag = useForm({
        name: "",
        icon: "",
    })

    public static get(): TagStore {
        if (!TagStore.instance) {
            TagStore.instance = new TagStore()
        }

        return TagStore.instance
    }

    public setTagIcon(url: string) {
        this.newTag.icon = url
    }

    public async saveTag() {
        this.newTag.post(route("create-tag"), {
            onSuccess: (args) => {
                this.$status.set("success")
            },
            onError: (args) => {
                console.error(`action=save_tag, status=failed, reason=${args}`)
                this.$status.set("failed")
            },
        })
    }

    public async searchIcon() {
        const tagName = this.newTag.name

        if (!tagName) {
            this.newTag.errors.name = "Name is required"
            return
        }

        this.$inProgress.set(true)
        const response = await fetch(route(`sear-xng`, { name: tagName }))
        const json: { images: string[] } = await response.json()

        this.$allImages.set(json.images ?? [])

        setTimeout(() => {
            this.$inProgress.set(false)
            this.$searDone.set(true)
        }, 750)
    }

    public async resetState(defaultName?: string) {
        this.newTag.icon = ""
        this.newTag.name = defaultName ?? ""
        this.newTag.clearErrors()

        this.$searDone.set(false)
        this.$status.set("")
    }

    public async savePage() {
        this.newTag.post(route("create-tag"), {
            onSuccess: (args) => {
                this.$status.set("success")
            },
            onError: (args) => {
                this.$status.set("failed")
            },
        })
    }

    private constructor() {}
}
