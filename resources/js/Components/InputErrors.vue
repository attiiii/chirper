<script setup>
import InputError from '@/Components/InputError.vue';

defineProps(['errors']);
</script>

<template>
    <div v-show="errors">
        <template v-for="(error, index) in errors" :key="'error-' + index">
            <InputError :message="error" />
        </template>
    </div>
</template>
