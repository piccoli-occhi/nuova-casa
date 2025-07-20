<template>
    <p-modal ref="newsletterModal">
        <span slot="title">
            Register newsletter (RSS)
        </span>
        <span slot="text">
            <div class="rss__modal">
                <p-input-text
                    label="URL"
                    placeholder="ex : https://jster.net/atom.xml"
                    required
                    block
                    v-model="newNewsletter.url"
                    :disabled="isLoading"
                    :error="newNewsletter.errors.url"
                    @input="store.resetState($event.target.value)"
                ></p-input-text>

                <footer>
                    <p-button @click="newsletterModal.close()">
                        cancel
                    </p-button>
                    <p-button
                        type="secondary"
                        @click="addNews()"
                        :loading="isLoading"
                    >
                        register
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
        Add newsletter
    </p-button>
</template>

<script
    lang="ts"
    setup
>
import { ref, watch } from "vue"
import { useNewsletter } from "../stores/AddNewsletterStore"

const newsletterModal = ref<HTMLElement | null>(null)
const { store, newNewsletter, isLoading, status } = useNewsletter()

function addNews () {
    const overlay = document.querySelector("p-notification-handler")
    store.saveRss()

    const handler = watch(status, (e: string) => {
        if (e === "failed") {
            overlay?.pushNotification({
                type: "danger",
                canclose: true,
                timeout: 4000,
                text: "Something failed",
            })
        }
        if (e === "success") {
            overlay?.pushNotification({
                type: "success",
                canclose: true,
                timeout: 4000,
                text: "New page saved",
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