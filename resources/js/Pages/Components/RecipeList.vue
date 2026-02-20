<script setup>
defineProps({ 
    recipes: Object,
    pagination: Boolean
 })
</script>
<template>
    <ul v-if='recipes.length() > 0' class='2xl:grid 2xl:grid-cols-2 flex flex-col gap-4'>
        <li v-for="recipe in recipes" class='col-span-1 row-span-1'>
            <div>
                {{recipe.id}}
                {{recipe.title}}
            </div>
            <!--RecipeCard.vue-->
            <!-- <x-card href="{{ route('recipes.show', $recipe) }}" 
                :user='$recipe->user_id === $user->id' 
                :friend='$user->friends()->get()->contains($recipe->user_id)'
                :saved='$user->savedRecipes()->get()->contains($recipe->id)'
                :recipe='$recipe'
            /> -->
        </li>
    </ul>
    <ul v-else>
        <li>
            <span class='text-3xl py-4'>
                No recipes found. Why not 
                <Link class='btn flex flex-row gap-2' :href="route('recipes.create')"><x-bi-plus-circle/> Create a New Recipe?</Link>
            </span>

        </li>
    </ul>
</template>