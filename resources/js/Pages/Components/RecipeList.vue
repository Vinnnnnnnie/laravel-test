<script setup>
import RecipeCard from './RecipeCard.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { InfiniteScroll } from '@inertiajs/vue3'

const page = usePage();

const user = computed(() => page.props.auth.user);
const savedRecipeIds = computed(() => page.props.auth.user.saved_recipes.map((v) => v.recipe_id));

const props = defineProps({ 
    recipes: {
        type: [Array, Object],
        default: []
    }, 
    pagination: Boolean
 });
</script>
<template>
    <InfiniteScroll v-if='recipes' data='recipes' class='2xl:grid 2xl:grid-cols-2 flex flex-col gap-4'>
        <div v-for="recipe in recipes.data" :key="recipe.id" class='col-span-1 row-span-1'>
            <RecipeCard 
                :recipe="recipe"
                :saved="savedRecipeIds.length > 0 && savedRecipeIds.includes(recipe.id)"
                :user="user.id === recipe.user_id"
                >
            </RecipeCard>
        </div>
    </InfiniteScroll>
            <!--RecipeCard.vue-->
            <!-- <x-card href="{{ route('recipes.show', $recipe) }}" 
                :user='$recipe->user_id === $user->id' 
                :friend='$user->friends()->get()->contains($recipe->user_id)'
                :saved='$user->savedRecipes()->get()->contains($recipe->id)'
                :recipe='$recipe'
            /> -->
    <ul v-else>
        <li>
            <span class='text-3xl py-4'>
                No recipes found. Why not 
                <Link class='btn flex flex-row gap-2' :href="route('recipes.create')"> Create a New Recipe?</Link>
            </span>
        </li>
    </ul>
</template>