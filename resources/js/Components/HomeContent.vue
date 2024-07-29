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


}

</script>

<template>
  <div>
    <div class="bg-[#141414] ml-14 h-auto">
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
                :class="['w-1/2 h-36 rounded-sm cursor-pointer transition-all duration-300 ease-in-out', { 'transform scale-125 z-20': hoveredVideoId === video.id }]"
                muted
                preload="auto"
                loop
                :autoplay="hoveredVideoId === video.id"
                @click="openModal(video)"
              >
                <source :src="`storage/${video.file}`" type="video/mp4" />
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
              <div
                v-if="hoveredVideoId === video.id"
                class="absolute inset-0 bg-black bg-opacity-40 -z-1 flex items-center justify-around text-lg font-extrabold text-white"
              >
                <div class="flex items-center space-x-3">
                    <button

                    class="cursor-pointer">
                        <ThumbUpOutline fillColor="#FFFFFF" :size="30" />
                    </button>

                    <button class="cursor-pointer">
                  <PlayCircleOutline fillColor="#FFFFFF" :size="30" />

                    </button>

                    <button
                    @click="addToMyList(video.id)"
                    class="cursor-pointer">
                  <PlusCircleOutline fillColor="#FFFFFF" :size="30" />

                    </button>

                    <button class="cursor-pointer">
                  <ChevronDownCircleOutline fillColor="#FFFFFF" :size="30" />

                    </button>
                </div>
                <div class="flex items-center">
                  <Comment fillColor="#FFFFFF" :size="30" />
                  <!-- Assuming you have comments in your data -->
                  <div class="pl-1">{{ video.comments?.length || 0 }}</div>
                </div>
              </div>
            </div>
          </Slide>
          <template #addons>
            <Navigation />
          </template>
        </Carousel>
      </div>

      <!-- Video Modal -->
      <div v-if="showModal" class="inset-0 z-10 bg-black bg-opacity-90 fixed">
        <div class="absolute inset-0 top-2 right-10 mb-4">
          <video
            v-if="currentVideo"
            class="w-full mx-auto h-screen block"
            controls
            autoplay
          >
            <source :src="`storage/${currentVideo.file}`" type="video/mp4" />
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
      <div class="mt-12">
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
      </div>
    </div>
  </div>
</template>

<style scoped>
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
