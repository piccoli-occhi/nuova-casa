<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <p-alert
            v-if="props.pages.length === 0"
        >
            <div class="dashboard__empty">
                <span>
                    Your tag list is empty
                </span>
                <AddTagButton :light="true">
                    Create new
                </AddTagButton>
            </div>
        </p-alert>
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
import AppLayout from "@/layouts/AppLayout.vue"
import { Page } from "@/modules/domain/Types"
import PageCard from "@/modules/pages/components/PageCard.vue"
import { type BreadcrumbItem } from "@/types"
import AddTagButton from "@/modules/tags/components/AddTagButton.vue"

const props = defineProps<{
    pages: Page[]
}>()
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Dashboard",
        href: "/dashboard",
    },
]
</script>

<style scoped>
    p-alert {
        max-width: 500px;
    }

    .dashboard__empty {
        display: grid;
        grid-template-columns: 1fr auto;
        gap : 15px;
        align-items: center;
    }
</style>
