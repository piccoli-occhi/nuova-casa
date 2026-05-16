<template>
    <p-modal ref="newsletterModal">
        <span slot="title">
            {{ t('newsletters.register') }}
        </span>
        <span slot="text">
            <div class="rss__modal">
                <p-input-text
                    :label="t('pages.url')"
                    :placeholder="t('newsletters.urlPlaceholder')"
                    required
                    block
                    v-model="newNewsletter.url"
                    :disabled="isLoading"
                    :error="newNewsletter.errors.url"
                    @input="store.resetState($event.target.value)"
                ></p-input-text>

                <footer>
                    <p-button @click="newsletterModal.close()">
                        {{ t('common.cancel') }}
                    </p-button>
                    <p-button
                        type="secondary"
                        @click="addNews()"
                        :loading="isLoading"
                    >
                        {{ t('newsletters.registerAction') }}
                    </p-button>
                </footer>
            </div>
        </span>
    </p-modal>
    <p-button
        type="secondary"
        dark
        @click="newsletterModal.open()"
    >
        {{ t('newsletters.add') }}
    </p-button>
</template>

<script
    lang="ts"
    setup
>
import { ref, watch } from "vue"
import { useI18n } from "vue-i18n"
import { useNewsletter } from "../stores/AddNewsletterStore"

const newsletterModal = ref<HTMLElement | null>(null)
const { store, newNewsletter, isLoading, status } = useNewsletter()
const { t } = useI18n()

function addNews() {
    const overlay = document.querySelector("p-notification-handler")
    store.saveRss()

    const handler = watch(status, (e: string) => {
        if (e === "failed") {
            overlay?.pushNotification({
                type: "danger",
                canclose: true,
                timeout: 4000,
                text: t("newsletters.failed"),
            })
        }
        if (e === "success") {
            overlay?.pushNotification({
                type: "success",
                canclose: true,
                timeout: 4000,
                text: t("newsletters.saved"),
            })

            handler.stop()
            newsletterModal.value.close()
        }
    })
}
</script>

<style scoped>
    .rss__modal {
        footer {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    }
</style>