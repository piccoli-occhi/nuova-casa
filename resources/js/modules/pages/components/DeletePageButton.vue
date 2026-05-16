<template>
    <p-modal ref="editModal">
        <span slot="title">
            <div class="for__title">{{ props.page.title }}</div>
        </span>
        <span slot="sub-title">{{ t('pages.confirmDelete') }}</span>
        <span slot="text">{{ t('common.areYouSure') }}</span>
        <p-button
            type="success"
            @click="editModal.close()"
            :disabled="isRemoving"
        >
            {{ t('pages.keepIt') }}
        </p-button>
        &nbsp;
        <p-button
            type="danger"
            @click="removePage()"
            :disabled="isRemoving"
        >
            <span>{{ t('pages.removeIt') }}</span>
        </p-button>
    </p-modal>
    <p-button
        @click="editModal.open()"
        type="danger"
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
import { useI18n } from "vue-i18n"
import { route } from "ziggy-js"
import { Page } from "@/modules/domain/Types"

const props = defineProps<{ page: Page }>()
const emit = defineEmits(["remove"])
const editModal = ref<HTMLElement | null>(null)
const isRemoving = ref<boolean>(false)
const { t } = useI18n()

function removePage() {
    const handler = document.querySelector("p-notification-handler")

    router.delete(route("delete-page", { id: props.page.id }), {
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
        onError: (errors) => {
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
    .for__title {
        display: block;
        white-space: nowrap;
        max-width: 400px;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: 20px;
    }
</style>