<script setup>
import { ref } from 'vue';
import RecipeResults from '../Components/RecipeResults.vue'
import { showToast } from '../../Composables/useToast.js';

const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


const recipeTerm = ref('')
let result = ref('');
let recipes = ref([])
async function searchRecipes(recipeTerm) {
    console.log('recipeTerm:', recipeTerm)
    try {
        let response = await fetch(route('recipes.searchByTerm', recipeTerm), {
            method:'Get',
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        if (!response.ok) {
            showToast('error', 'Search has failed!');
            return;
        }
        // Display recipes in a nice list format

        result.value = await response.json();
        console.log('Results:', result)

        recipes.value = result.value.recipes
        console.log('Recipes:', recipes)

    }
    catch(error) {
        showToast('error', error);
        console.log(`Error: ${error}`)
    }
}

</script>
<template>
    <label for="recipe-term">Search Recipes</label>
    <input id="recipe-term"
        name="recipe-term" @keyup="searchRecipes(recipeTerm)"
        class="bg-gray-100 text-gray-100 p-2 dark:bg-gray-900 rounded-sm "
        v-model="recipeTerm" value="" type="text"/>
    <RecipeResults :recipes/>
</template>
