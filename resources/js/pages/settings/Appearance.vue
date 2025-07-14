<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Appearance settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <p-leaf>
                    <h3>Appearance</h3>
                    <small>
                        Update your account's appearance settings
                    </small>
                </p-leaf>
                <br>
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3"

import AppearanceTabs from "@/components/AppearanceTabs.vue"
import AppLayout from "@/layouts/AppLayout.vue"
import SettingsLayout from "@/layouts/settings/Layout.vue"
import { type BreadcrumbItem } from "@/types"

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: "Appearance settings",
        href: "/settings/appearance",
    },
]
</script>
