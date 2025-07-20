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
                    @input="tagStore.resetState()"
                ></p-input-text>
                <div
                    v-if="searDone && !inProgress"
                    class="modal__list"
                >
                    <p-leaf
                        v-for="image in allImages"
                        :key="image"
                    >
                        <img
                            :class="{'is--selected': newTagForm.icon === image}"
                            :src="image"
                            @click="tagStore.setTagIcon(image, $event.target)"
                        />
                    </p-leaf>
                </div>
                <p-leaf v-if="allColors.length > 0">
                    Colors
                </p-leaf>
                <div class="modal__colors">
                    <p-leaf v-for="color in allColors">
                        <div
                            :style="{'background': color}"
                            :class="{
                                'is--selected': newTagForm.color === color,
                                border: true
                            }"
                            @click="tagStore.setTagColor(color)"
                        >
                            {{ color }}
                        </div>
                    </p-leaf>
                </div>
            </div>
            <div class="modal__footer">
                <p-button>
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
                    :disabled="!newTagForm.color || !newTagForm.icon"
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
const { newTagForm, tagStore, inProgress, searDone, allImages, status, allColors } = useTag()

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

        .is--selected {
            border-color: var(--success);
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
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 10px;
            gap: 10px;
            height: 240px;
            overflow: scroll;

            img {
                width: 100M;
            }
        }

        .tag__modal {
            min-width: 400px;
        }

        .modal__footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    }
</style>