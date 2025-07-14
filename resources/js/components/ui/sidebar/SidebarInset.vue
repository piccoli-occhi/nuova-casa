<template>
    <main
        data-slot="sidebar-inset"
        :class="cn(
            'main__content relative flex w-full flex-1 flex-col',
            'md:peer-data-[variant=inset]:m-2 md:peer-data-[variant=inset]:ml-0 md:peer-data-[variant=inset]:rounded-xl md:peer-data-[variant=inset]:shadow-sm md:peer-data-[variant=inset]:peer-data-[state=collapsed]:ml-0',
            props.class,
        )"
    >
        <slot />
    </main>
</template>

<script setup lang="ts">
import {cn} from "@/lib/utils"
import type {HTMLAttributes} from "vue"

const props = defineProps<{
    class?: HTMLAttributes["class"]
}>()
</script>

<style scoped>
    .main__content {
        box-sizing: border-box;
        padding-right: 20px;
        padding-left: 20px;
    }
</style>
