<script setup>
import { Carousel, Slide, Navigation } from "vue3-carousel";
import { onMounted, ref } from "vue";
import axios from "axios";
import Close from "vue-material-design-icons/Close.vue"; // Import your Close button component if available

const videos = ref([]);

const currentSlide = ref(0);

const showModal = ref(false);
const currentVideo = ref(null);

onMounted(async () => {
  try {
    const response = await axios.get("/api/tvshows");
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

const toggleShowImage = (video) => {
  video.showImage = !video.showImage;
};

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
    <div class="bg-[#141414] bg-cover ml-14">
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
          <div class="w-full">
            <video
              v-if="!video.showImage"
              class="w-64 h-36 rounded-sm cursor-pointer"
              muted
              preload="auto"
              loop

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

    <!-- Modal -->
    <div
      v-if="showModal"
      class="inset-0 z-10 bg-black bg-opacity-90  fixed"
    >
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
</style>
