<script setup>
import { onMounted, onUnmounted, ref, watch } from 'vue';

const imgSrc = ref('');
const reader = new FileReader();

const props = defineProps({
    modelValue: {
        required: false
    }
});

const onLoad = () => {
    imgSrc.value = reader.result;
};

const renderImage = (file) => {
    if (!file) {
        imgSrc.value = '';
    } else {
        reader.readAsDataURL(file);
    }
};

onMounted(() => {
    reader.addEventListener("load", onLoad);
    renderImage(props.modelValue);
});

onUnmounted(() => {
    reader.removeEventListener("load", onLoad);
});

watch(() => props.modelValue, (file) => {
    renderImage(file)
})
</script>

<template>
    <div v-if="imgSrc != ''" class="relative inline-block">
        <img
            :src="imgSrc"
            alt=""
            class="object-cover w-20 h-14 rounded-md"
        />
        <button type="button" class="absolute w-5 h-5 -top-2.5 -right-2.5 inline-flex items-center justify-center text-gray-800 bg-white rounded-full cursor-default" @click="$emit('update:modelValue', null)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</template>
