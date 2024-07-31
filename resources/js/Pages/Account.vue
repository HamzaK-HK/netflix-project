<script setup>
// import { Link } from '@inertiajs/vue3';

import NavLink from "@/Components/NavLink.vue";
import MenuDown from "vue-material-design-icons/MenuDown.vue";
import MenuUp from "vue-material-design-icons/MenuUp.vue";
import BellOutline from "vue-material-design-icons/BellOutline.vue";
import BellOffOutline from "vue-material-design-icons/BellOffOutline.vue";
import { ref } from "vue";
import HomeOutline from "vue-material-design-icons/HomeOutline.vue";
import PlayBoxMultipleOutline from "vue-material-design-icons/PlayBoxMultipleOutline.vue";
import AccountBoxOutline from "vue-material-design-icons/AccountBoxOutline.vue";
import AccountBox from "vue-material-design-icons/AccountBox.vue";
import ArrowLeft from "vue-material-design-icons/ArrowLeft.vue";
import HomeVariant from "vue-material-design-icons/HomeVariant.vue";
// import PrimaryButton from '@/Components/PrimaryButton.vue';
import Link from "@/Components/Link.vue";
import AccLink from "@/Components/AccLink.vue";
import ChevronRight from "vue-material-design-icons/ChevronRight.vue";

const isScrolled = ref(false);

const acc = ref(false)

const toggleAcc = () => {
    acc.value = !acc.value
}

</script>

<template>
    <div>
        <div
            class="fixed top-0 left-0 right-0 z-10 md:block hidden border-b text-gray-950"
        >
            <nav
                :class="[
                    'flex justify-between  ml-32 mr-32 bg-white bg-cover',
                    { 'bg-black bg-opacity-90': isScrolled },
                ]"
                class="flex justify-end p-2 px-8 bg-white bg-cover"
            >
                <ul class="flex justify-between items-center gap-4">
                    <li class="mr-4">
                        <NavLink to="/home"
                            ><img
                                src="/netflix-logo.png"
                                class="cursor-pointer"
                                width="120"
                                alt=""
                        /></NavLink>
                    </li>
                </ul>

                <li
                class="relative flex items-center  text-black">
                    <AccountBox
                        @click="toggleAcc"
                        class="cursor-pointer"
                        :size="48"
                        fillColor="#000000"
                    />
                    <div
                     v-if="!acc"
                        class="absolute hidden group-hover:flex top-[3.6rem] right-[1rem] text-[15px] font-mono bg-gray-100 w-52 h-auto"
                    >
                        <MenuUp
                            :size="34"
                            fillColor="#000000"
                            class="mt-4 absolute -top-11 -right-2"
                        />
                        <div class="mt-2">
                            <div class="flex items-center gap-2 mb-2 ml-2">
                                <AccountBox
                                    :size="28"
                                    fillColor="#000000"
                                /><AccLink class="hover:underline">Kids</AccLink>
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <PencilOutline
                                    :size="28"
                                    class="flex items-center"
                                    fillColor="#000000"
                                /><AccLink class="hover:underline"
                                    >Manage Profiles</AccLink
                                >
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <AccountOultline
                                    :size="28"
                                    class="flex items-center"
                                    fillColor="#000000"
                                /><AccLink
                                    href="route('account')"
                                    class="hover:underline"
                                    >Account</AccLink
                                >
                            </div>
                            <div class="flex items-center gap-2 mb-2 ml-3">
                                <HelpCircleOutline
                                    :size="28"
                                    class="flex items-center"
                                    fillColor="#000000"
                                /><AccLink class="hover:underline"
                                    >Help center</AccLink
                                >
                            </div>
                            <div
                                class="flex items-center justify-center border-t mt-5 mb-6 -mr-10"
                            >
                                <AccLink
                                    class="hover:underline mt-6"
                                    @click="submit"
                                    >Sign out of netflix</AccLink
                                >
                            </div>
                        </div>
                    </div>
                    <MenuDown
                        class="cursor-pointer group-hover:hidden"
                        :size="30"
                        fillColor="#000000"
                    />
                </li>
                <!-- <div class="w-full absolute bottom-0 h-full left-0 bg-opacity-10 z-[-1] opacity-5 bg-gradient-to-t from-black to-gray-700 via-gray-700" /> -->
            </nav>
        </div>
        <div class="bg-[#FAFAFA] bg-cover w-full h-screen text-black absolute">
            <div

                class="absolute top-20 left-36 flex h-screen pr-10"
                id="sideBar"
            >
                <div class="border-r-4 pr-10">
                    <AccLink to="/home" class="text-black">
                        <button
                            class="flex gap-4 items-center mt-4 px-4 py-1 w-64 rounded-sm hover:bg-gray-200 transition ease-in-out duration-100"
                        >
                            <ArrowLeft
                                :size="28"
                                fillColor="#000000"
                                class="cursor-pointer"
                            />
                            Back to Netflix
                        </button>
                    </AccLink>
                    <AccLink to="/account">
                        <button
                            class="flex gap-4 items-center mt-10 px-4 py-1 font-semibold w-64 rounded-sm hover:bg-gray-200 transition ease-in-out duration-100"
                        >
                            <HomeVariant
                                :size="28"
                                fillColor="#000000"
                                class="cursor-pointer"
                            />
                            Overview
                        </button>
                    </AccLink>
                </div>
                <div class="ml-10 mt-2">
                    <h1 class="text-[40px] font-bold">Account</h1>
                    <h1 class="text-[20px] text-black/80">Membership Details</h1>
                    <div class="bg-white border mt-4 p-2  pl-4 border-gray-300 rounded-md w-[800px] h-auto [-20px">
                        <h3 class="text-[16px] mt-1 text-gray-200 font-bold mb-2 bg-gradient-to-r from-[#3B409F] via-[#3F41A4] to-[#855AEE] w-[14rem] px-4 py-1.5 rounded-r-full -ml-4">Member since July 2024</h3>
                        <h1 class="text-[24px] font-semibold mb-2">Basic plan</h1>
                        <p class="mb-2">Next payment: 11 August 2024</p>
                        <h1 class="mb-2">VISA ••••• •••• •••• 6554</h1>
                        <AccLink to="/home" class="text-black border-t mb-4 border-gray-300 mt-4 w-full ">
                            <button
                                class="flex gap-4 items-center justify-between   w-[770px] mt-2 p-3 rounded-md hover:bg-gray-200 transition ease-in-out duration-100"
                            >
                            <h1 class="text-black font-bold">Manage Membership</h1>
                            <ChevronRight
                                :size="28"
                                fillColor="#000000"
                                class="cursor-pointer"
                            />
                            </button>
                        </AccLink>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
