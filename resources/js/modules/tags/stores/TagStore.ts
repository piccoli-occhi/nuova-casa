import { useForm } from "@inertiajs/vue3"
import { useStore } from "@nanostores/vue"
import ColorThief from "colorthief"
import { atom } from "nanostores"
import { route } from "ziggy-js"

export class TagStore {
    private static instance: TagStore | null

    public readonly $inProgress = atom<boolean>(false)

    public readonly $searDone = atom<boolean>(false)

    public readonly $status = atom<string>("")

    public readonly $allImages = atom<string[]>([])

    public readonly $allColors = atom<string[]>([])

    public readonly newTag = useForm({
        name: "",
        color: "",
        icon: "",
    })

    public static get(): TagStore {
        if (!TagStore.instance) {
            TagStore.instance = new TagStore()
        }

        return TagStore.instance
    }

    public setTagColor(color: string) {
        this.newTag.color = color
    }

    public setTagIcon(icon: string, img: HTMLImageElement) {
        this.newTag.icon = icon
        const thief = new ColorThief()
        const colors: Array<number[]> = thief.getPalette(img, 10)

        this.$allColors.set([
            ...new Set(
                colors.map(([r, g, b]) => {
                    return `rgb(${r}, ${g}, ${b})`
                }),
            ),
        ])
    }

    public async saveTag() {
        this.newTag.post(route("create-tag"), {
            onSuccess: (args) => {
                this.$status.set("success")
            },
            onError: (args) => {
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
        this.newTag.color = ""
        this.newTag.name = defaultName ?? ""
        this.newTag.clearErrors()

        this.$searDone.set(false)
        this.$status.set("")
        this.$allColors.set([])
        this.$allColors.set([])
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
