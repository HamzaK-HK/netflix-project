<script setup>
import ExploreAllContent from '@/Components/ExploreAllContent.vue';
import ChevronRight from 'vue-material-design-icons/ChevronRight.vue';
import { ref } from 'vue';

const showOverlay = ref(false);


</script>

<template>
    <div>
        <button @click="showOverlay = true" class="group">
            <h1 class="text-xl text-gray-200"><slot /></h1>
        </button>
        <button @click="showOverlay = true" class="group">
            <h1
                class="text-sm font-bold text-[#36b7f3] hover:shadow-2xl flex items-center opacity-0 transform -translate-x-10 delay-500 duration-500 ease-in-out group-hover:opacity-100 group-hover:translate-x-2"
            >
                EXPLORE ALL <ChevronRight :size="18" />
            </h1>
        </button>
        <ExploreAllContent v-if="showOverlay" @close="showOverlay = false" />
    </div>
</template>
