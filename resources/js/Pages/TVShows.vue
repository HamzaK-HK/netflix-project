<script setup>
import HomeContent from '@/Components/HomeContent.vue';
import HomePlayButton from '@/Components/HomePlayButton.vue';
import HomeVideos from '@/Components/HomeVideos.vue';
import HomeNav from '@/Components/HomeNav.vue';

import TVShowsContent from '../Components/TVShowsContent.vue';
import TVShowsVideos from '../Components/TVShowsVideos.vue';



</script>

<template>
    <div>
        <TVShowsVideos class="bg-black bg-opacity-30 w-full h-screen">
            <HomeNav />
            <HomePlayButton />

        </TVShowsVideos>
        <div class="bg-[#141414] w-full h-screen ">
            <TVShowsContent />
        </div>
    </div>
</template>


