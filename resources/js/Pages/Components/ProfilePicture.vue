<script setup>
const props = defineProps({ 
    size: {
        type: Number,
        default: 30
    },
    image: {
        type: String,
        default: null
    }
 });
</script>
<template>
    <div :class="
        {
            'dark:bg-gray-950 aspect-square overflow-hidden flex items-center justify-center bg-gray-50 align-items-center rounded-sm': true,
            'max-h-10 max-w-10 min-w-10 min-h-10 w-10 h-10' : size === 10,
            'max-h-20 max-w-20 min-w-20 min-h-20 w-20 h-20' : size === 20,
            'max-h-30 max-w-30 min-w-30 min-h-30 w-30 h-30' : size === 30,
            'max-h-40 max-w-40 min-w-40 min-h-40 w-40 h-40' : size === 40,
            'max-h-50 max-w-50 min-w-50 min-h-50 w-50 h-50' : size === 50
        }">
        <img :src="route('image.users', image)" class='w-full h-full object-cover'>
    </div>
</template>