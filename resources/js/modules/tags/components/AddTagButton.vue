<template>
    <div class="casa-add-tag">
        <p-modal
            ref="addPageModal"
            dark
        >
            <span slot="title">
                Add tag
            </span>
            <div
                slot="text"
                class="tag__modal"
            >
                <p-input-text
                    label="Tag name"
                    placeholder="tag name is unique"
                    required
                    block
                    v-model="newTagForm.name"
                    :disabled="inProgress"
                    :error="newTagForm.errors.name"
                    @input="tagStore.resetState($event.target.value)"
                ></p-input-text>

                <div class="modal__list">
                    <masonry-wall
                        v-if="searDone && !inProgress"
                        :items="allImages"
                        :column-width="200"
                        :min-columns="3"
                        :max-columns="3"
                        :gap="16"
                    >
                        <template #default="{item}">
                            <p-leaf :key="item">
                                <img
                                    :class="{
                                        'not--selected': newTagForm.icon !== item && newTagForm.icon,
                                    }"
                                    :src="item"
                                    @click="tagStore.setTagIcon(item)"
                                />
                            </p-leaf>
                        </template>
                    </masonry-wall>
                </div>
            </div>
            <div class="modal__footer">
                <p-button @click="addPageModal.close()">
                    cancel
                </p-button>
                <p-button
                    type="secondary"
                    @click="!inProgress && tagStore.searchIcon()"
                    :loading="inProgress"
                    v-if="!searDone"
                >
                    next
                    <p-icon icon="next"></p-icon>
                </p-button>
                <p-button
                    type="success"
                    v-else
                    @click="tagStore.saveTag()"
                    :disabled="!newTagForm.icon"
                >
                    save <p-icon icon="save"></p-icon>
                </p-button>
            </div>
        </p-modal>
        <p-button
            type="secondary"
            dark
            @click="openModal()"
        >
            Add tag
        </p-button>
    </div>
</template>

<script
    lang="ts"
    setup
>
import { onMounted, ref, watch } from "vue"
import { useTag } from "../composables/useTag"

const addPageModal = ref<HTMLElement | null>(null)
const { newTagForm, tagStore, inProgress, searDone, allImages, status } = useTag()

function openModal() {
    tagStore.resetState()
    addPageModal.value.open()
}

onMounted(() => {
    const overlay = document.querySelector("p-notification-handler")

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
                text: "New tag created",
            })
            addPageModal.value.close()
        }
    })
})
</script>

<style scoped>
    .casa-add-tag {
        display: inline-block;

        p-button p-icon {
            vertical-align: middle;
        }

        .not--selected {
            opacity: 0.5;
        }

        .modal__colors {
            display: grid;
            grid-template-columns: repeat(3, auto);
            gap: 10px;

            div {
                height: 40px;
                width: 100%;
                text-align: center;

                &:hover {
                    cursor: pointer;
                }
            }
        }

        .modal__list {
            margin-top: 10px;
            max-height: 240px;
            overflow: scroll;
        }

        .tag__modal {
            min-width: 640px;
        }

        .modal__footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    }
</style>