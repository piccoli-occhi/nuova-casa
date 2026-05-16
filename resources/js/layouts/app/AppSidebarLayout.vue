<template>
    <div class="app-sidebar-layout">
        <p-sidebar
            title="Nuova Casa"
            logo="https://raw.githubusercontent.com/amiceli/papierjs/refs/heads/main/src/assets/papierjs.webp"
            :user.prop="sidebarUser"
        >
            <p-sidebar-item
                v-for="item in mainNavItems"
                :key="item.href"
                :icon="item.icon"
                :url="item.href"
                :active="item.href === page.url"
            >
                {{ item.title }}
            </p-sidebar-item>
        </p-sidebar>
        <main class="app-sidebar-layout__content">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import AppSidebarHeader from "@/components/AppSidebarHeader.vue"
import type { BreadcrumbItemType, User } from "@/types"
import { usePage } from "@inertiajs/vue3"
import { computed } from "vue"
import { useI18n } from "vue-i18n"

interface NavItem {
    title: string
    href: string
    icon: string
}

interface Props {
    breadcrumbs?: BreadcrumbItemType[]
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
})

const page = usePage()
const authUser = page.props.auth.user as User
const { t } = useI18n()

const sidebarUser = {
    name: authUser.name,
    email: authUser.email,
    photo: authUser.avatar ?? "",
}

const mainNavItems = computed<NavItem[]>(() => [
    { title: t("nav.dashboard"), href: "/dashboard", icon: "home" },
    { title: t("nav.tags"), href: "/tags", icon: "bookmark" },
    { title: t("nav.newsletters"), href: "/newsletters", icon: "mail" },
])
</script>

<style scoped>
.app-sidebar-layout {
    display: grid;
    grid-template-columns: auto 1fr;
    height: 100vh;
    width: 100%;
    overflow: hidden;
}

.app-sidebar-layout > p-sidebar {
    height: 100vh;
    align-self: stretch;
}

.app-sidebar-layout__content {
    height: 100vh;
    overflow-y: auto;
    padding: 20px;
}
</style>
