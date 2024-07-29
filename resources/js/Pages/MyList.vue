<script setup>
// import { Head } from '@inertiajs/vue3';
import HomeNav from "@/Components/HomeNav.vue";
import HomeVideos from "@/Components/HomeVideos.vue";
import HomePlayButton from "@/Components/HomePlayButton.vue";
import HomeContent from "@/Components/HomeContent.vue";
import MovieVideos from "../Components/MovieVideos.vue";
import MoviesContent from "../Components/MoviesContent.vue";
import MyListContent from "@/Components/MyListContent.vue";
</script>

<template>
    <div>
        <div class="bg-[#141414] w-full h-screen">
            <HomeNav />
            <div class="absolute top-24 left-9">
                <h1 class="text-[30px] text-gray-100 font-normal">My List</h1>
            </div>
            <MyListContent class="flex justify-start items-center h-screen ml-[-20px]"/>
        </div>
        <div class="bg-[#141414] w-full h-screen">
        </div>
    </div>
</template>
