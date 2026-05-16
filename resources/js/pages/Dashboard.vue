<template>
    <Head :title="t('dashboard.title')" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <p-alert
            v-if="props.pages.length === 0"
        >
            <div class="dashboard__empty">
                <span>
                    {{ t('dashboard.empty') }}
                </span>
                <AddTagButton :light="true">
                    {{ t('common.createNew') }}
                </AddTagButton>
            </div>
        </p-alert>
        <masonry-wall
            :items="props.pages"
            :column-width="200"
            :gap="40"
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
import { useI18n } from "vue-i18n"
import AppLayout from "@/layouts/AppLayout.vue"
import { Page } from "@/modules/domain/Types"
import PageCard from "@/modules/pages/components/PageCard.vue"
import AddTagButton from "@/modules/tags/components/AddTagButton.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    pages: Page[]
}>()
const { t } = useI18n()
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t("dashboard.title"),
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
