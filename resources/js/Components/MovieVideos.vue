<script setup>
import { onMounted, ref, nextTick } from "vue";
import axios from "axios";

import VolumeHigh from "vue-material-design-icons/VolumeHigh.vue";
import VolumeMute from "vue-material-design-icons/VolumeMute.vue";

const videos = ref([]); // Store video data
const currentVideoIndex = ref(0); // Track the currently playing video

onMounted(async () => {
    try {
        const response = await axios.get("/movies");
        console.log(response.data, "Response");
        videos.value = response.data;

        // Ensure the DOM is updated before playing the video
        await nextTick();
        playCurrentVideo();
    } catch (error) {
        console.log("Failed to fetch videos", error);
    }
});

// Function to play the current video
const playCurrentVideo = () => {
    const videoElements = document.querySelectorAll("video");

    if (videoElements.length > 0) {
        // Hide all videos and stop them
        videoElements.forEach((video) => {
            // video.pause();
            // video.style.display = "none";
            video.onended = null; // Clear event listener
        });

        // Show and play the current video
        const currentVideo = videoElements[currentVideoIndex.value];
        currentVideo.style.display = "block";
        currentVideo.muted = !volume.value; // Set muted state based on volume
        currentVideo.play();

        // Set event listener for when the current video ends
        currentVideo.onended = () => {
            // Move to the next video index
            currentVideoIndex.value = (currentVideoIndex.value + 1) % videos.value.length;

            // Play the next video
            playCurrentVideo();
        };

        // Log which video is currently playing
        console.log(`Playing video ${currentVideoIndex.value + 1}`);
    } else {
        console.log("No videos found");
    }
};


const volume = ref(false); // State to track if the video is muted or not


// Toggle volume of the current video
const toggleVolume = () => {
    volume.value = !volume.value; // Toggle the volume state

    const currentVideo = document.querySelector("video[style*='block']");
    if (currentVideo) {
        currentVideo.muted = !volume.value; // Apply the muted state
    }
};
</script>

<template>
    <div>
        <div class="relative w-full h-screen overflow-hidden">
          <video
            v-for="(video, index) in videos"
            :key="video.id"
            class="absolute w-full h-full object-cover z-[-1]"
            :style="{ display: currentVideoIndex === index ? 'block' : 'none' }"
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
    </div>
</template>

<style>
/* Ensure all video elements are hidden initially and only display the current one */
video {
  display: none;
}
</style>





<!-- <script setup>
import { onMounted, ref, nextTick } from "vue";
import axios from "axios";

const videos = ref([]); // Store video data
const currentVideoIndex = ref(0); // Track the currently playing video

onMounted(async () => {
    try {
        const response = await axios.get("/home");
        console.log(response.data, "Response");
        videos.value = response.data;

        // Ensure the DOM is updated before playing the video
        await nextTick();
        playCurrentVideo();
    } catch (error) {
        console.log("Failed to fetch videos", error);
    }
});

// Function to play the current video
const playCurrentVideo = () => {
    // Clear any existing event listeners to avoid duplicate triggers
    document.querySelectorAll("video").forEach((video) => {
        video.onended = null;
    });

    const videoElements = document.querySelectorAll("video");

    if (videoElements.length > 0) {
        // Hide all videos
        videoElements.forEach((video) => {
            video.onended = null;
        });

        // Show and play the current video
        const currentVideo = videoElements[currentVideoIndex.value];
        currentVideo.style.display = "block";
        currentVideo.play();

        // Set event listener for when the current video ends
        currentVideo.onended = () => {
            // Move to the next video index
            currentVideoIndex.value = (currentVideoIndex.value + 1) % videos.value.length;

            // Play the next video
            playCurrentVideo();
        };

        // Log which video is currently playing
        console.log(`Playing video ${currentVideoIndex.value + 1}`);
    } else {
        console.log("No videos found");
    }
};
</script> -->

<!-- <template>
  <div class="relative w-full h-screen overflow-hidden">
    <video
      v-for="(video, index) in videos"
      :key="video.id"
      class="absolute w-full h-full object-cover z-[-1]"
      :style="{ display: currentVideoIndex.value === index ? 'block' : 'none' }"
      muted
      preload="auto"
    >
      <source :src="`storage/${video.file}`" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <slot />
  </div>
</template>

<style>
/* Optional: Hide all video elements initially and display only the current one */
video {
  display: none;
}
</style> -->
