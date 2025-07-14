<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile settings" />
        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <p-leaf dark>
                    <img
                        :src="user.avatar"
                        class="border"
                        style="width: 100px"
                    />
                </p-leaf>
                <p-input-text
                    label="Nae"
                    :value="user.name"
                    disabled
                    block
                    dark
                ></p-input-text>
                <p-input-text
                    label="Email"
                    :value="user.email"
                    disabled
                    block
                    dark
                ></p-input-text>
            </div>
            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, Link, useForm, usePage } from "@inertiajs/vue3"

import DeleteUser from "@/components/DeleteUser.vue"
import AppLayout from "@/layouts/AppLayout.vue"
import SettingsLayout from "@/layouts/settings/Layout.vue"
import { type BreadcrumbItem, type User } from "@/types"

interface Props {
    mustVerifyEmail: boolean
    status?: string
}

defineProps<Props>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Profile",
        href: "/settings/profile",
    },
]

const page = usePage()
const user = page.props.auth.user as User
</script>
