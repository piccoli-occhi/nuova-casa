<template>
    <p-breadcrumb dark block>
        <p-breadcrumb-item>
            <p-icon icon="home"></p-icon>
        </p-breadcrumb-item>
        <p-breadcrumb-item
            v-for="(item, index) in breadcrumbs"
            :key="index"
            :link="item.href"
        >
            {{ item.title }}
        </p-breadcrumb-item>
    </p-breadcrumb>
</template>

<script setup lang="ts">
interface BreadcrumbItemType {
    title: string
    href?: string
}

defineProps<{
    breadcrumbs: BreadcrumbItemType[]
}>()
</script>

<style scoped>
    p-breadcrumb {
        width: 100%;
    }
</style>
