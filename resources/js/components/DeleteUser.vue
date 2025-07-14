<template>
    <div class="space-y-6">
        <p-leaf>
            <h3>
                <p-icon icon="warning-box"></p-icon>
                Delete account
            </h3>
        </p-leaf>
        <p-alert
            type="danger"
            dark
        >
            <div class="relative space-y-0.5 text-red-600 dark:text-red-100">
                <p class="font-medium">Warning</p>
                <p class="text-sm">Please proceed with caution, this cannot be undone.</p>
            </div>
        </p-alert>
        <p-modal ref="deleteUserModal">
            <div slot="title">
                Are you sure you want to delete your account ?
            </div>
            <div slot="text">
                Once your account is deleted, all of its resources and data will also be permanently
                deleted. Please enter your
                password to confirm you would like to permanently delete your account.
            </div>
            <p-input-text
                block
                label="Confirm"
                placeholder="username / email"
                v-model="form.confirmation"
                :error="form.errors.confirmation"
            ></p-input-text>
            <br>
            <div class="modal__footer">
                <p-button
                    :disabled="form.processing"
                    @click="deleteUserModal.close()"
                >Cancel</p-button>
                <p-button
                    type="danger"
                    @click="deleteUser()"
                    :disabled="form.processing"
                > Delete account </p-button>
            </div>
        </p-modal>
        <p-button
            type="danger"
            dark
            @click="deleteUserModal.open()"
        >
            Delete account
        </p-button>
    </div>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/vue3"
import {ref} from "vue"

const passwordInput = ref<HTMLInputElement | null>(null)
const deleteUserModal = ref<HTMLElement | null>(null)

const form = useForm({
    confirmation: "",
})

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    form.clearErrors()
    form.reset()
}
</script>

<style scoped>
    .modal__footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }
</style>