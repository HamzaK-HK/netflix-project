<script setup>
// import { Link } from '@inertiajs/vue3';

import NavLink from '@/Components/NavLink.vue';
import MenuDown from 'vue-material-design-icons/MenuDown.vue';
import MenuUp from 'vue-material-design-icons/MenuUp.vue';
import BellOutline from 'vue-material-design-icons/BellOutline.vue';
import BellOffOutline from 'vue-material-design-icons/BellOffOutline.vue';
import { ref } from 'vue';
import HomeOutline from "vue-material-design-icons/HomeOutline.vue";
import PlayBoxMultipleOutline from "vue-material-design-icons/PlayBoxMultipleOutline.vue";
import AccountBoxOutline from "vue-material-design-icons/AccountBoxOutline.vue";
import AccountBox from "vue-material-design-icons/AccountBox.vue";
import ArrowLeft from "vue-material-design-icons/ArrowLeft.vue";
import HomeVariant from 'vue-material-design-icons/HomeVariant.vue'
// import PrimaryButton from '@/Components/PrimaryButton.vue';
const isScrolled = ref(false);



</script>

<template>
    <div>
        <div class="fixed top-0 left-0 right-0 z-10 md:block hidden border-b">
            <nav
            :class="[
            'flex justify-between ml-32 mr-32 bg-white bg-cover',
            {'bg-black bg-opacity-90': isScrolled}
          ]"
            class="flex justify-end p-2 px-8">
                <ul class="flex justify-between items-center gap-4">
                    <li class="mr-4">
                        <NavLink :href="route('home')"
                            ><img
                                src="/netflix-logo.png"
                                class="cursor-pointer"
                                width="120"
                                alt=""
                        /></NavLink>
                    </li>

                    </ul>


                    <li class="flex items-center group">
                        <AccountBox
                            class="cursor-pointer"
                            :size="48"
                            fillColor="#000000"
                        />
                        <div
                        class="absolute hidden group-hover:flex top-[4.8rem] right-[4.5rem] text-[15px] font-mono bg-gray-100  w-52 h-auto"
                        >
                        <MenuUp :size="34" fillColor="#000000" class="mt-4 absolute -top-11 -right-2 " />
                        <div class="mt-2">
                            <div class="flex items-center gap-2 mb-2 ml-2">
                                <AccountBox :size="28" fillColor="#000000" /><Link class="hover:underline">Kids</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <PencilOutline :size="28" class="flex items-center" fillColor="#000000" /><Link class="hover:underline">Manage Profiles</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <AccountOultline :size="28" class="flex items-center" fillColor="#000000" /><Link href="route('account')" class="hover:underline">Account</Link>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <HelpCircleOutline :size="28" class="flex items-center" fillColor="#000000" /><Link class="hover:underline">Help center</Link>
                            </div>
                            <div class="flex items-center justify-center border-t mt-5 mb-6 -mr-10">
                                <Link class="hover:underline mt-6" @click="submit">Sign out of netflix</Link>
                            </div>
                        </div>

                        </div>
                        <MenuDown
                            class="cursor-pointer group-hover:hidden"
                            :size="30"
                            fillColor="#000000"
                        />
                        <MenuUp class="hidden crusor-pointer group-hover:flex" :size="30" fillColor="#000000" />
                    </li>
                <!-- <div class="w-full absolute bottom-0 h-full left-0 bg-opacity-10 z-[-1] opacity-5 bg-gradient-to-t from-black to-gray-700 via-gray-700" /> -->
            </nav>

        </div>
        <div class="bg-[#FAFAFA] bg-cover w-full h-screen">
            <div class="absolute top-20 left-36 border-r-4 h-screen pr-10" id="sideBar">
                <Link href="/home">
                    <button class="flex gap-4 items-center mt-4 px-4 py-1  w-64 rounded-sm hover:bg-gray-200 transiion ease-in-out duration-100">
                        <ArrowLeft :size="28" fillColor="#000000" class="cursor-pointer" />
                        Back to netflix
                    </button>
                </Link>
                <Link class="/account">
                    <button class=" flex gap-4 items-center mt-10 px-4 py-1  w-64 rounded-sm hover:bg-gray-200 transiion ease-in-out duration-100">
                        <HomeVariant :size="28" fillColor="#000000" class="cursor-pointer" />
                        Overview
                    </button>
                </Link>
            </div>
            <div class="absolute top-20 left-40 ml-44 mt-4">
                <h1 class="text-3xl font-extrabold">Account</h1>
            </div>
        </div>

    </div>
</template>

