<script setup>
// import { Head } from '@inertiajs/vue3';
import HomeNav from '@/Components/HomeNav.vue';
import HomeVideos from '@/Components/HomeVideos.vue';
import HomePlayButton from '@/Components/HomePlayButton.vue';
import HomeContent from '@/Components/HomeContent.vue';


</script>


<template>
    <div>
        <Head title="Movies" />
        <HomeVideos class="bg-black bg-opacity-30 w-full h-screen">
                <HomeNav />
                <HomePlayButton />
        </HomeVideos>
        <div class="bg-[#141414]  absolute">
            <HomeContent

            />
        </div>
    </div>
</template>
