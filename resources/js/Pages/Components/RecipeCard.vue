<script setup>
const props = defineProps({ 
    recipe: Object,
    highlight: Boolean,
    isUser: Boolean,
    owner: Boolean,
    friend: Boolean,
    fire: Boolean,
    saved: Boolean
 });
import { Link } from '@inertiajs/vue3';
import RecipeProfile from './RecipeProfile.vue';
import { computed } from 'vue';
import SaveRecipeButtons from './SaveRecipeButtons.vue';
import { usePage } from "@inertiajs/vue3";
import { ChatBubbleBottomCenterIcon, ClockIcon, UsersIcon, ClipboardIcon, ChartBarIcon } from '@heroicons/vue/16/solid';
import { HeartIcon } from '@heroicons/vue/16/solid';
import RecipeTags from './RecipeTags.vue';

const page = usePage();

const user = computed(() => page.props.auth.user);

const created = computed (() => new Date(props.recipe.created_at).toLocaleString())

</script>
<template>
    
        <div :class="{'highlight': highlight, 'user': isUser, 'owner': owner, 'friend' : friend, 'fire' : fire, 'saved': saved}"
        class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold">
            <div class='w-full'>
                <div class='flex flex-col gap-0.5 w-full justify-start'>
                    <div class='flex flex-col justify-between items-start'>
                        <RecipeProfile :user='recipe.user' :size="20" :rounded="false"/>
                        <p>{{ created }}</p>
                    </div>
                    <Link :href="route('recipes.show', recipe)" class="style">
                        <h2 class='fs-6'>{{ recipe.title }}</h2>
                        <div v-if="recipe.image_path" class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                            <img :src="route('image.recipes',recipe.image_path)" class='aspect-auto h-fit max-h-80 self-center'>
                        </div>
                    </Link>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2 p-4">
                        <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><ClipboardIcon class="size-4"/>Prep: {{ recipe.preparation_time }} mins</p>
                        <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><ClockIcon class="size-4"/> Cook: {{ recipe.cooking_time }} mins</p>
                        <p class="p-2 rounded-md  border-1 font-semibold" 
                        :class="{
                            'border-green-500':recipe.difficulty === 'Easy',
                            'border-amber-500':recipe.difficulty === 'Medium',
                            'border-red-500':recipe.difficulty === 'Hard'}"><ChartBarIcon class="size-4"/>{{ recipe.difficulty }}</p>
                        <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold"><UsersIcon class="size-4"/>Serves {{ recipe.servings }}</p>
                    </div>
                    <RecipeTags :recipe-tags="recipe.tags"/>
                    <div class='flex flex-row justify-between py-2'>
                        <div class='flex flex-row gap-2 items-center'>
                            {{ recipe.comments.length }} <ChatBubbleBottomCenterIcon class="size-6"/>
                        </div>
                        <SaveRecipeButtons :recipe></SaveRecipeButtons>
                        <div v-if="recipe.saved_users" class='flex flex-row gap-2 items-center'>
                            {{ recipe.saved_users.length }} <HeartIcon class="size-6"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>