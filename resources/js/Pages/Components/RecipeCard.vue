<script setup>
const props = defineProps({ 
    recipe: Object,
    highlight: Boolean,
    user: Boolean,
    owner: Boolean,
    friend: Boolean,
    fire: Boolean,
    saved: Boolean
 });
 import { Link } from '@inertiajs/vue3';
</script>
<template>
<div :class="{'highlight': highlight, 'user': user, 'owner': owner, 'friend' : friend, 'fire' : fire, 'saved': saved, 'card': true}">
    <div class='w-full'>
        <div class='flex flex-col gap-0.5 w-full justify-start'>
            <div class='flex justify-between items-center'>
                <div v-if="saved" class='size-10 text-orange-500'>Saved</div>
            </div>
            
            <h2 class='fs-6'><Link :href="route('recipes.show', recipe)">{{ recipe.title }}</Link></h2>
            <div v-if="recipe.image_path" class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                <img :src="route('image.recipes',recipe.image_path)" class='aspect-auto h-fit max-h-80 self-center'>
            </div>
            <p class='flex items-center flex-row gap-2'> Preparation - {{ recipe.preparation_time }} Minutes</p>
            <p class='flex items-center flex-row gap-2'> Cooking - {{ recipe.cooking_time }} Minutes</p>
            <p class='flex items-center flex-row gap-2'> Difficulty - {{recipe.difficulty }}</p>
            <ul v-if="recipe.tags" class='flex flex-row flex-wrap gap-2'>
                <span v-for="tag in recipe.tags" class='bg-blue-500 text-white p-2 rounded-md'>{{ tag.name }}</span>
            </ul>
            <div class='flex flex-row justify-between py-2'>
                <div class='flex flex-row gap-2 items-center'>
                    Comments: {{ recipe.comments.length }}
                </div>
                <div v-if="recipe.savedUsers" class='flex flex-row gap-2 items-center'>
                    Saves: {{ recipe.savedUsers.length }}
                </div>
            </div>
        </div>
    </div>
</div>
</template>