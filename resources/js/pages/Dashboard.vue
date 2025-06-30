<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-pages">
            <PageCard 
                v-for="page in props.pages"
                :key="page.id"
                :page="page"
            />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3"
import { onMounted } from "vue"
import AppLayout from "@/layouts/AppLayout.vue"
import { Page } from "@/modules/domain/Types"
import PageCard from "@/modules/pages/components/PageCard.vue"
import { type BreadcrumbItem } from "@/types"
import PlaceholderPattern from "../components/PlaceholderPattern.vue"

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

<style scoped>
    .casa-pages {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
</style>