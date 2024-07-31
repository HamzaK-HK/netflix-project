<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
// import { Head } from "@inertiajs/vue3";
import HomeNav from "@/Components/HomeNav.vue";
import HomeVideos from "@/Components/HomeVideos.vue";
import HomePlayButton from "@/Components/HomePlayButton.vue";
import HomeContent from "@/Components/HomeContent.vue";


</script>

<template>
    <div>
        <Head title="Admin" />
        <HomeVideos class="bg-black bg-opacity-30">
                <HomeNav />
                <HomePlayButton />
        </HomeVideos>
        <div class="bg-[#141414]  w-full">
            <HomeContent

            />
        </div>
    </div>
</template>

<style>
body {
    background-color: #000000;
}

</style>
