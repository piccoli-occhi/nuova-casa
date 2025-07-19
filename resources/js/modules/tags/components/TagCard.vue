<template>
    <p-card dark radius>
        <div
            slot="title"
            class="for--title"
        >
            <img :src="props.tag.icon" />
            {{ props.tag.name }}
        </div>
        <div
            class="is--flex"
            slot="footer"
        >
            <p-badge>
                {{ props.tag.children.length }} page(s)
            </p-badge>
            <Link :href="route('tag', {id: props.tag.id})">
                <p-button
                    dark
                    type="secondary"
                >
                    Modifier
                </p-button>
            </Link>
        </div>
    </p-card>
</template>

<script lang="ts" setup>
import { Link } from "@inertiajs/vue3"
import type { Tag } from "@/modules/domain/Types"

const props = defineProps<{ tag: Tag }>()
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