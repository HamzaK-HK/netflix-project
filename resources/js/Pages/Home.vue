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
        <Head title="Home" />
        <HomeVideos class="bg-black bg-opacity-30 w-full h-screen">
            <HomeNav />
            <HomePlayButton />

        </HomeVideos>
        <div class="bg-[#141414] w-full">
            <HomeContent
            />
        </div>
    </div>
</template>


<!-- <AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">You're logged in!</div>
            </div>
        </div>
    </div>
</AuthenticatedLayout> -->
