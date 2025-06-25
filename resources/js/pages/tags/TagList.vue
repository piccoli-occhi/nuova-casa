<template>
    <Head title="tags" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-pages">
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
import AppLayout from "@/layouts/AppLayout.vue"
import { Page, Tag } from "@/modules/domain/Types"
import PageCard from "@/modules/pages/components/PageCard.vue"
import TagCard from "@/modules/tags/components/TagCard.vue"
import { type BreadcrumbItem } from "@/types"
import { Head } from "@inertiajs/vue3"
import { onMounted } from "vue"
import PlaceholderPattern from "../components/PlaceholderPattern.vue"

const props = defineProps<{
    tags: Tag[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Tags",
        href: "/tags",
    },
]

onMounted(() => {})
</script>

<style scoped>
    .casa-pages {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
</style>