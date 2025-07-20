import { useForm } from "@inertiajs/vue3"
import { useStore } from "@nanostores/vue"
import { atom } from "nanostores"
import { route } from "ziggy-js"

export class AddNewsletterStore {
    private static instance: AddNewsletterStore | null

    public readonly $isLoading = atom<boolean>(false)

    public readonly $status = atom<string | null>(null)

    public readonly $newNewsletter = useForm({
        url: "",
        name: "",
    })

    public static get(): AddNewsletterStore {
        if (!AddNewsletterStore.instance) {
            AddNewsletterStore.instance = new AddNewsletterStore()
        }

        return AddNewsletterStore.instance
    }

    public resetState(url: string) {
        this.$newNewsletter.url = url
        this.$newNewsletter.name = ""
    }

    public saveRss() {
        this.$newNewsletter.post(route("create-rss"), {
            onSuccess: (args) => {
                this.$status.set("success")
            },
            onError: (args) => {
                console.error(`action=save_tag, status=failed, reason=${args}`)
                this.$status.set("failed")
            },
        })
    }
}

export function useNewsletter() {
    const store = AddNewsletterStore.get()
    const isLoading = useStore(store.$isLoading)

    return {
        store,
        isLoading,
        newNewsletter: store.$newNewsletter,
    }
}
