
<script>
export default {
  data() {
    return {
      videos: [], // Assume this is populated with your video data
      showModal: false,
      currentVideo: null,
      hoveredVideo: null, // Track which video is hovered
    };
  },
  methods: {
    openModal(video) {
      this.currentVideo = video;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.currentVideo = null;
    },
    addToMyList(video) {
      // Add logic to add the video to the "My List" here
      // You might want to send a request to your backend
      console.log("Adding to My List:", video);

      // Example: Axios request to backend
      axios.post('/api/my-list', { videoId: video.id })
        .then(response => {
          // Handle success (e.g., show a message or update UI)
          alert('Video added to My List');
        })
        .catch(error => {
          // Handle error
          console.error('Error adding to My List:', error);
        });
    },
  },
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
            <div
              class="relative w-full group"
              @mouseenter="hoveredVideo = video.id"
              @mouseleave="hoveredVideo = null"
            >
              <video
                v-if="!video.showImage"
                class="w-64 h-36 rounded-sm cursor-pointer transition-transform duration-300 transform group-hover:scale-110"
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
                class="w-64 h-36 rounded-sm object-cover cursor-pointer transition-transform duration-300 transform group-hover:scale-110"
                @click="openModal(video)"
              />

              <!-- Add button, shown only when video is hovered -->
              <button
                v-if="hoveredVideo === video.id"
                @click.stop="addToMyList(video)"
                class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 transition-colors"
              >
                Add to My List
              </button>
            </div>
          </Slide>
          <template #addons>
            <Navigation />
          </template>
        </Carousel>
      </div>

      <div
        v-if="showModal"
        class="inset-0 z-10 bg-black bg-opacity-90 flex items-center justify-center fixed"
      >
        <div class="absolute inset-0 top-2 right-10 mb-4">
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
  /* Additional styling to ensure hover effects are smooth */
  .group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
  }

  .group-hover\:scale-110 {
    transition: transform 0.3s ease;
  }
  </style>
