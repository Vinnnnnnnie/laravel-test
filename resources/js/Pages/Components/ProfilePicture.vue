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
    <div :class="'dark:bg-gray-950 min-h-10 aspect-square overflow-hidden max-h-'+size+' max-w-'+size+' min-w-'+size+' min-h-'+size+' w-'+size+' h-'+size+' flex items-center justify-center bg-gray-50 align-items-center rounded-sm'">
        <img :src="route('image.users', image)" class='w-full h-full object-cover'>
    </div>
</template>