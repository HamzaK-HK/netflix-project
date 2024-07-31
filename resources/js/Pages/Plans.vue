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
import AccLink from "@/Components/AccLink.vue";
import ChevronRight from "vue-material-design-icons/ChevronRight.vue";
import Check from "vue-material-design-icons/Check.vue";
import Link from "@/Components/Link.vue";
import PostPlans from "../Components/PostPlans.vue";


const isScrolled = ref(false);

const acc = ref(false)

const showOverlay = ref(false)

const emit = defineEmits(["close"]);



const toggleAcc = () => {
    acc.value = !acc.value
}

</script>

<template>
    <div class="bg-white w-full h-screen">
        <nav class="bg-black pl-10 py-4 flex">
            <img
                                src="/netflix-logo.png"
                                class="cursor-pointer border-r-2 border-gray-300 pr-2 "
                                width="120"
                                alt=""
                        >
                        <h1 class="text-[26px] ml-2 text-white font-semibold">Plans</h1>
        </nav>


        <div class="ml-10 mt-4 flex justify-between">
            <!-- <h3 class="mb-1">STEP 1 OF 3</h3> -->
            <h1 class="text-[25px] font-semibold mb-1">Choose the plan that's right for you</h1>
            <button @click="showOverlay = true" class="text-blue-600 underline mr-10">Plans</button>

        </div>
        <PostPlans v-if="showOverlay" @close="showOverlay = false" />


       <div class="mt-4 ml-4 flex justify-center gap-2">
        <div class="p-1 border  border-gray-400 rounded-md w-1/6 h-auto">
            <!-- <h1 class="text-[20px] text-white bg-red-600">Most Popular</h1> -->
            <div class=" bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#eb0606] text-white font-bold p-2 rounded-md w-full h-1/5">
                <h1 class="text-[20px]">Premium</h1>
                <h1 class="text-[16px] font-normal">4K + HDR</h1>
                <!-- <input type="checkbox" class="" name="" id=""> -->
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Monthly price</h3>
                    <h1 class="text-gray-700">Rs1,100</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Resolution</h3>
                    <h1 class="text-gray-700">4K(Ultra HD) + HDR</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Video quality</h3>
                    <h1 class="text-gray-700">Best</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4  text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Supported devices</h3>
                    <h1 class="text-gray-700">Mobile phone, tablet, Tv, computer</h1>
                </div>
            </div>
        </div>
        <div class="p-1 border border-gray-400 rounded-md w-1/6 h-[26rem]">
            <div class=" bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#1f143d] text-white font-bold p-2 rounded-md w-full h-1/5">
                <h1 class="text-[20px]">Standard</h1>
                <h1 class="text-[16px] font-normal">1080p</h1>
                <!-- <input type="checkbox" class="" name="" id=""> -->
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Monthly price</h3>
                    <h1 class="text-gray-700">Rs800</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Resolution</h3>
                    <h1 class="text-gray-700">1080 (Full HD)</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Video quality</h3>
                    <h1 class="text-gray-700">Better</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4  text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Supported devices</h3>
                    <h1 class="text-gray-700">Mobile phone, tablet, Tv, computer</h1>
                </div>
            </div>
        </div>
        <div class="p-1 border border-gray-400 rounded-md w-1/6 h-[26rem]">
            <div class=" bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#492b95] text-white font-bold p-2 rounded-md w-full h-1/5">
                <h1 class="text-[20px]">Basic</h1>
                <h1 class="text-[16px] font-normal">720p </h1>

                <!-- <input type="checkbox" class="" name="" id=""> -->
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Monthly price</h3>
                    <h1 class="text-gray-700">Rs450</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Resolution</h3>
                    <h1 class="text-gray-700">720p (HD)</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Video quality</h3>
                    <h1 class="text-gray-700">Good</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4  text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Supported devices</h3>
                    <h1 class="text-gray-700">Mobile phone, tablet, Tv, computer</h1>
                </div>
            </div>
        </div>
        <div class=" p-1 border border-gray-400 rounded-md w-1/6 h-[26rem]">
            <div class="bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#855AEE] text-white font-bold p-2 rounded-md w-full h-1/5">
                <h1 class="text-[20px]">Mobile</h1>
                <h1 class="text-[16px] font-normal">480p</h1>
                <!-- <input type="checkbox" class="" name="" id=""> -->
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Monthly price</h3>
                    <h1 class="text-gray-700">Rs250</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Resolution</h3>
                    <h1 class="text-gray-700">480p</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Video quality</h3>
                    <h1 class="text-gray-700">Good</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4  text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class=" border rounded-full   border-transparent bg-gray-400" />
                <div>
                    <h3>Supported devices</h3>
                    <h1 class="text-gray-700">Mobile phone, tablet</h1>
                </div>
            </div>
        </div>


       </div>
    </div>
</template>
