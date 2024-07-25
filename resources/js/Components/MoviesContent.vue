<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Navigation } from "vue3-carousel";
import Close from "vue-material-design-icons/Close.vue";

const videos = ref([]);
const showModal = ref(false);
const currentVideo = ref(null);

onMounted(async () => {
    try {
        const response = await axios.get("/getPosts");
        console.log(response.data, "Response");
        videos.value = response.data.map((video) => ({
            ...video,
            showImage: true,
        }));
    } catch (error) {
        console.log("Failed to fetch videos", error);
    }
});

const openModal = (video) => {
    currentVideo.value = video;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    currentVideo.value = null;
};
</script>

<template>
    <div>
        <div class="bg-[#141414] bg-cover relative top-0 ml-14 -mt-1">
            <Carousel
                v-if="videos.length > 0"
                :items-to-show="5"
                :items-to-scroll="3"
                class="bg-transparent pb-4"
                wrap-around
                transition="500"
                snapAlign="start"
                width="300"
            >
                <Slide v-for="video in videos" :key="video.id" class="cursor-pointer">
                    <div class="relative w-full">
                        <video
                            v-if="!video.showImage"
                            class="w-64 h-36 rounded-sm cursor-pointer"
                            muted
                            preload="auto"
                            loop
                            controls
                            @click="openModal(video)"
                        >
                            <source :src="`storage/${video.file}`" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>

                        <img
                            v-else
                            :src="`/images/img${video.id}.jpg`"
                            alt="Video thumbnail"
                            class="w-64 h-36 rounded-sm object-cover cursor-pointer"
                            @click="openModal(video)"
                        />
                    </div>
                </Slide>
                <template #addons>
                    <Navigation />
                </template>
            </Carousel>
        </div>

        <div
            v-if="showModal"
            class=" inset-0 z-10 bg-black bg-opacity-90 flex items-center justify-center fixed"
        >
            <div class="absolute inset-0 top-2 right-10 mb-4 ">
                <video
                    class="w-full mx-auto h-screen block"
                    controls
                    autoplay
                    :src="`storage/${currentVideo.file}`"
                >
                    Your browser does not support the video tag.
                </video>
                <button
                    @click="closeModal"
                    class="absolute top-2 right-2 p-2 rounded hover:bg-gray-700"
                >
                    <Close :size="36" fillColor="#ff2929" />
                </button>
            </div>
        </div>
    </div>
</template>

<style>
.carousel__prev,
.carousel__next {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    transition: transform 0.2s;
}

.carousel__prev:hover,
.carousel__next:hover {
    color: #ffffff;
}
</style>







 <!-- <div class="mt-12">
                <ExploreButton class="group">
                    <h1 class="text-xl text-gray-200">Action Movies</h1>
                </ExploreButton>
                <div class="flex gap-3 mt-2">
                    <Images src="/images/img1.jpg" alt="" />
                    <Images src="/images/img2.jpg" alt="" />
                    <Images src="/images/img3.jpg" alt="" />
                    <Images src="/images/img4.jpg" alt="" />
                    <Images src="/images/img5.jpg" alt="" />
                    <Images src="/images/img1.jpg" alt="" />
                    <Images src="/images/img2.jpg" alt="" />
                    <Images src="/images/img3.jpg" alt="" />
                </div>
            </div> -->
