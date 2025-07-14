<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <masonry-wall
            :items="props.pages"
            :column-width="330"
            :max-columns="3"
            :gap="16"
        >
            <template #default="{item}">
                <PageCard
                    :page="item"
                    :key="item.title"
                />
            </template>
        </masonry-wall>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3"
import { onMounted } from "vue"
import AppLayout from "@/layouts/AppLayout.vue"
import { Page } from "@/modules/domain/Types"
import PageCard from "@/modules/pages/components/PageCard.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    pages: Page[]
}>()
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/dashboard",
    },
]

onMounted(() => {})
</script>
