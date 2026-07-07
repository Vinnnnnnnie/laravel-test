<script setup>
import { ref } from 'vue';
import RecipeResults from '../Components/RecipeResults.vue'
import { showToast } from '../../Composables/useToast.js';

const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


const recipeTerm = ref('')
let result = ref('')
async function searchRecipes(recipeTerm) {
    try {
        let response = await fetch(route('recipes.searchByTerm', recipeTerm), {
            method:'Get',
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        if (!response.ok) {
            showToast('error', 'Search has failed!');
        }
        // Display recipes in a nice list format
        result = await response.json();
    }
    catch(error) {
        showToast('error', error);
        console.log(`Error: ${error}`)
    }
}

</script>
<template>
    <label for="recipe-term">Search Recipes</label>
    <input id="recipe-term" name="recipe-term" @change="searchRecipes(recipeTerm)" class="bg-gray-100 text-gray-100 p-2 dark:bg-gray-900 rounded-sm " v-model="recipeTerm" value="" type="text"/>
    <RecipeResults :result/>
</template>