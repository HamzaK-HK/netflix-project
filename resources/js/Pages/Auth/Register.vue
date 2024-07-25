<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Link from '@/Components/Link.vue';
import axios from 'axios';
import { ref } from 'vue';
// import { Head, Link, useForm } from '@inertiajs/vue3';

// const form = useForm({
//     name: '',
//     email: '',
//     password: '',
//     password_confirmation: '',
// });

// const submit = () => {
//     form.post(route('register'), {
//         onFinish: () => form.reset('password', 'password_confirmation'),
//     });
// };
const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const errors = ref({});

const submit = async () => {

    try {
        const response = await axios.post('/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });

        console.log('registered successfully', response.data);

    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors
        } else {
            console.error('Failed to register', error);
        }
    }

}





</script>

<template>
       <div class="bg-[url('/netflix.jpg')] bg-cover">
        <div class="bg-black bg-opacity-60">
            <img
                src="/netflix-logo.png"
                class="absolute left-40 top-6 max-w-[877px]"
                width="150"
                alt=""
            />
            <div
                class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
            >
                <Head title="Register" />

                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>
                <div></div>
                <form
                    @submit.prevent="submit"
                    class="bg-black bg-opacity-80 p-12 text-white absolute bottom-0"
                >
                    <h1 class="text-4xl font-bold mb-6">Sign In</h1>
                    <div class="mt-4">
                        <TextInput
                            id="name"
                            v-model="name"
                            type="name"
                            class="mt-1 block px-14 py-4 w-75 bg-black placeholder: bg-opacity-25"
                            required
                            autofocus
                            placeholder="Name"
                            autocomplete="username"
                            />

                            <!-- v-model="form.email"
                        <InputError class="mt-2" :message="form.errors.email" /> -->
                    </div>
                    <div class="mt-4">
                        <TextInput
                            id="email"
                            v-model="email"
                            type="email"
                            class="mt-1 block px-14 py-4 w-75 bg-black placeholder: bg-opacity-25"
                            required
                            autofocus
                            placeholder="Email"
                            autocomplete="email"
                            />

                            <!-- v-model="form.email"
                        <InputError class="mt-2" :message="form.errors.email" /> -->
                    </div>

                    <div class="mt-4">
                        <TextInput
                            id="password"
                            v-model="password"
                            type="password"
                            class="mt-1 block w-full px-14  py-4 placeholder:text-left bg-black bg-opacity-25"

                            required
                            placeholder="Password"
                            autocomplete="current-password"
                        />

                        <!-- <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        /> -->
                    </div>
                    <div class="mt-4">
                        <TextInput
                            id="confirm-password"
                            v-model="password_confirmation"
                            type="password"
                            class="mt-1 block w-full px-14  py-4 placeholder:text-left bg-black bg-opacity-25"

                            required
                            placeholder="Confirm Password"
                            autocomplete="current-password"
                        />

                        <!-- <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        /> -->
                    </div>

                    <div class="flex flex-col justify-center items-center mt-4">
                        <button
                            class=" w-full px-6 py-2 bg-red rounded-md hover:bg-red-700 transition ease-in-out duration-150 text-lg text-center mb-4 mt-2"
                            >
                            <!-- :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" -->
                            Sign Up
                        </button>
                        <p>OR</p>
                        <Link
                            v-if="canResetPassword"
                            to=""
                            class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Forgot your password?
                        </Link>
                        <div>
                            <div class="flex items-center justify-between mt-2 gap-2">
                                Already have an account? <Link class="underline" to="/login">Sign in</Link>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
