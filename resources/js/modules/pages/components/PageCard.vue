<template>
    <p-card
        :image="props.page.icon.includes('404') ? retroDefault : props.page.icon"
        radius
    >
        <div
            slot="title"
            class="for--title"
        >
            <a
                :href="openPage()"
                target="_blank"
            >
                {{ props.page.title }}
            </a>
        </div>
        <div
            slot="footer"
            v-if="!props.edit"
        >
            <div class="is--flex">
                <p-badge>
                    {{ props.page.parent.name }}
                </p-badge>
            </div>
        </div>
        <div
            class="is--flex"
            slot="footer"
            v-if="edit"
        >
            <p-tooltip
                bottom
                :title="t('pages.changeFavorite')"
            >
                <p-switch
                    round
                    :checked="props.page.favorite"
                    @change="toggleFavorite()"
                ></p-switch>
            </p-tooltip>
            <div>
                <DeletePageButton :page="props.page" />
            </div>
        </div>
    </p-card>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3"
import { useI18n } from "vue-i18n"
import { route } from "ziggy-js"
import { Page } from "@/modules/domain/Types"
import retroDefault from "../../../../assets/404_retro.png"
import DeletePageButton from "./DeletePageButton.vue"

const props = defineProps<{ page: Page; edit?: boolean }>()
const { t } = useI18n()

function openPage() {
    return props.page.url.startsWith("https://") ? props.page.url : `https://${props.page.url}`
}

function toggleFavorite() {
    const handler = document.querySelector("p-notification-handler")

    const form = useForm({
        favorite: !props.page.favorite,
    })

    form.put(route("update-page", { id: props.page.id }), {
        headers: { Accept: "application/json" },
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
    .for--title {
        display: flex;
        align-items: center;
        gap: 20px;

        img {
            max-height: 50px;
        }
    }

    .is--flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
