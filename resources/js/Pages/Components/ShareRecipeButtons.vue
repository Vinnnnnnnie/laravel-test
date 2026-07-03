<script setup>
import { ShareIcon } from '@heroicons/vue/16/solid';
import { showToast } from '../../Composables/useToast';

const props = defineProps({
    recipe: Object,
});

async function copyURL() {
    try {
        await navigator.clipboard.writeText(window.location.href);
        showToast('success', 'Copied');
    } catch($e) {
        showToast('error', 'Cannot copy');
        console.log($e)
    }
}

async function shareRecipe() {
    if (navigator.share) {
        try {
            await navigator.share({
                title: 'RecipeShare: ' + props.recipe.title,
                text: 'Check out this recipe for ' + props.recipe.title + '!', 
                url: window.location.href,
            });
            showToast('success', 'Shared');
            // TODO: Maybe new column in recipe table and increment on share?
            console.log('Successfully shared recipe');
        } catch($e) {
            console.log('Error sharing: ', $e);
        }
    } else {
        // Unsupported Browser so copy link instead
        await copyURL();
        // TODO: Also increment share here
    }
}
</script>
<template>
    <button 
        @click="shareRecipe()" 
        type='button' 
        class="p-3 flex items-center gap-2 cursor-pointer rounded-sm bg-blue-500 dark:border-blue-500 border-1 font-bold hover:bg-none"> 
        <ShareIcon class="size-4"/> Share
    </button>
</template>