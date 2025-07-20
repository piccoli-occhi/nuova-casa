<template>

    <Head title="tags" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <WhenVisible data="news">
            <template #fallback>
                <div class="casa-news__loading">
                    <p-spinner
                        color="var(--secondary-text)"
                        large
                        dark
                    ></p-spinner>
                </div>
            </template>

            <div class="casa-news__head">
                <p-leaf>
                    <h3>
                        {{ props.news.length }} newsletter(s)
                    </h3>
                </p-leaf>
                <AddNewsletter />
            </div>

            <div class="casa-news__list">
                <masonry-wall
                    :items="props.news"
                    :column-width="300"
                    :min-columns="3"
                    :max-columns="5"
                    :gap="16"
                >
                    <template #default="{item}">
                        <RssCard
                            :rss="item"
                            :key="item.id"
                        />
                    </template>
                </masonry-wall>
            </div>
        </WhenVisible>
    </AppLayout>
</template>

<script
    setup
    lang="ts"
>
import { Head, WhenVisible } from "@inertiajs/vue3"
import AppLayout from "@/layouts/AppLayout.vue"
import { Newsletter } from "@/modules/domain/Types"
import AddNewsletter from "@/modules/newsletters/components/AddNewsletter.vue"
import RssCard from "@/modules/newsletters/components/RssCard.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    news?: Newsletter[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Newsletters",
        href: "/newsletters",
    },
]
</script>

<style scoped>
    .casa-news__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .casa-news__loading {
        text-align: center;
    }
</style>