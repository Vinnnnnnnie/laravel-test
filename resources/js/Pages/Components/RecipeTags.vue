<script setup>
const props = defineProps({
    recipeTags: Array
})
</script>
<template>
    <ul v-if="recipeTags.length > 0" class='flex flex-row flex-wrap gap-2'>
        <li v-for="tag in recipeTags" class='bg-blue-500 text-white p-2 rounded-md'>{{ tag.name }}</li>
    </ul>
    <ul v-else class='flex flex-row flex-wrap gap-2'>
        <li class='bg-gray-500 text-white p-2 rounded-md'>No Tags</li>
    </ul>
</template>