<script setup>
import { ClipboardIcon, ClockIcon, ChartBarIcon, UsersIcon} from '@heroicons/vue/16/solid';
import { computed } from 'vue';
import RecipeTags from './RecipeTags.vue';
import RecipeListItemButton from './RecipeListItemButton.vue';
import RecipeTime from './RecipeTime.vue';

import UserDetails from './UserDetails.vue';
import {usePage} from "@inertiajs/vue3";
const props = defineProps({
    recipe: Object
})
const page = usePage()

const savedRecipeIds = computed(() => page.props.auth.user.saved_recipes.map((v) => v.recipe_id));

</script>
<template>
    <li  class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 flex justify-between gap-2 font-semibold"
        :class="{'saved': savedRecipeIds.includes(recipe.id)}">
        <div v-if="recipe.image_path" class='w-min flex justify-center align-items-center'>
            <img :src="route('image.recipes',{
                'filename':recipe.image_path,
                'height':125,
                'width':125
            })" class='aspect-auto rounded-xl h-fit max-h-80 self-center max-w-100' :alt="'Image of '+recipe.title">
        </div>
        <div class="w-100">
            <div class='flex gap-2 justify-between items-start'>
                <UserDetails :user="recipe.user"/>

                <RecipeTime :time="recipe.created_at"/>
            </div>
            <h2 class='fs-6'>{{ recipe.title }}</h2>
            <RecipeTags :recipe-tags="recipe.tags"/>

        </div>
        <div class="flex gap-2">
            <div>
                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><ClipboardIcon class="size-4"/>Prep: {{ recipe.preparation_time }} mins</p>
                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><ClockIcon class="size-4"/> Cook: {{ recipe.cooking_time }} mins</p>
            </div>
            <div>
                <p class="p-2 rounded-md  border-1 font-semibold"
                :class="{
                    'border-green-500':recipe.difficulty === 'Easy',
                    'border-amber-500':recipe.difficulty === 'Medium',
                    'border-red-500':recipe.difficulty === 'Hard'}"><ChartBarIcon class="size-4"/>{{ recipe.difficulty }}</p>
                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><UsersIcon class="size-4"/>Serves {{ recipe.servings }}</p>
            </div>
        </div>
        <RecipeListItemButton :recipe text="Schedule"/>
    </li>
</template>
