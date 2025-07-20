<template>
    <div class="casa-header">
        <template v-if="breadcrumbs && breadcrumbs.length > 0">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>
    </div>
</template>

<script setup lang="ts">
import Breadcrumbs from "@/components/Breadcrumbs.vue"
import type { BreadcrumbItemType } from "@/types"

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[]
    }>(),
    {
        breadcrumbs: () => [],
    },
)
</script>

<style scoped>
.casa-header {
    height: 80px;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
</style>
