<script setup>
// import { Link } from '@inertiajs/vue3';

import NavLink from "@/Components/NavLink.vue";
import MenuDown from "vue-material-design-icons/MenuDown.vue";
import MenuUp from "vue-material-design-icons/MenuUp.vue";
import BellOutline from "vue-material-design-icons/BellOutline.vue";
import BellOffOutline from "vue-material-design-icons/BellOffOutline.vue";
import { onMounted, ref } from "vue";
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
import router from "../router/route";


const isScrolled = ref(false);

const acc = ref(false)

const showOverlay = ref(false)

const emit = defineEmits(["close"]);



const toggleAcc = () => {
    acc.value = !acc.value
}


const plans = ref([]);

// Method to get the background class based on plan type
const planBackgrounds = {
    'premium': 'bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#eb0606]',
    'standard': 'bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#1f143d]',
    'basic': 'bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#492b95]',
    'mobile': 'bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#855AEE]',
};

const getPlanBackgroundClass = (planType) => {
    return planBackgrounds[planType] || 'bg-gradient-to-br from-[#3B409F] via-[#3F41A4] to-[#eb0606]'; // Fallback color
};

// Fetch plans from API
const getPlans = async () => {
    try {
        const response = await axios.get('/api/getplans');
        plans.value = response.data.plans;
    } catch (error) {
        console.error('Failed to fetch plans', error);
    }
};

// Call fetchPlans on component mount
onMounted(() => {
    getPlans();
});

const navigateToPlan = (planId) => {
      router.push({ name: 'Stripe', params: { type: planId } });
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
        <div
            v-for="plan in plans"
            :key="plan.id"
            class="p-1 border border-gray-400 rounded-md w-1/6 h-auto pb-8 cursor-pointer transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-gray-900 hover:shadow-xl"
            @click="navigateToPlan(plan.plan_type)"
        >
            <div :class="[getPlanBackgroundClass(plan.plan_type), 'text-white font-semibold p-2 rounded-md w-full h-1/5']">
                <h1 class="text-[20px] uppercase">{{ plan.plan_type }}</h1>
                <h1 class="text-[16px] font-normal">{{ plan.resolution }}</h1>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class="border rounded-full border-transparent bg-gray-400" />
                <div>
                    <h3>Monthly price</h3>
                    <h1 class="text-gray-700">{{ plan.monthly_price }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class="border rounded-full border-transparent bg-gray-400" />
                <div>
                    <h3>Resolution</h3>
                    <h1 class="text-gray-700">{{ plan.resolution }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 border-b pb-2 border-gray-300 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class="border rounded-full border-transparent bg-gray-400" />
                <div>
                    <h3>Video quality</h3>
                    <h1 class="text-gray-700">{{ plan.video_quality }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-4 text-gray-500 font-semibold text-[16px]">
                <Check :size="20" fillColor="#ffffff" class="border rounded-full border-transparent bg-gray-400" />
                <div>
                    <h3>Supported devices</h3>
                    <h1 class="text-gray-700">{{ Array.isArray(plan.supported_devices) ? plan.supported_devices.join(", ") : plan.supported_devices }}</h1>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
