<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

// Import Components and Icons
import Images from "@/Components/Images.vue";
import ExploreAllContent from "@/Components/ExploreAllContent.vue";
import ExploreButton from "@/Components/ExploreButton.vue";
import MyListContent from "@/Components/MyListContent.vue";
import MoviesContent from "@/Components/MoviesContent.vue";
import TVShowsContent from "./TVShowsContent.vue";
import DocumentariesContent from "./DocumentariesContent.vue";
import Close from "vue-material-design-icons/Close.vue";
import ThumbUpOutline from "vue-material-design-icons/ThumbUpOutline.vue";
import Comment from "vue-material-design-icons/Comment.vue";
import PlayCircleOutline from "vue-material-design-icons/PlayCircleOutline.vue";
import PlusCircleOutline from "vue-material-design-icons/PlusCircleOutline.vue";
import ChevronDownCircleOutline from "vue-material-design-icons/ChevronDownCircleOutline.vue";

// Import Carousel Components
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Navigation } from "vue3-carousel";

// Define reactive variables
const videos = ref([]);
const currentSlide = ref(0);
const showModal = ref(false);
const currentVideo = ref(null);
const hoveredVideoId = ref(null); // Track which video is hovered by its ID

// Fetch videos from the API on component mount
onMounted(async () => {
    try {
        const response = await axios.get("/api/getposts");
        console.log(response, "Response");

        // Add an additional property to determine if a video should show an image
        videos.value = response.data.map((video) => ({
            ...video,
            showImage: false, // default to showing the video
        }));
    } catch (error) {
        console.log("Failed to fetch videos", error);
    }
});

// Function to open modal
const openModal = (video) => {
    currentVideo.value = video;
    showModal.value = true;
};

// Function to close modal
const closeModal = () => {
    showModal.value = false;
    currentVideo.value = null;
};

// Function to toggle video image display
const toggleShowImage = (video) => {
    video.showImage = !video.showImage;
};

// Function to handle mouse enter on video
const handleMouseEnter = (videoId) => {
    hoveredVideoId.value = videoId;
};

// Function to handle mouse leave from video
const handleMouseLeave = () => {
    hoveredVideoId.value = null;
};

const addToMyList = async (videoId) => {
    try {
        const response = await axios.post("/api/mylist", { post_id: videoId });
        console.log(response, "added seccessfully");
    } catch (error) {
        console.log("Failed to upload to mylist", error);
    }
};





    const items = ref([
      { image: 'image.jpg', title: 'Item 1' },
      { image: 'image2.jpg', title: 'Item 2' },
      // Add more items as needed
    ]);

    const activeIndex = ref(null);
    // const hoveredVideoId = ref(null);
    const ul = ref(null);

    const handleMouseOver = (index) => {
      activeIndex.value = index;
    };

    const handleMouseOut = () => {
      activeIndex.value = null;
    };

    const hoverStyle = (index) => {
      if (activeIndex.value === index) {
        const scaleFactor = 1.8;
        const wBigElement = 100 / items.value.length * scaleFactor;
        const translation = (wBigElement - 100 / items.value.length) / 2;
        // const item = ul.value.children; // If needed for further calculations

        return {
          transform: `scale(${scaleFactor})`,
        };
      }
      return {
        transform: 'scale(1)',
      };
    };










</script>

<template>
    <div>
        <div class="bg-[#141414] ml-14 h-auto pb-40">
            <div class="">
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
                    <Slide
                        v-for="video in videos"
                        :key="video.id"
                        class="cursor-pointer relative"
                    >
                        <div
                            class="w-full"
                            @mouseenter="handleMouseEnter(video.id)"
                            @mouseleave="handleMouseLeave"
                        >
                            <!-- Video Element -->
                            <video
                                v-if="!video.showImage"
                                class="w-64 h-36 rounded-sm cursor-pointer"
                                muted
                                preload="auto"
                                loop
                                @click="openModal(video)"
                            >
                                <source
                                    :src="`storage/${video.file}`"
                                    type="video/mp4"
                                />
                                Your browser does not support the video tag.
                            </video>

                            <!-- Image Thumbnail -->
                            <img
                                v-else
                                :src="`/images/img${video.id}.jpg`"
                                alt="Video thumbnail"
                                class="w-64 h-36 rounded-sm object-cover cursor-pointer"
                                @click="openModal(video)"
                            />

                            <!-- Hover Icons -->



                            <div>
    <div v-if="hoveredVideoId === video.id" class="absolute top-0 bottom-20 bg-[#141414] z-20 w-full h-screen">
      <div class="flex flex-col justify-center">
        <video
          :class="[
            'w-full h-64 rounded-t-lg rounded-l-lg rounded-r-lg cursor-pointer transition-all duration-300 ease-in-out',
            {
              'transform scale-125': hoveredVideoId === video.id,
            },
          ]"
          muted
          preload="auto"
          loop
          :autoplay="hoveredVideoId === video.id"
          @click="openModal(video)"
        >
          <source :src="`storage/${video.file}`" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
        <div class="flex items-center space-x-3">
          <button class="cursor-pointer">
            <PlayCircleOutline fillColor="#FFFFFF" :size="42" />
          </button>
          <button class="cursor-pointer">
            <ThumbUpOutline fillColor="#FFFFFF" :size="42" />
          </button>
          <button @click="addToMyList(video.id)" class="cursor-pointer">
            <PlusCircleOutline fillColor="#FFFFFF" :size="42" />
          </button>
          <button class="cursor-pointer">
            <ChevronDownCircleOutline fillColor="#FFFFFF" :size="42" />
          </button>
        </div>
      </div>
    </div>

    <!-- <main class="relative block w-screen h-screen p-[4vw] overflow-x-hidden">
      <div class="logo absolute top-0 left-0 w-full h-auto p-[3vw_4vw] bg-[rgba(255,255,255,0.02)]">
        <svg class="relative block w-[10vw]">
          <path class="fill-[#E50914]"></path>
        </svg>
      </div>
      <section class="relative block top-[8vw] mb-[6vw]">
        <h2 class="block w-full text-[1.2vw] font-semibold mb-[.8vw] ml-1">Section Title</h2>
        <ul class="relative block w-full h-auto whitespace-nowrap text-0">
          <li
            v-for="(item, index) in items"
            :key="index"
            @mouseover="handleMouseOver(index)"
            @mouseout="handleMouseOut"
            class="inline-block h-auto p-1 overflow-hidden cursor-pointer transition-all duration-500 ease-[.2s] first:origin-[0_center] last:origin-[100%_center]"
            :class="{ hover: activeIndex === index }"
            :style="hoverStyle(index)"
          >
            <div class="relative block w-full h-0 pt-[56.25%] bg-cover origin-[top_right]">
              <div
                class="absolute top-[-10px] left-[-10px] z-10 w-[calc(100%+20px)] h-[calc(100%+20px)] opacity-0 bg-gradient-to-b from-transparent to-black transition-all duration-500 ease-[.2s]"
                :class="{ 'opacity-100': activeIndex === index }"
              ></div>
              <img
                :src="item.image"
                alt="image"
                class="absolute top-0 left-0 w-full opacity-0 transition-opacity duration-500 ease-[.2s]"
                :class="{ 'opacity-100': activeIndex === index }"
              />
            </div>
            <div
              class="absolute bottom-0 left-0 z-10 w-full h-auto p-2.5 text-shadow-sm opacity-0 transition-opacity duration-500 ease-[.2s]"
              :class="{ 'opacity-100': activeIndex === index }"
            >
              <h3 class="block w-full text-[.7vw] font-semibold mb-[.3vw]">{{ item.title }}</h3>
              <div class="block w-full mb-[.3vw] text-0">
                <span class="inline-block w-auto text-[.5vw] font-semibold mr-[.4vw] text-[#46D369]">Match %</span>
                <span
                  class="inline-block relative w-auto text-[.5vw] p-[0_0.4em] mr-[.4vw] border border-[rgba(255,255,255,0.4)]"
                >
                  Age
                </span>
                <span class="inline-block w-auto text-[.5vw]">Duration</span>
              </div>
              <div class="block w-full">
                <span
                  class="inline-block w-auto text-[.5vw] mr-[.3vw] after:content-['●'] after:inline-block after:ml-[.3vw] after:text-[.8vw] after:text-shadow-sm after:text-[rgba(255,255,255,0.4)]"
                >
                  Tag
                </span>
              </div>
            </div>
          </li>
        </ul>
      </section>
    </main> -->
  </div>




                            <!-- <div
                                v-if="hoveredVideoId === video.id"

                                class="absolute top-0 bottom-20 bg-[#141414] z-20 w-full h-screen "
                            >
                                <div class="flex flex-col justify-center">
                                    <video
                                        :class="[
                                            'w-full h-64 rounded-t-lg rounded-l-lg rounded-r-lg cursor-pointer transition-all duration-300 ease-in-out',
                                            {
                                                'transform scale-125':
                                                    hoveredVideoId === video.id,
                                            },
                                        ]"
                                        muted
                                        preload="auto"
                                        loop
                                        :autoplay="hoveredVideoId === video.id"
                                        @click="openModal(video)"
                                    >
                                        <source
                                            :src="`storage/${video.file}`"
                                            type="video/mp4"
                                        />
                                        Your browser does not support the video
                                        tag.
                                    </video>

                                    <div class="flex items-center space-x-3">
                                        <button class="cursor-pointer">
                                            <PlayCircleOutline
                                                fillColor="#FFFFFF"
                                                :size="42"
                                            />
                                        </button>
                                        <button class="cursor-pointer">
                                            <ThumbUpOutline
                                                fillColor="#FFFFFF"
                                                :size="42"
                                            />
                                        </button>

                                        <button
                                            @click="addToMyList(video.id)"
                                            class="cursor-pointer"
                                        >
                                            <PlusCircleOutline
                                                fillColor="#FFFFFF"
                                                :size="42"
                                            />
                                        </button>

                                        <button class="cursor-pointer">
                                            <ChevronDownCircleOutline
                                                fillColor="#FFFFFF"
                                                :size="42"
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div> -->






                        </div>
                    </Slide>
                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </div>

            <!-- Video Modal -->
            <div
                v-if="showModal"
                class="inset-0 z-10 bg-black bg-opacity-90 fixed"
            >
                <div class="absolute inset-0 top-2 right-10 mb-4">
                    <video
                        v-if="currentVideo"
                        class="w-full mx-auto h-screen block"
                        controls
                        autoplay
                    >
                        <source
                            :src="`storage/${currentVideo.file}`"
                            type="video/mp4"
                        />
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

            <!-- Other Content Sections -->

            <!-- <div class="mt-12">
        <ExploreButton class="group text-[20px]">
          <h1 class="text-xl text-gray-200 font-semibold">My List</h1>
        </ExploreButton>
        <div class="mt-2">
          <MyListContent class="absolute left-0" />
        </div>
      </div>

      <div class="mt-48">
        <ExploreButton class="group text-[20px]">
          <h1 class="text-xl text-gray-200 font-semibold">Movies</h1>
        </ExploreButton>
        <div class="mt-2">
          <MoviesContent class="absolute left-0" />
        </div>
      </div>

      <div class="mt-48 ">
        <ExploreButton class="group text-[20px]">
          <h1 class="text-xl text-gray-200 font-semibold">TV Shows</h1>
        </ExploreButton>
        <div class="mt-2">
          <TVShowsContent class="absolute left-0" />
        </div>
      </div>

      <div class="mt-48 pb-48">
        <ExploreButton class="group text-[20px]">
          <h1 class="text-xl text-gray-200 font-semibold">Documentaries</h1>
        </ExploreButton>
        <div class="mt-2">
          <DocumentariesContent class="absolute left-0" />
        </div>
      </div> -->
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
.carousel_prev:hover,
.carousel_next:hover {
    color: #ffffff;
}

/* Scaling and positioning for the video on hover */
.video-hover {
    position: absolute;
    top: -50px;
    left: -50px;
    width: 300px;
    height: 200px;
    z-index: 20;
    transform: scale(1.25);
    transition: transform 0.3s ease-in-out;
}
</style>
