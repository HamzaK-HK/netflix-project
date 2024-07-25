<script setup>
import { useRoute } from 'vue-router';
import Home from './Pages/Home.vue';

const route = useRoute();


</script>

<template>
    <h1>
    <!-- <Home /> -->
        <router-view/>
    </h1>
</template>
