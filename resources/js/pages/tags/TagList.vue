<template>
    <Head :title="t('tags.title')" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-tags__head">
            <AddTagButton />
        </div>
        <div class="casa-tags__list">
            <masonry-wall
                :items="props.tags"
                :column-width="200"
                :gap="16"
            >
                <template #default="{item}">
                    <TagCard
                        :tag="item"
                        :key="item.name"
                    />
                </template>
            </masonry-wall>
        </div>
    </AppLayout>
</template>

<script
    setup
    lang="ts"
>
import { Head } from "@inertiajs/vue3"
import { useI18n } from "vue-i18n"
import AppLayout from "@/layouts/AppLayout.vue"
import { Page, Tag } from "@/modules/domain/Types"
import AddTagButton from "@/modules/tags/components/AddTagButton.vue"
import TagCard from "@/modules/tags/components/TagCard.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    tags: Tag[]
}>()

const { t } = useI18n()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t("tags.title"),
        href: "/tags",
    },
]
</script>

<style scoped>
    .casa-tags__head {
        margin-bottom: 30px;
    }
</style>