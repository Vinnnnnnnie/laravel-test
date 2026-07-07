<script setup>
import { ref } from 'vue';
import RecipeListItem from '../Components/RecipeListItem.vue';
const props = defineProps({
    result: String
});
const searchResults = ref('');

</script>
<template>
    <ul class="flex flex-col gap-2">
        <RecipeListItem v-for="recipe in result.recipes" :recipe/>
    </ul>
</template>