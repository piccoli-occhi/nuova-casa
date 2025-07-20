<template>
    <Head title="tags" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-tags__head">
            <h1>
                {{ props.tags.length }} tag(sd)
            </h1>
            <AddTagButton />
        </div>
        <div class="casa-tags__list">
            <TagCard
                v-for="tag in props.tags"
                :tag="tag"
                :key="tag.name"
            />
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
    }

    .casa-tags__list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
</style>