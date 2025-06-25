<template>
    <p-notification-handler></p-notification-handler>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/layouts/app/AppSidebarLayout.vue"
import type { BreadcrumbItemType } from "@/types"
import { defineCustomElements } from "@amiceli/papierjs/loader"

defineCustomElements()

interface Props {
    breadcrumbs?: BreadcrumbItemType[]
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
})
</script>
