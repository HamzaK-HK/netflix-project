<script setup>
import NavLink from '@/Components/NavLink.vue';
import Magnify from "vue-material-design-icons/Magnify.vue";
import BellOutline from "vue-material-design-icons/BellOutline.vue";
import AccountBox from "vue-material-design-icons/AccountBox.vue";
import MenuDown from "vue-material-design-icons/MenuDown.vue";
import MenuUp from "vue-material-design-icons/MenuUp.vue";
import AccountOultline from "vue-material-design-icons/AccountOutline.vue";
import HelpCircleOutline from "vue-material-design-icons/HelpCircleOutline.vue";
import PencilOutline from "vue-material-design-icons/PencilOutline.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ExploreAllContent from "./ExploreAllContent.vue";
import Close from "vue-material-design-icons/Close.vue";
import PostContent from '@/Components/PostContent.vue';
import Transfer from "vue-material-design-icons/Transfer.vue";
// import { usePage } from '@inertiajs/vue3';
import HomeOutline from "vue-material-design-icons/HomeOutline.vue";
import PlayBoxMultipleOutline from "vue-material-design-icons/PlayBoxMultipleOutline.vue";
import AccountBoxOutline from "vue-material-design-icons/AccountBoxOutline.vue";
import GamepadVariantOutline from "vue-material-design-icons/GamepadVariantOutline.vue";
import Link from '@/Components/Link.vue';
import Category from '@/Components/Category.vue';

// const user = usePage().props.auth.user;
// const isAdmin = user.email === 'admin@gmail.com';

// import { Link } from "@inertiajs/vue3";

// import { useForm } from "@inertiajs/vue3";

import { ref } from "vue";
import { onMounted, onUnmounted } from "vue";


const emit = defineEmits(["opensearch"]);
const searchInput = ref(false);

const openSearch = () => {
    searchInput.value = !searchInput.value;
    emit("opensearch");
};

let isScrolled = ref(false);

const handleScroll = () => {
  isScrolled.value = window.scrollY > 0;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});

// const form = useForm({
//     email: "",
//     password: "",
//     remember: false,
// });

// const submit = () => {
//     form.post(route("logout"), {
//         onFinish: () => form.reset("password"),
//     });
// };

const showOverlay = ref(false);
const showCategoryOverlay = ref(false);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

</script>

<template>
    <div>
        <div class="fixed top-0 left-0 right-0 z-10 md:block">
            <nav
            :class="[
            'flex justify-between p-4 px-12',
            {'bg-black bg-opacity-90': isScrolled}
          ]"
            class=" flex justify-between p-4 px-8">
                <ul class="flex  justify-start items-center gap-4">
                    <li class="mr-4">
                        <NavLink class="hidden">Browse<MenuDown /></NavLink>
                        <NavLink
                            ><img
                                src="/netflix-logo.png"
                                class="cursor-pointer"
                                width="100"
                                alt=""
                        /></NavLink>
                    </li>
                    <li>
                        <NavLink  :active="true">Home</NavLink>
                    </li>
                    <li><NavLink>TV Shows</NavLink></li>
                    <li><NavLink >Movies</NavLink></li>
                    <li><NavLink >New & Popular</NavLink></li>
                    <li><NavLink >My List</NavLink></li>
                    <li>
                        <NavLink >Browse by Languages</NavLink>
                    </li>
                </ul>

                <ul class="flex justify-end items-center gap-4">
                    <li  id="postSection" class="flex gap-4">
                        <PrimaryButton @click="showOverlay = true">Post</PrimaryButton>
        <PrimaryButton @click="showCategoryOverlay = true">Category</PrimaryButton>

                        <PostContent v-if="showOverlay" @close="showOverlay = false" />
                        <Category v-if="showCategoryOverlay" @close="showCategoryOverlay = false" />

                    </li>

                    <li
                        :class="[
                            'flex items-center rounded-lg px-2 py-[3px] ',
                            {
                                'bg-black bg-opacity-70 border boder-gray-700 transition ease-in duration-100':
                                    searchInput,
                            },
                        ]"
                    >
                        <Magnify
                            class="cursor-pointer"
                            @click="openSearch"
                            :size="30"
                            autofocus
                            fillColor="#ffffff"
                        />
                        <input
                            v-if="searchInput"
                            type="search"
                            placeholder="Title, people, genres"
                            class="py-1 px-2 bg-transparent border-0 focus:outline-none text-white placeholder:text-gray-400 ring-0 focus:ring-0"
                        />
                    </li>
                    <li>
                        <NavLink

                            class="text-white font-bold hover:text-gray-300"
                            >Kids</NavLink
                        >
                    </li>

                    <li class="relative group">
                        <BellOutline
                            class="cursor-pointer"
                            :size="28"
                            fillColor="#ffffff"
                        />
                        <span
                        class="absolute hidden group-hover:flex top-14 right-4 text-[15px] bg-black bg-opacity-70 border-t-2 w-80 h-32 justify-center items-center text-gray-200"
                        >
                        <MenuUp :size="34" fillColor="#ffffff" class="mt-4 absolute -top-11 -right-2 group-hover:flex " />
                            No recent notifications
                        </span>
                    </li>
                    <li class="flex items-center group">
                        <AccountBox
                            class="cursor-pointer"
                            :size="36"
                            fillColor="#ffffff"
                        />
                        <div
                        class="absolute hidden group-hover:flex top-[4.8rem] right-[4.5rem] text-[15px] font-mono bg-black bg-opacity-70  w-52 h-auto  text-gray-200"
                        >
                        <MenuUp :size="34" fillColor="#ffffff" class="mt-4 absolute -top-11 -right-2 " />
                        <div class="mt-2">
                            <div class="flex items-center gap-2 mb-2 ml-2">
                                <AccountBox :size="28" fillColor="#ffffff" /><Link class="hover:underline">Kids</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <PencilOutline :size="28" class="flex items-center" fillColor="#ffffff" /><Link class="hover:underline">Manage Profiles</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <AccountOultline :size="28" class="flex items-center" fillColor="#ffffff" /><Link to="/account" class="hover:underline">Account</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <HelpCircleOutline :size="28" class="flex items-center" fillColor="#ffffff" /><Link class="hover:underline">Help center</Link>
                            </div>
                            <div class="flex items-center justify-center border-t mt-5 mb-6 -mr-10">
                                <Link class="hover:underline mt-6" @click="submit">Sign out of netflix</Link>
                            </div>
                        </div>

                        </div>
                        <MenuDown
                            class="cursor-pointer group-hover:hidden"
                            :size="30"
                            fillColor="#ffffff"
                        />
                        <MenuUp class="hidden crusor-pointer group-hover:flex" :size="30" fillColor="#ffffff" />
                    </li>
                </ul>
                <!-- <div class="w-full absolute bottom-0 h-full left-0 bg-opacity-10 z-[-1] opacity-5 bg-gradient-to-t from-black to-gray-700 via-gray-700" /> -->
            </nav>

        </div>

        <div class="fixed top-0 z-50 w-full items-center justify-between md:hidden ">
            <ul class="flex justify-between items-center gap-4">
                <NavLink
                            ><img
                                src="/n-logo.png"
                                class="cursor-pointer ml-6"
                                width="60"
                                alt=""
                        /></NavLink>

                <div class="mr-20">
                            <li
                            :class="[
                                'flex items-center rounded-lg px-2 py-[3px] ',
                                {
                                    'bg-black bg-opacity-70 border boder-gray-700 transition ease-in duration-100':
                                        searchInput,
                                },
                            ]"
                        >
                            <Magnify
                                class="cursor-pointer"
                                @click="openSearch"
                                :size="40"
                                autofocus
                                fillColor="#ffffff"
                            />
                            <input
                                v-if="searchInput"
                                type="search"
                                placeholder="Title, people, genres"
                                class="py-1 px-2 bg-transparent border-0 focus:outline-none text-white placeholder:text-gray-400 ring-0 focus:ring-0"
                            />
                        </li>
                    </div>
            </ul>
        </div>

        <div  id="bottomNav" class="fixed bottom-0 z-50 w-full   items-center justify-between bg-black bg-opacity-90 md:hidden ">
            <ul class="flex justify-around items-center ">
                    <li>
                        <NavLink class="flex flex-col"  :active="true"><HomeOutline :size="28" fillColor="#ffffff" class="cursor-pointer" />Home</NavLink>

                    </li>
                    <li><NavLink class="flex flex-col" ><PlayBoxMultipleOutline :size="28" fillColor="#ffffff" class="" />New & Popular</NavLink></li>
                    <li><NavLink class="flex flex-col" ><GamepadVariantOutline :size="28" fillColor="#ffffff" />Games</NavLink></li>
                    <li>
                        <NavLink class="flex flex-col" ><AccountBoxOutline :size="28" fillColor="#ffffff" />My Netflix</NavLink>
                    </li>
                </ul>
        </div>
    </div>
</template>


