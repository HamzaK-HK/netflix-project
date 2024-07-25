<script setup>
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ChevronRight from 'vue-material-design-icons/ChevronRight.vue';
import Link from '@/Components/Link.vue';
// import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="mb-4">
            <h1 class="text-5xl font-bold text-white">Unlimited movies, TV shows, and more</h1>
        </div>
        <div class="mb-4">
            <h1 class="text-2xl font-medium text-white">Watch anywhere. Cancel anytime.</h1>
        </div>
        <div class="mb-4">
            <h2 class="text-lg font-medium text-white">Ready to watch? Enter your email to create or restart your membership.</h2>
        </div>
        <div class="flex flex-col items-center mt-10 gap-4">
            <!-- <div class="mb-5">
                <h1 class="text-5xl font-bold text-white">Unlimited movies, TV shows, and more</h1>
            </div> -->
            <div class="flex items-center justify-center gap-4">
                <TextInput
                    class="bg-black opacity-60 border border-white  px-16 py-4 text-gray-900"
                    placeholder="Email address"
                />
                <PrimaryButton class="px-6 py-4 text-white">
                    Get started
                    <ChevronRight :size="24" fillColor="#ffffff" />
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
