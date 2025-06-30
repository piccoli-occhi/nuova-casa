<template>
    <p-leaf dark>
        <div class="casa-tag-card border">
            <img :src="props.tag.icon" />
            <div>
                <div class="tag__title">
                    {{ props.tag.name }}
                </div>
                <div>
                    {{ props.tag.children.length }} page(s)
                    <Link :href="route('tag', {id: props.tag.id})">
                        <p-button dark type="secondary">
                            Modifier
                        </p-button>
                    </Link>
                    
                </div>
            </div>
        </div>
    </p-leaf>
</template>

<script
    lang="ts"
    setup
>
import { Link } from "@inertiajs/vue3"
import type { Tag } from "@/modules/domain/Types"

const props = defineProps<{ tag: Tag }>()
</script>

<style scoped>
    .casa-tag-card {
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

    .tag__title {
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

        & + div {
            display: grid;
            grid-template-columns: 1fr auto;
            justify-content: space-between;
            align-items: center;
        }
    }
</style>