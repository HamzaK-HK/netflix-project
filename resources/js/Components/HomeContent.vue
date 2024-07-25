<script setup>
import Images from "@/Components/Images.vue";
import ExploreAllContent from "@/Components/ExploreAllContent.vue";
import ExploreButton from "@/Components/ExploreButton.vue";

import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Navigation } from "vue3-carousel";

import { onMounted, ref } from "vue";
import axios from "axios";

const videos = ref([]);

const currentSlide = ref(0);

// onMounted(async () => {
//     try {
//         const response = await axios.get("/home");
//         console.log(response, "Response");

//         // Add an additional property to determine if a video should show an image
//         videos.value = response.data.map((video) => ({
//             ...video,
//             showImage: false, // default to showing the video
//         }));
//     } catch (error) {
//         console.log("Failed to fetch videos", error);
//     }
// });

const toggleShowImage = (video) => {
    video.showImage = !video.showImage;
};
</script>

<template>
    <div>
        <div class="bg-[#141414] bg-cover relative top-0 left-14">
            <div class="">
                <Carousel
                    v-model="currentSlide"
                    :items-to-show="5"
                    :items-to-scroll="3"
                    class="bg-transparent  pb-4"
                    :wrap-around="500"
                    :transition="500"
                    snapAlign="start"
                    width="300"
                >
                    <Slide v-for="video in videos" :key="video.id" class="">
                        <div class=" relative w-full">
                            <!-- Show video if showImage is false -->
                            <video
                                v-if="!video.showImage"
                                class="w-64 h-36 rounded-sm"
                                autoplay
                                muted
                                loop
                                :ref="'video-' + video.id"
                                @mouseleave="toggleShowImage(video)"
                            >
                                <source
                                    :src="`storage/${video.file}`"
                                    type="video/mp4"
                                />
                                Your browser does not support the video tag.
                            </video>

                            <!-- Show image if showImage is true -->
                            <img
                                v-else
                                :src="`/images/img${video.id}.jpg`"
                                alt="Video thumbnail"
                                class="w-64 h-36 rounded-sm object-cover"
                                @mouseenter="toggleShowImage(video)"
                            />
                        </div>
                    </Slide>
                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </div>
            <!-- <div class="mt-12">
                <ExploreButton class="group">
                    <h1 class="text-xl text-gray-200">My List</h1>
                </ExploreButton>
                <div class="flex gap-3 mt-2">
                    <Images src="/images/img12.jpg" alt="" />
                    <Images src="/images/img13.jpg" alt="" />
                    <Images src="/images/img14.jpg" alt="" />
                </div>
            </div>
            <div class="mt-12">
                <ExploreButton class="group">
                    <h1 class="text-xl text-gray-200">US TV Shows</h1>
                </ExploreButton>
                <div class="flex gap-3 mt-2">
                    <Images src="/images/img6.jpg" alt="" />
                    <Images src="/images/img7.jpg" alt="" />
                    <Images src="/images/img8.jpg" alt="" />
                    <Images src="/images/img9.jpg" alt="" />
                    <Images src="/images/img10.jpg" alt="" />
                    <Images src="/images/img11.jpg" alt="" />
                    <Images src="/images/img12.jpg" alt="" />
                    <Images src="/images/img13.jpg" alt="" />
                </div>
            </div>
            <div class="mt-12">
                <ExploreButton class="group">
                    <h1 class="text-xl text-gray-200">Indian Movies</h1>
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
            </div>
            <div class="mt-12">
                <ExploreButton class="group">
                    <h1 class="text-xl text-gray-200">
                        International TV Shows
                    </h1>
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
            </div>
            <div class="mt-12">
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
        </div>
    </div>
</template>

<style>
.carousel__prev,
.carousel__next,
.carousel_prev:hover,
.carousel_next:hover {
    color: #ffffff;
}
</style>
