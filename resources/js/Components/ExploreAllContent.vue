<script setup>

import Close from "vue-material-design-icons/Close.vue";

const emit = defineEmits(["close"]);

const closeOverlay = () => {
    emit("close");
};
</script>

<template>
    <div class="bg-[#000000] z-10 bg-opacity-60 fixed top-0 right-0 w-full h-screen">
        <div
        class="bg-[#141414] z-50 mx-auto w-[80%] h-full rounded-xl relative overflow-hidden top-6"
        >
        <button class="cursor-pointer">
            <Close
                @click="closeOverlay"
                fillColor="#ffffff"
                :size="32"
                class="cursor-pointer absolute top-6 right-8"
            />
        </button>
            <h1 class="text-[40px] font-sans font-extrabold text-center pt-10 text-white">
                Your Next Watch
            </h1>
        </div>
        <slot />
    </div>
</template>
