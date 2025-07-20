<template>
    <div class="casa-header">
        <div class="casa-header__bread">
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import Breadcrumbs from "@/components/Breadcrumbs.vue"
// import { SidebarTrigger } from '@/components/ui/sidebar';
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
.casa-header__bread {
    display: inline-block;
}
</style>