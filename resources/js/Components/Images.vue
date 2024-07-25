<script setup>
// import { Link } from '@inertiajs/vue3';


defineProps({
    src: String,
    alt: String,
});

</script>

<template>
    <div>
        <Link class="cursor-pointer">
            <img :src="src" :alt="alt" class="w-64 rounded-sm h-36" />
        </Link>
    </div>
</template>
