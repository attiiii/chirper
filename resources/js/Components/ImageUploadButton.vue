<script setup>
import { watch } from 'vue';

const props = defineProps({
    modelValue: {
        required: false
    }
});

watch(() => props.modelValue, (file) => {
    if (!file) {
        // inputにFileオブジェクトをバインドできないため、削除時は直接DOMの値を変更
        document.querySelector('input').value = null;
    }
})
</script>

<template>
    <button type="button" class="w-8 h-8 bg-gray-200 hover:bg-gray-300 text-grey-darkest rounded-full flex justify-center items-center cursor-pointer" @click="$refs.target.click()">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
    </button>
    <input ref="target" type="file" class="hidden" @input="$emit('update:modelValue', $event.target.files[0])" />
</template>
