<script setup>
import { computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const props = defineProps({
    to: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const route = useRoute();

const isActive = computed(() => {
    return props.to === route.path || props.active;
});

const classes = computed(() =>
    isActive.value
        ? 'inline-flex items-center px-1 pt-1 pb-1 text-m font-bold cursor-default leading-5 text-gray-100 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-gray-400  focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <router-link :to="to" :class="classes">
        <slot />
    </router-link>
</template>

