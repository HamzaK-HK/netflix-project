<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Link from "../../Components/Link.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// const form = useForm({
//     email: "",
//     password: "",
//     remember: false,
// });

// const submit = () => {
//     form.post(route("login"), {
//         onFinish: () => form.reset("password"),
//     });
// };
const router = useRouter();
const email = ref("");
const password = ref("");
const remember = ref(false);
const errors = ref({});

const submit = async () => {
    errors.value = null;
    try {
        const response = await axios.post("/login", {
            email: email.value,
            password: password.value,
            remember: remember.value,
        });
        if (response.data.redirect) {
            router.push(response.data.redirect);
        }

        console.log("login successfull", response.data);
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        } else {
            console.error("Failed to login", error);
        }
    }
};
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
                <Head title="Log in" />

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
                            id="email"
                            type="email"
                            v-model="email"
                            class="mt-1 block px-14 py-4 w-75 border-white border bg-black placeholder: bg-opacity-25"
                            required
                            autofocus
                            placeholder="Email"
                            autocomplete="username"
                        />

                        <!-- <InputError class="mt-2" :message="form.errors.email" /> -->
                    </div>

                    <div class="mt-4">
                        <TextInput
                            id="password"
                            type="password"
                            v-model="password"
                            class="mt-1 block w-full px-14 border-white border py-4 placeholder:text-left bg-black bg-opacity-25"
                            required
                            placeholder="Password"
                            autocomplete="current-password"
                        />

                        <!-- <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        /> -->
                    </div>

                    <div class="flex flex-col justify-center items-center mt-4">
                        <button
                            class="w-full px-6 py-2 bg-red rounded-md hover:bg-red-700 transition ease-in-out duration-150 text-lg text-center mb-4 mt-2"
                        >
                            Sign in
                        </button>
                        <p>OR</p>
                        <button
                            class="w-full px-6 py-2 mb-4 mt-2 bg-gray-400 bg-opacity-30 rounded-md hover:bg-opacity-40 transition ease-in-out duration-150"
                        >
                            Use a Sign-In Code
                        </button>

                        <Link
                            v-if="canResetPassword"
                            class="underline text-sm text-gray-200 hover:text-gray-300 transition ease-in-out duration-150 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                    <div>
                        <div class="block mt-4 mb-2">
                            <label class="flex items-center">
                                <Checkbox name="remember" />
                                <span class="ms-2 text-sm text-gray-300"
                                    >Remember me</span
                                >
                            </label>
                        </div>
                        <div class="flex items-center justify-start gap-1 mt-4">
                            New to Netflix?
                            <Link class="underline" to="/register"
                                >Sign up now</Link
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
.placeholder-left::placeholder {
    text-align: left;
}
</style>
