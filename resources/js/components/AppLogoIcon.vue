<template>
    <p-leaf dark>
        <img
            :src="logo"
            alt="logo"
        />
    </p-leaf>
</template>

<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import logo from '../../assets/casa-logo.webp'

defineOptions({
    inheritAttrs: false,
})

interface Props {
    className?: HTMLAttributes["class"]
}

defineProps<Props>()
</script>
