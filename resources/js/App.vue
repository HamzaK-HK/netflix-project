<script setup>
import { useRoute } from 'vue-router';
import Home from './Pages/Home.vue';
import HomeNav from './Components/HomeNav.vue';

const route = useRoute();


</script>

<template>
    <h1>
    <!-- <Home /> -->
    <!-- <HomeNav /> -->
        <router-view/>
    </h1>
</template>
