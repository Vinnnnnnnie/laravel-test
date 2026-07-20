<script setup>
const props = defineProps({
    user: Object,
    username: String,
    imagePath: String,
})

</script>
<template>
    <div v-if="imagePath" class='w-min flex justify-center align-items-center'>
        <img :src="route('image.users',{
            'filename':imagePath,
            'height':50,
            'width':50
        })" class='aspect-auto rounded-xl h-fit max-h-80 self-center max-w-100' :alt="'Image of '+username">
    </div>
</template>
