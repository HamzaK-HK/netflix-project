<script setup>
import { ref, defineProps, defineEmits, watch } from 'vue';
// import { useForm } from '@inertiajs/vue3';
import Close from "vue-material-design-icons/Close.vue";
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { useRouter } from 'vue-router';

const emit = defineEmits(['close']);

// const form = useForm({
//     name: '',
// });




// const submit = () => {

//     const formData = new FormData();
//     formData.append("name", form.name);

//     form.post("/category", {
//         data: formData,
//         onSuccess: () => form.reset('name'),
//     });
// };

const router = useRouter();

const name = ref('');

const submit = async () => {

    try {
        const response = await axios.post('/category', {
            name: name.value,

        });

        console.log('Category added successfully', response);



    } catch (error) {
        console.log('Failed to add category', error);
    }


}


const closeOverlay = () => {
    emit("close");
};



</script>

<template>
    <div>
        <div class="mt-4 bg-[#141414] bg-opacity-90 fixed top-4 right-0 w-full z-10 h-[40%] mx-auto">
          <button
                      @click="closeOverlay"
                      class="cursor-pointer absolute top-6 right-10 z-20"
                  >
                      <Close :size="32" fillColor="#ffffff" />
                  </button>
          <form
            @submit.prevent="submit"
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <h1 class="text-xl font-bold mb-6 text-white">Add Category</h1>

            <!-- Category Name -->
            <div>
              <TextInput
                  id="categoryName"
                  type="text"
                  class="mt-1 block px-14 py-4 w-full bg-black text-white rounded-none placeholder-opacity-25"
                  v-model="name"
                  required
                  autofocus
                  placeholder="Category Name"
              />
              <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
            </div>
            <button
              type="submit"
              class="mt-2 px-4 py-2 bg-blue-600 rounded-md text-white"
            >
              Add Category
            </button>
          </form>
        </div>

    </div>
</template>
