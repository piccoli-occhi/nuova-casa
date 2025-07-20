<script setup lang="ts">
import type { HTMLAttributes } from "vue"

defineOptions({
    inheritAttrs: false,
})

interface Props {
    className?: HTMLAttributes["class"]
}

defineProps<Props>()
</script>

<template>
    <p-leaf dark>
        <img
            src="https://casa.volpe.xyz/casa-logo.webp"
            alt="logo"
        />
    </p-leaf>
</template>
