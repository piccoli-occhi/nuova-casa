<template>
    <p-button
        type="danger"
        dark
        @click="deleteTagModal.open()"
    >
        {{ t('tags.remove') }}
    </p-button>
    <p-modal ref="deleteTagModal">
        <div slot="title">
            {{ t('common.areYouSure') }}
        </div>
        <div slot="text">
            {{ t('tags.removeWarn') }}
        </div>
        <div class="modal__footer">
            <p-button
                @click="deleteTagModal.close()"
            >{{ t('common.cancel') }}</p-button>
            <p-button
                type="danger"
                @click="removeTag()"
            >
                {{ t('tags.confirmDelete', { name: props.tag.name }) }}
            </p-button>
        </div>
    </p-modal>
</template>

<script lang="ts" setup>
import { router } from "@inertiajs/vue3"
import { ref } from "vue"
import { useI18n } from "vue-i18n"
import { route } from "ziggy-js"
import { Tag } from "@/modules/domain/Types"

const deleteTagModal = ref<HTMLElement | null>(null)
const props = defineProps<{
    tag: Tag
}>()
const { t } = useI18n()

function removeTag() {
    const handler = document.querySelector("p-notification-handler")

    router.delete(route("delete-tag", { id: props.tag.id }), {
        onSuccess: () => {
            if (handler) {
                handler.pushNotification({
                    type: "success",
                    canclose: true,
                    text: t("pages.removed"),
                    timeout: 4000,
                })
            }
        },
        onError: () => {
            if (handler) {
                handler.pushNotification({
                    type: "danger",
                    canclose: true,
                    text: t("pages.removeFailed"),
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
