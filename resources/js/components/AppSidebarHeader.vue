<template>
    <div class="casa-header">
        <template v-if="breadcrumbs.length > 0">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
            <p-input-text
                placeholder="Search tag, page or newsletter"
                icon="search"
                @keydown.enter="submitForm($event.target.value)"
            />
        </template>
    </div>
</template>

<script setup lang="ts">
import Breadcrumbs from "@/components/Breadcrumbs.vue"
import type { BreadcrumbItemType } from "@/types"
import { route } from "ziggy-js";

function submitForm (value: string) {
    window.location.assign(
        route("search", { value })
    )
}

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
    display: grid;
    grid-template-columns: 1fr auto;
    gap : 20px;
    align-items: center;
    margin-bottom: 20px;
}
</style>
