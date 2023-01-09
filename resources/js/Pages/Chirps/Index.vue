<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputErrors from '@/Components/InputErrors.vue';
import ImageUploadButton from '@/Components/ImageUploadButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import Chirp from '@/Components/Chirp.vue';
import UploadImage from '@/Components/UploadImage.vue';

defineProps(['chirps']);

const form = useForm({
    message: '',
    file: null,
});
</script>

<template>
    <Head title="Chirps" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('chirps.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <UploadImage v-model="form.file" class="mt-5" />
                <InputErrors :errors="form.errors" class="mt-2" />
                <div class="mt-4 flex gap-3 items-center">
                    <PrimaryButton class="flex-none">Chirp</PrimaryButton>
                    <div class="flex-1">
                        <ImageUploadButton v-model="form.file" />
                    </div>
                </div>
            </form>

            <div class="mt-6 bg-white shadow-sm rouded-lg divide-y">
                <Chirp
                    v-for="chirp in chirps"
                    :key="chirp.id"
                    :chirp="chirp"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
