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

const name = ref("");
const release_date = ref("");
const description = ref("");
const category_id = ref("");
const file = ref(null);

const submit = async () => {
    try {
        // Create a new FormData object
        const formData = new FormData();
        formData.append("name", name.value);
        formData.append("release_date", release_date.value);
        formData.append("description", description.value);
        formData.append("category_id", category_id.value);
        formData.append("file", file.value); // Add the file to FormData

        // Send the formData using Axios
        const response = await axios.post("/posts", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        console.log("Post added successfully", response.data);
    } catch (error) {
        console.error("Error adding post:", error.response.data);
    }
};

const categories = ref([]);

const fetchCategories = () => {
  axios
    .get("/getcategory", {
      headers: {
        Accept: "application/json",
      },
    })
    .then((response) => {
      categories.value = response.data.categories;
      console.log("Categories fetched successfully:");
    })
    .catch((error) => {
      console.error("Error fetching categories:", error);
    });
};

onMounted(() => {
    fetchCategories();
});
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
            <h1 class="text-4xl text-white font-bold text-center mt-4 mb-3">
                Post Movies, TV Shows, etc.
            </h1>
            <form
                @submit.prevent="submit"
                class="bg-black p-12 mt-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 items-center max-w-5xl mx-auto rounded-lg text-white"
            >
                <h1 class="text-3xl font-bold mb-4">Post Anything</h1>

                <!-- Movie Name -->
                <div class="mt-4">
                    <TextInput
                        id="movieName"
                        type="text"
                        class="mt-1 block px-14 py-4 w-full bg-black rounded-none placeholder-opacity-25"
                        v-model="name"
                        required
                        autofocus
                        placeholder="Movie Name"
                    />
                    <!-- <InputError class="mt-2" :message="errors.name" /> -->
                </div>

                <!-- Release Date -->
                <div class="mt-4">
                    <TextInput
                        id="releaseDate"
                        type="text"
                        class="mt-1 block px-14 py-4 w-full bg-black rounded-none placeholder-opacity-25"
                        v-model="release_date"
                        required
                        placeholder="Release Date"
                    />
                    <!-- <InputError class="mt-2" :message="errors.release_date" /> -->
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <textarea
                        id="description"
                        class="mt-1 block w-full px-14 py-4 border border-white placeholder-text-left bg-black bg-opacity-25"
                        v-model="description"
                        required
                        placeholder="Description"
                    ></textarea>
                    <!-- <InputError class="mt-2" :message="errors.description" /> -->
                </div>

                <!-- Category -->

                <div class="mt-4">
                    <select
                        v-model="category_id"
                        class="mt-1 block w-full px-4 py-1.5 cursor-pointer bg-black rounded-full border-red-600 border text-white"
                        required
                    >
                        <option value="" disabled>Select a category</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Upload Button -->
                <div class="flex flex-col justify-center items-center mt-4">
                    <input
                        type="file"
                        @change="(e) => (file = e.target.files[0])"
                        class="mb-4 border p-4 w-full bg-black bg-opacity-25"
                        required
                    />
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
