<template>
    <p-breadcrumb dark>
        <p-breadcrumb-item link="/dashboard">
            Home
        </p-breadcrumb-item>
        <p-breadcrumb-item
            v-for="(item, index) in breadcrumbs"
            :key="index"
            :link="item.href"
        >
            {{ item.title }}
        </p-breadcrumb-item>
    </p-breadcrumb>
    <!-- <Breadcrumb>
        <BreadcrumbList>
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <BreadcrumbItem>
                    <template v-if="index === breadcrumbs.length - 1">
                        <BreadcrumbPage>{{ item.title }}</BreadcrumbPage>
                    </template>
<template v-else>
                        <BreadcrumbLink as-child>
                            <Link :href="item.href ?? '#'">{{ item.title }}</Link>
                        </BreadcrumbLink>
                    </template>
</BreadcrumbItem>
<BreadcrumbSeparator v-if="index !== breadcrumbs.length - 1" />
</template>
</BreadcrumbList>
</Breadcrumb> -->
</template>

<script
    setup
    lang="ts"
>
// TODO Remove
// import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { Link } from "@inertiajs/vue3"

interface BreadcrumbItemType {
    title: string
    href?: string
}

defineProps<{
    breadcrumbs: BreadcrumbItemType[]
}>()
</script>
