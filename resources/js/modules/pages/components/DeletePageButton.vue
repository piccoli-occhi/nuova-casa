<template>
    <p-modal
        ref="editModal"
        dark
    >
        <span slot="title">
            <div class="for__title">{{ props.page.title }}</div>
        </span>
        <span slot="sub-title">Confirm delete page</span>
        <span slot="text">Are you sure ?</span>
        <p-button
            type="success"
            @click="editModal.close()"
            :disabled="isRemoving"
        >
            No, I keep it
        </p-button>
        &nbsp;
        <p-button
            type="danger"
            @click="removePage()"
            :disabled="isRemoving"
        >
            <span>Yes, I remove it</span>
        </p-button>
    </p-modal>
    <p-button
        @click="editModal.open()"
        type="danger"
        dark
    >
        <p-icon 
            size="20" 
            icon="trash"
            color="white"
        ></p-icon>
    </p-button>
</template>

<script
    lang="ts"
    setup
>
import { router } from "@inertiajs/vue3"
import { ref } from "vue"
import { route } from "ziggy-js"
import { Page } from "@/modules/domain/Types"

const props = defineProps<{ page: Page }>()
const emit = defineEmits(["remove"])
const editModal = ref<HTMLElement | null>(null)
const isRemoving = ref<boolean>(false)

function removePage() {
    const handler = document.querySelector("p-notification-handler")

    router.delete(route("delete-page", { id: props.page.id }), {
        onSuccess: () => {
            if (handler) {
                handler.pushNotification({
                    type: "success",
                    canclose: true,
                    text: "Page was removed !",
                    timeout: 4000,
                })
            }
        },
        onError: (errors) => {
            if (handler) {
                handler.pushNotification({
                    type: "danger",
                    canclose: true,
                    text: "Failed to remove page",
                    timeout: 4000,
                })
            }
        },
    })
}
</script>

<style scoped>
    .for__title {
        display: block;
        white-space: nowrap;
        max-width: 400px;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: 20px;
    }
</style>