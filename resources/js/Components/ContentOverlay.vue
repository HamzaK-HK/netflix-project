<script setup>
import { ref, toRefs } from 'vue';
import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
import Comment from 'vue-material-design-icons/Comment.vue';
import PlayCircleOutline from 'vue-material-design-icons/PlayCircleOutline.vue';
import PlusCircleOutline from 'vue-material-design-icons/PlusCircleOutline.vue';
import ChevronDownCircleOutline from 'vue-material-design-icons/ChevronDownCircleOutline.vue';

defineEmits(['selectedPost']);
const props = defineProps(['postByUser']);
const { postByUser } = toRefs(props);

let isHover = ref(false);
</script>

<template>
    <div
        @mouseenter="isHover = true"
        @mouseleave="isHover = false"
        class="flex items-center justify-center max-w-[300px] cursor-pointer relative"
        @click="$emit('selectedPost', postByUser)"
    >
        <div
            v-if="isHover"
            :class="isHover ? 'bg-black bg-opacity-40' : ''"
            class="absolute w-full h-full z-50 flex items-center justify-around text-lg font-extrabold text-white"
        >
            <div class="flex items-center justify-around w-[50%]">
                <div class="flex items-center justify-center">
                    <ThumbUpOutline fillColor="#FFFFFF" :size="30"/>
                    <div class="pl-1">{{ postByUser.likes.length }}</div>
                </div>
                <div class="flex items-center justify-center">
                    <Comment fillColor="#FFFFFF" :size="30"/>
                    <div class="pl-1">{{ postByUser.comments.length }}</div>
                </div>
            </div>
        </div>



    </div>
</template>
