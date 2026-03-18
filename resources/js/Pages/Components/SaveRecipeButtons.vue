<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const page = usePage();
const savedRecipeIds = computed(() => page.props.auth.user.saved_recipes.map((v) => v.recipe_id));
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const props = defineProps({
    recipe: Object,
});

async function saveRecipe(recipe) {
    try {
        let response = await fetch(route('users.addSavedRecipe', recipe), {
                method:'Post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: recipe
            })

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        page.props.auth.user.saved_recipes.push({
            'recipe_id' : recipe.id,
            'title' : recipe.title
        })
        console.log('Recipe:',recipe)
        const result = await response.json();
        alert(result);
    }
    catch(error)
    {
        console.log(`Fuck we fucked: ${error}`)
    }
}
async function removeRecipe(recipe) {
    try {
        let response = await fetch(route('users.removeSavedRecipe', recipe), {
                method:'Delete',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: recipe
            })

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        page.props.auth.user.saved_recipes = page.props.auth.user.saved_recipes.filter(saved => saved.recipe_id !== recipe.id);
        const result = await response.json();
        alert(result);
    }
    catch(error)
    {
        console.log(`Fuck we fucked: ${error}`)
    }
}
</script>
<template>
    <button v-if='savedRecipeIds.includes(recipe.id)' @click="removeRecipe(recipe)" type='button' class="p-3 cursor-pointer rounded-full bg-orange-500 dark:border-orange-500 border-1 font-bold hover:bg-none">Remove Recipe</button>
    <button v-else @click="saveRecipe(recipe)" type='button' class="p-3 cursor-pointer rounded-full border-orange-500 dark:border-orange-500 border-1 hover:bg-orange-500 font-semibold">Save Recipe</button>
</template>
