<template>
    <Head :title="t('search.title')" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="search-result">
            <div class="search-result__list" v-if="props.pages.length > 0">
                <p-leaf>
                    <h2>{{ t('search.foundPages', { count: props.pages.length }) }}</h2>
                </p-leaf>
                <PageCard
                    v-for="item in props.pages"
                    :page="item"
                    :key="item.title"
                />
            </div>
            <!--  -->
            <div class="search-result__list" v-if="props.tags.length > 0">
                <p-leaf>
                    <h2>{{ t('search.foundTags', { count: props.tags.length }) }}</h2>
                </p-leaf>
                <TagCard
                    v-for="item in props.tags"
                    :tag="item"
                    :key="item.name"
                />
            </div>
            <!--  -->
            <div
                class="search-result__list"
                v-if="props.newsletters.length > 0"
            >
                <p-leaf>
                    <h2>{{ t('search.foundNewsletters', { count: props.newsletters.length }) }}</h2>
                </p-leaf>
                <RssCard
                    v-for="item in props.newsletters"
                    :rss="item"
                    :key="item.name"
                />
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3"
import { useI18n } from "vue-i18n"
import AppLayout from "@/layouts/AppLayout.vue"
import { Newsletter, Page, Tag } from "@/modules/domain/Types"
import RssCard from "@/modules/newsletters/components/RssCard.vue"
import PageCard from "@/modules/pages/components/PageCard.vue"
import TagCard from "@/modules/tags/components/TagCard.vue"
import { type BreadcrumbItem } from "@/types"

const props = defineProps<{
    pages: Page[]
    tags: Tag[]
    newsletters: Newsletter[]
}>()

const { t } = useI18n()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t("search.title"),
        href: "/search",
    },
]
</script>

<style scoped>
.search-result {
    display: flex;
    justify-content: start;
    gap: 40px;

    h2 {
        margin-bottom: 10px;
    }
}
</style>
