<script setup>
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

</script>

<template>
    <div>
        <nav>
            <ul class="flex justify-between items-center  p-6 px-[120px]">
                <li><NavLink><img src="/netflix-logo.png" width="150" alt=""></NavLink></li>
                <li><NavLink to="/login"><PrimaryButton>Sign In</PrimaryButton></NavLink></li>
            </ul>
        </nav>
    </div>

</template>
