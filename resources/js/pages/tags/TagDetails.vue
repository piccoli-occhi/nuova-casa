<template>

    <Head :title="`${props.tag.name}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="casa-tag-details">
            <div class="casa-tag-details__header">
                <p-leaf>
                    <h3>
                        {{ props.tag.name }}
                        -
                        <small>
                            {{ props.tag.children.length }} page(s)
                        </small>
                    </h3>
                </p-leaf>
                <AddPageButton :tag="props.tag" />
                <RemoveTag :tag="props.tag" />
            </div>
            <div class="casa-tag-details__cards">
                <masonry-wall
                    :items="props.tag.children"
                    :column-width="330"
                    :max-columns="3"
                    :gap="16"
                >
                    <template #default="{item}">
                        <PageCard
                            :page="{...item, parent: {...props.tag}}"
                            :key="item.title"
                            edit
                        />
                    </template>
                </masonry-wall>
            </div>
        </div>
    </AppLayout>
</template>

<script
    lang="ts"
    setup
>
import { Head, router, useForm, usePage } from "@inertiajs/vue3"
import AppLayout from "@/layouts/AppLayout.vue"
import { Tag } from "@/modules/domain/Types"
import AddPageButton from "@/modules/pages/components/AddPageButton.vue"
import PageCard from "@/modules/pages/components/PageCard.vue"
import RemoveTag from "@/modules/pages/components/RemoveTag.vue"
import { BreadcrumbItem } from "@/types"

const props = defineProps<{ tag: Tag }>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Tags",
        href: "/tags",
    },
    {
        title: props.tag.name,
        href: "",
    },
]
</script>

<style scoped>
    .casa-tag-details__cards {
        margin-top: 20px;
    }

    .casa-tag-details__header {
        display: grid;
        grid-template-columns: 1fr auto auto;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }
</style>