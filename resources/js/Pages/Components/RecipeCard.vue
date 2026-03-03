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
import RecipeProfile from './RecipeProfile.vue';
import { computed } from 'vue';
const created = computed (() => new Date(props.recipe.created_at).toLocaleString())

</script>
<template>
    <div :class="{'highlight': highlight, 'user': user, 'owner': owner, 'friend' : friend, 'fire' : fire, 'saved': saved}"
    class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold">
        <div class='w-full'>
            <div class='flex flex-col gap-0.5 w-full justify-start'>
                <div class='flex flex-col justify-between items-start'>
                    <RecipeProfile :user='recipe.user'/>
                    <p>{{ created }}</p>
                    <div v-if="saved" class='p-3 self-center rounded-full bg-orange-500  font-semibold'>Saved</div>
                </div>
                <h2 class='fs-6'><Link :href="route('recipes.show', recipe)">{{ recipe.title }}</Link></h2>
                <div v-if="recipe.image_path" class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img :src="route('image.recipes',recipe.image_path)" class='aspect-auto h-fit max-h-80 self-center'>
                </div>
                <div class="grid grid-cols-2 grid-rows-2 gap-2 p-4">
                    <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Prep: {{ recipe.preparation_time }} mins</p>
                    <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Cook: {{ recipe.cooking_time }} mins</p>
                    <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">{{ recipe.difficulty }}</p>
                    <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Serves {{ recipe.servings }}</p>
                </div>
                <ul v-if="recipe.tags" class='flex flex-row flex-wrap gap-2'>
                    <span v-for="tag in recipe.tags" class='bg-blue-500 text-white p-2 rounded-md'>{{ tag.name }}</span>
                </ul>
                <div class='flex flex-row justify-between py-2'>
                    <div class='flex flex-row gap-2 items-center'>
                        {{ recipe.comments.length }} Commented
                    </div>
                    <div v-if="recipe.saved_users" class='flex flex-row gap-2 items-center'>
                        {{ recipe.saved_users.length }} Saved
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>