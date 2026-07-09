<script setup>
import { ref } from 'vue';
import RecipeListItem from '../Components/RecipeListItem.vue';
const props = defineProps({
    recipes: Array
});
const searchResults = ref('');
console.log('recipes', props.recipes)

</script>
<template>
    <ul class="flex flex-col gap-2">
        <RecipeListItem v-for="recipe in recipes" :recipe/>
    </ul>
</template>