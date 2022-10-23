<script setup>
import CautionButton from '@/Components/CautionButton.vue';
import Modal from '@/Components/Modal.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';

const props = defineProps(['open', 'onClose', 'onConfirm', 'onReject', 'title', 'buttonText']);

const onClickCancel = () => {
    props.onClose();

    if (typeof props.onReject !== 'undefined') {
        props.onReject();
    }
};

const onClickConfirm = () => {
    props.onClose();

    if (typeof props.onConfirm !== 'undefined') {
        props.onConfirm();
    }
};
</script>

<template>
    <Modal :open="open" :onClose="onClose">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">{{ title }}</h3>
                    <div class="mt-3">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <CautionButton type="button" class="inline-flex w-full justify-center sm:ml-3 sm:w-auto" @click="onClickConfirm">{{ buttonText }}</CautionButton>
            <TertiaryButton type="button" class="inline-flex w-full justify-center sm:w-auto" @click="onClickCancel">Cancel</TertiaryButton>
        </div>
    </Modal>
</template>
