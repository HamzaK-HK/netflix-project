<script setup>
import ExploreAllContent from "@/Components/ExploreAllContent.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
// import { useForm } from "@inertiajs/vue3";
import { ref, defineEmits, defineProps, onMounted } from "vue";
import Category from "@/Components/Category.vue";

import Close from "vue-material-design-icons/Close.vue";
import axios from "axios";

const emit = defineEmits(["close"]);

const closeOverlay = () => {
    emit("close");
};

// Initialize form using useForm from Inertia
// const form = useForm({
//     name: '',
//     release_date: '',
//     description: '',
//     // category: '',
//   file: null,
// });

const plan_type = ref("");
const monthly_price = ref("");
const resolution = ref("");
const supported_devices = ref("");


const submit = async () => {
    try {
        // Create a new FormData object
        const formData = new FormData();
        formData.append("plan_type", plan_type.value);
        formData.append("monthly_price", monthly_price.value);
        formData.append("resolution", resolution.value);
        formData.append("supported_devices", supported_devices.value);

        // Send the formData using Axios
        const response = await axios.post("/api/posts", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        console.log("Post added successfully");
    } catch (error) {
        console.error("Error adding post:", error.response.data);
    }
};


</script>

<template>
    <div>
        <div
            class="bg-[#141414] bg-opacity-90 fixed top-0 right-0 w-full z-10 h-screen"
        >
            <button
                @click="closeOverlay"
                class="cursor-pointer absolute top-6 right-10 z-20"
            >
                <Close :size="32" fillColor="#ffffff" />
            </button>
            <form
                @submit.prevent="submit"
                class="bg-black p-12 mt-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 items-center max-w-5xl mx-auto rounded-lg text-white"
            >
                <h1 class="text-3xl font-bold mb-4">Post Plan</h1>

                <!-- Movie Name -->
                <div class="mt-4">
                    <TextInput
                        id="plan_type"
                        type="text"
                        class="mt-1 block px-14 py-4 w-full bg-black rounded-none placeholder-opacity-25"
                        v-model="name"
                        required
                        autofocus
                        placeholder="Montyly price"
                    />
                    <!-- <InputError class="mt-2" :message="errors.name" /> -->
                </div>

                <!-- Release Date -->
                <div class="mt-4">
                    <TextInput
                        id="monthly_price"
                        type="text"
                        class="mt-1 block px-14 py-4 w-full bg-black rounded-none placeholder-opacity-25"
                        v-model="release_date"
                        required
                        placeholder="Resolution"
                    />
                    <!-- <InputError class="mt-2" :message="errors.release_date" /> -->
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <TextInput
                        id="resolution"
                        class="mt-1 block w-full px-14 py-4 border border-white placeholder-text-left bg-black bg-opacity-25"
                        v-model="description"
                        required
                        placeholder="Video quality"
                    />
                    <!-- <InputError class="mt-2" :message="errors.description" /> -->
                </div>

                <div class="mt-4">
                    <input
                        id="supported_devices"
                        class="mt-1 block w-full px-14 py-4 border border-white placeholder-text-left bg-black bg-opacity-25"
                        v-model="description"
                        required
                        placeholder="Supported devices"
                    />
                    <!-- <InputError class="mt-2" :message="errors.description" /> -->
                </div>

                <!-- Category -->



                <!-- Upload Button -->
                <div class="flex flex-col justify-center items-center mt-4">
                    <button
                        class="w-full px-6 py-2 bg-red-600 rounded-md hover:bg-red-700 transition ease-in-out duration-150 text-lg text-center mb-4 mt-2"
                    >
                        <!-- :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing" -->
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
