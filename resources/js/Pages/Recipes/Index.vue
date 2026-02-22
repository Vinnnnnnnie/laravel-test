<script setup>
import RecipeList from '../Components/RecipeList.vue'
import RecipeLayout from '../Components/RecipeLayout.vue';
const props = defineProps({ 
    recipes: Object,
    user: Object
 })
</script>
<template>
    <RecipeLayout :user>
        <div class='flex justify-between mb-4 gap-8'>
            <div class='w-full'>
                <h2>Recent Recipes</h2>
                <RecipeList :recipes='recipes'/>
            </div>
        </div>
    </RecipeLayout>
</template>