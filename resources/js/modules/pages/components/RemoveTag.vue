<template>
    <p-button
        type="danger"
        dark
        @click="deleteTagModal.open()"
    >
        remove page
    </p-button>
    <p-modal ref="deleteTagModal">
        <div slot="title">
            Are you sure ?
        </div>
        <div slot="text">
            This tag and its all pages will be removed.
        </div>
        <div class="modal__footer">
            <p-button
                @click="deleteTagModal.close()"
            >Cancel</p-button>
            <p-button
                type="danger"
                @click="removeTag()"
            >
                Yes, delete <b>{{ props.tag.name }}</b>
            </p-button>
        </div>
    </p-modal>
</template>

<script lang="ts" setup>
import { router } from "@inertiajs/vue3"
import { ref } from "vue"
import { route } from "ziggy-js"
import { Tag } from "@/modules/domain/Types"

const deleteTagModal = ref<HTMLElement | null>(null)
const props = defineProps<{
    tag: Tag
}>()

function removeTag() {
    const handler = document.querySelector("p-notification-handler")

    router.delete(route("delete-tag", { id: props.tag.id }), {
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
        onError: () => {
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
    .modal__footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }
</style>
