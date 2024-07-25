<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import VolumeHigh from "vue-material-design-icons/VolumeHigh.vue";
import VolumeMute from "vue-material-design-icons/VolumeMute.vue";



const videos = ref([]); // Store video data
const currentVideoIndex = ref(0); // Track the currently playing video

// onMounted(async () => {
//   try {
//     const response = await axios.get("/home");
//     console.log(response, "Response");
//     videos.value = response.data;

//     // Initiate video playback after data is loaded
//     playCurrentVideo();
//   } catch (error) {
//     console.log("Failed to fetch videos", error);
//   }
// });

// Function to play the current video
const playCurrentVideo = () => {
  // Clear any existing event listeners to avoid duplicate triggers
  document.querySelectorAll("video").forEach((video) => {
    video.onended = null;
  });

  const videoElements = document.querySelectorAll("video");

  // Check if the video elements are available
  if (videoElements.length > 0) {
    // Play the current video
    const currentVideo = videoElements[currentVideoIndex.value];
    currentVideo.play();

    // Set event listener for when the current video ends
    currentVideo.onended = () => {
      // Move to the next video index
      currentVideoIndex.value =
        (currentVideoIndex.value + 1) % videos.value.length;

      // Play the next video
      playCurrentVideo();
    };

    // Log which video is currently playing
    console.log(`Playing video ${currentVideoIndex.value + 1}`);
  }
};


const volume = ref(false);
const toggleVolume = () => {
    volume.value = !volume.value; // Toggle the volume state

    const currentVideo = document.querySelector("video[style*='block']");
    if (currentVideo) {
        currentVideo.muted = !volume.value; // Apply the muted state
    }
};


</script>

<template>
  <div class="relative w-full h-screen overflow-hidden">
    <video
      v-for="(video) in videos"
      :key="video.id"
      class="absolute w-full h-full object-cover z-[-1]"

      muted
      preload="auto"
    >
      <source :src="`storage/${video.file}`" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <slot />
  </div>
  <div class="absolute bottom-32 right-16 flex items-center gap-3">
            <button v-if="volume" @click="toggleVolume" class="cursor-pointer p-[2px] border rounded-full">
                <VolumeHigh :size="36" fillColor="#ffffff" />
            </button>
            <button v-else @click="toggleVolume" class="cursor-pointer p-[2px] border rounded-full">
                <VolumeMute :size="36" fillColor="#ffffff" />
            </button>
        </div>
</template>
