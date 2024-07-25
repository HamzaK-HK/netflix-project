<script setup>
// import { Link } from "@inertiajs/vue3";
import Play from "vue-material-design-icons/Play.vue";
import InformationOutline from "vue-material-design-icons/InformationOutline.vue";
import ChevronRight from "vue-material-design-icons/ChevronRight.vue";
import ExploreAllContent from "@/Components/ExploreAllContent.vue";
import VolumeHigh from "vue-material-design-icons/VolumeHigh.vue";
import VolumeMute from "vue-material-design-icons/VolumeMute.vue";
import { ref } from "vue";

const showOverlay = ref(false);
const volume = ref(false);
const toggleVolume = () => {
    volume.value = !volume.value;
}

defineProps({
    name: String,
    release_date: String,
    description: String,
    category: String,
})
</script>

<template>
    <div>
        <div class="absolute top-32 left-14">
            <h1 class="text-5xl font-bold text-white">{{ name }}</h1>
        </div>
        <div class="absolute bottom-32 left-14 flex items-center gap-3">
            <Link
                href="#"
                class="inline-flex  items-center justify-center rounded-lg bg-white hover:bg-gray-300 px-4 py-1 transition ease-in-out duration-10"
            >
                <Play :size="36" fillColor="#000000" />
                <button class="font-bold pr-4">Play</button>
            </Link>
            <Link
                href="#"
                class="inline-flex bg-gray-700 bg-opacity-60 hover:bg-opacity-80 rounded justify-center  items-center px-6 py-1 transition ease-in-out duration-10"
            >
                <InformationOutline :size="36" fillColor="#ffffff" />
                <button class="ml-2 text-white font-bold">More info</button>
            </Link>
        </div>

        <div class="absolute bottom-32 right-16 flex items-center gap-3">
            <button v-if="volume" @click="toggleVolume" class="cursor-pointer p-[2px] border rounded-full">
                <VolumeHigh :size="36" fillColor="#ffffff" />
            </button>
            <button v-else  @click="toggleVolume" class="cursor-pointer p-[2px] border rounded-full">
                <VolumeMute :size="36" fillColor="#ffffff" class="" />
            </button>
        </div>


        <div class="absolute bottom-2 left-14 flex gap-2 items-end group">
            <button @click="showOverlay = true">
                <h1 class="text-xl font-bold text-gray-200">Your Next Watch</h1>
            </button>
            <button @click="showOverlay = true" class="group">
                <h1
                    class="text-sm font-bold text-[#36b7f3] hover:shadow-2xl flex items-center opacity-0 transform -translate-x-10  delay-500 duration-500 ease-in-out group-hover:opacity-100 group-hover:translate-x-0"
                >
                    EXPLORE ALL <ChevronRight :size="18" />
                </h1>
            </button>
        </div>
        <ExploreAllContent v-if="showOverlay" @close="showOverlay = false" />
    </div>
</template>
