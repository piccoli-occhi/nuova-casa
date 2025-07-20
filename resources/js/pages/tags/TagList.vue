<template>

    <Head title="tags" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-tags__head">
            <p-leaf>
                <h3>
                    {{ props.tags.length }} tag(s)
                </h3>
            </p-leaf>
            <AddTagButton />
        </div>
        <div class="casa-tags__list">
            <masonry-wall
                :items="props.tags"
                :column-width="300"
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
import AppLayout from "@/layouts/AppLayout.vue"
import { Page, Tag } from "@/modules/domain/Types"
import AddTagButton from "@/modules/tags/components/AddTagButton.vue"
import TagCard from "@/modules/tags/components/TagCard.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    tags: Tag[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Tags",
        href: "/tags",
    },
]
</script>

<style scoped>
    .casa-tags__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
</style>