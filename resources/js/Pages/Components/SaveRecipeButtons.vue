<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { showToast } from '../../Composables/useToast';
import { HeartIcon } from '@heroicons/vue/16/solid';
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
            showToast('error', 'Error saving Recipe!');
        }
        page.props.auth.user.saved_recipes.push({
            'recipe_id' : recipe.id,
            'title' : recipe.title
        })
        console.log('Recipe:',recipe)
        const result = await response.json();
        showToast('success', result);
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
            showToast('error', 'Error unsaving Recipe!');
        }
        page.props.auth.user.saved_recipes = page.props.auth.user.saved_recipes.filter(saved => saved.recipe_id !== recipe.id);
        const result = await response.json();
        showToast('success', result);
    }
    catch(error)
    {
        console.log(`Fuck we fucked: ${error}`)
    }
}
</script>
<template>
    <button 
        v-if='page.props.auth.user !== 0 && savedRecipeIds.includes(recipe.id)' 
        @click="removeRecipe(recipe)" 
        type='button' 
        class="p-3 flex items-center gap-2 cursor-pointer rounded-sm bg-orange-500 dark:border-orange-500 border-1 font-bold hover:bg-none"> 
        <HeartIcon class="size-4"/> Unsave
    </button>
    <button 
        v-else-if="page.props.auth.user.id !== 0" 
        @click="saveRecipe(recipe)" 
        type='button' 
        class="p-3 flex items-center gap-2 cursor-pointer rounded-sm border-orange-500 dark:border-orange-500 border-1 hover:bg-orange-500 font-semibold">
        <HeartIcon class="size-4"/> Save</button>
</template>
