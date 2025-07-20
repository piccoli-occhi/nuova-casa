<template>
    <p-card
        dark
        radius
    >
        <div slot="header">
            {{ props.rss.title }}
        </div>
        <div slot="title">
            <a
                :href="props.rss.lastLink.link"
                target="_blank"
            >
                {{ props.rss.lastLink.title }}
            </a>
        </div>
        <div slot="footer">
            <p-icon icon="calendar"></p-icon>
            &nbsp;
            {{ props.rss.lastLink.date }}
        </div>
    </p-card>
</template>

<script
    lang="ts"
    setup
>
import { Newsletter } from "@/modules/domain/Types"

const props = defineProps<{
    rss: Newsletter
}>()
</script>