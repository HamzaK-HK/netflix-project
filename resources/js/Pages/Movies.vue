<script setup>
// import { Head } from '@inertiajs/vue3';
import HomeNav from '@/Components/HomeNav.vue';
import HomeVideos from '@/Components/HomeVideos.vue';
import HomePlayButton from '@/Components/HomePlayButton.vue';
import HomeContent from '@/Components/HomeContent.vue';
import MovieVideos from '../Components/MovieVideos.vue';
import MoviesContent from '../Components/MoviesContent.vue';


</script>


<template>
       <div>
        <MovieVideos class="bg-black bg-opacity-30 w-full h-screen">
            <HomeNav />
            <HomePlayButton />

        </MovieVideos>
        <div class="bg-[#141414] w-full h-screen ">
            <MoviesContent />
        </div>
    </div>
</template>
