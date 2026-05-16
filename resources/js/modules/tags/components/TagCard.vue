<template>
    <p-card :image="props.tag.icon">
        <div
            slot="title"
            class="for--title"
        >
            {{ props.tag.name }}
        </div>
        <div slot="text">
            <p-badge>
                {{ t('tags.pageCount', { count: props.tag.children.length }) }}
            </p-badge>
        </div>
        <div
            class="is--flex"
            slot="footer"
        >
            <Link :href="route('tag', {id: props.tag.id})">
                <p-button
                    type="secondary"
                >
                    {{ t('common.edit') }}
                </p-button>
            </Link>
        </div>
    </p-card>
</template>

<script lang="ts" setup>
import { Link } from "@inertiajs/vue3"
import { useI18n } from "vue-i18n"
import type { Tag } from "@/modules/domain/Types"

const props = defineProps<{ tag: Tag }>()
const { t } = useI18n()
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