<script setup>
import { LinkIcon } from '@heroicons/vue/16/solid';
import { showToast } from '../../Composables/useToast';
const props = defineProps({
    recipe: Object
});

const recipe = props.recipe;

async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        showToast('success', 'Copied');
    } catch($e) {
        showToast('error', 'Cannot copy');
        console.log($e)
    }
}

function recipeToText() {
    let recipeText =  `${recipe.title}
By ${recipe.user.username}

Prep Time: ${recipe.preparation_time}
Cook Time: ${recipe.cooking_time}
Servings: ${recipe.servings}
Difficulty: ${recipe.difficulty}

Ingredients:\n`;
    recipe.ingredients.forEach(ingredient => {
        recipeText += `${ingredient.quantity} ${ingredient.measurement}  ${ingredient.name}\n`;
    })
    recipeText += `\nMethod:\n`;
    let index = 1;
    recipe.steps.forEach(step => {
        recipeText += `${index}. ${step.step}\n`;
        index ++;
    });
    recipeText += `\nRecipeShare Link: ` + window.location.href;
    return recipeText;
}
</script>
<template>
    <button
        @click="copyToClipboard(recipeToText())"
        type='button'
        class="p-3 flex items-center gap-2 cursor-pointer rounded-sm bg-blue-500 dark:border-blue-500 border-1 font-bold hover:bg-none">
        <LinkIcon class="size-4"/> Copy Recipe to Text
    </button>
</template>
