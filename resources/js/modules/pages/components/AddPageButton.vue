<template>
    <div>
        <p-modal
            ref="addPageModal"
            dark
        >
            <span slot="title">
                Add page - {{ props.tag.name }}
            </span>
            <span slot="text">
                <div class="casa-add-page">
                    <p-input-text
                        label="URL"
                        placeholder="Page link"
                        required
                        block
                        v-model="newPageForm.url"
                        :disabled="inProgress || requiredInputs"
                        :error="newPageForm.errors.url"
                        @input="store.resetState($event.target.value)"
                    ></p-input-text>
                    <p-alert
                        type="warning"
                        v-if="requiredInputs"
                    >
                        OpenGraph failed, need to set it manually.
                    </p-alert>
                    <p-input-text
                        label="Page icon URL"
                        placeholder="Page icon"
                        required
                        block
                        v-model="newPageForm.icon"
                        :disabled="inProgress"
                        :error="newPageForm.errors.icon"
                        v-if="requiredInputs"
                    ></p-input-text>
                    <p-input-text
                        label="Page title"
                        placeholder="Page title"
                        required
                        block
                        v-model="newPageForm.title"
                        :disabled="inProgress"
                        :error="newPageForm.errors.title"
                        v-if="requiredInputs"
                    ></p-input-text>
                    <div v-if="graphDone && !inProgress">
                        <hr />
                        <p-leaf>
                            <img
                                class="casa-add-page__image"
                                :src="newPageForm.icon"
                                v-if="newPageForm.icon"
                            />
                            <img
                                class="casa-add-page__image"
                                :src="retroDefault"
                                v-else
                            />
                        </p-leaf>
                        <p-input-text
                            label="title"
                            block
                            v-model="newPageForm.title"
                            :error="newPageForm.errors.title"
                        ></p-input-text>
                    </div>
                </div>
            </span>
            <div class="casa-add-page__footer">
                <p-button @click="addPageModal.close()">
                    cancel
                </p-button>
                <p-button
                    type="secondary"
                    @click="store.openGraph()"
                    v-if="!graphDone && !requiredInputs"
                    :loading="inProgress"
                >
                    scrap
                </p-button>
                <p-button
                    type="success"
                    @click="store.savePage()"
                    v-else
                >
                    save
                </p-button>
            </div>
        </p-modal>
        <p-button
            dark
            type="primary"
            @click="openModal()"
        >
            cancel
        </p-button>
    </div>
</template>

<script
    lang="ts"
    setup
>
import { onMounted, ref, watch } from "vue"
import { type Tag } from "@/modules/domain/Types"
import retroDefault from "../../../../assets/404_retro.png"
import { usePage } from "../stores/PageStore"

const { store, inProgress, graphDone, newPageForm, status, requiredInputs } = usePage()

const addPageModal = ref<HTMLElement | null>(null)
const props = defineProps<{
    tag: Tag
}>()

onMounted(() => {
    const overlay = document.querySelector("p-notification-handler")
    store.setTage(props.tag.id)

    watch(status, (e: string) => {
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
            addPageModal.value.close()
        }
    })
})

function openModal() {
    store.resetState()
    addPageModal.value.open()
}
</script>

<style scoped>
    .casa-add-page {
        width: 400px;

        p-input-text {
            display: block;
            margin-bottom: 10px;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 15px;
        }
    }

    .casa-add-page__image {
        height: 100px;
    }

    .casa-add-page__footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
</style>
