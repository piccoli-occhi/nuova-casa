<template>
    <p-leaf dark>
        <div class="casa-page-card border">
            <img
                :src="props.page.icon"
                v-if="!props.page.icon.includes('404')"
            />
            <img
                :src="retroDefault"
                v-else
            >
            <div>
                <div class="card__title">
                    <Link :href="route('read-page', {id: props.page.id})">
                    {{ props.page.title }}
                    </Link>
                </div>
                <div
                    class="card__footer for--edit"
                    v-if="edit"
                >
                    <p-tooltip
                        bottom
                        title="change favorite"
                    >
                        <p-switch
                            round
                            dark
                            :checked="props.page.favorite"
                            @change="toggleFavorite()"
                        ></p-switch>
                    </p-tooltip>
                    <div>
                        <DeletePageButton :page="props.page" />
                    </div>
                </div>
                <div
                    class="card__footer"
                    v-else
                >
                    <p-badge :style="{'--muted': props.page.parent.color}">
                        {{ props.page.parent.name }}
                    </p-badge>
                    <p-badge
                        dark
                        type="secondary"
                    >
                        {{ props.page.readCount }} vue(s)
                    </p-badge>
                </div>
            </div>
        </div>
    </p-leaf>
</template>

<script
    lang="ts"
    setup
>
import { Link, router, useForm } from "@inertiajs/vue3"
import { route } from "ziggy-js"
import { Page } from "@/modules/domain/Types"
import retroDefault from "../../../../assets/404_retro.png"
import DeletePageButton from "./DeletePageButton.vue"

const props = defineProps<{ page: Page; edit?: boolean }>()

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
    .casa-page-card {
        height: 120px;
        width: 400px;
        gap: 20px;
        display: grid;
        grid-template-columns: 96px 1fr;
        padding: 10px;
        box-sizing: border-box;
        background: #1E2023;

        img {
            width: 100%;
            max-height: 100%;
            margin: auto;
        }

        img+div {
            display: grid;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 1fr;
            justify-content: space-between;
        }
    }

    .card__footer {
        display: grid;
        align-items: center;
        gap: 20px;
        box-sizing: border-box;
    }

    .card__footer:not(.for--edit) {
        grid-template-columns: 1fr auto;
        justify-content: space-between;
    }

    .card__footer.for--edit {
        grid-template-columns: 1fr auto;
        justify-content: space-between;
    }

    .card__title {
        overflow: hidden;
        text-overflow: ellipsis;

        a {
            text-decoration: none;
            background-image: unset;
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }
</style>