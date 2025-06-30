import { useStore } from "@nanostores/vue"
import { TagStore } from "../stores/TagStore"

export function useTag() {
    const tagStore = TagStore.get()
    const inProgress = useStore(tagStore.$inProgress)
    const status = useStore(tagStore.$status)
    const searDone = useStore(tagStore.$searDone)
    const allImages = useStore(tagStore.$allImages)
    const allColors = useStore(tagStore.$allColors)

    return {
        allColors,
        status,
        tagStore,
        newTagForm: tagStore.newTag,
        inProgress,
        searDone,
        allImages,
    }
}
