<script setup>
import RecipeList from '../Components/RecipeList.vue'
defineProps({ 
    recipes: Object,
 })
 
 recipes = [
    {
        'id':1,
        'title':'Fuck you'
    },
    {
        'id':2,
        'title':'Fuck you'
    },
    {
        'id':3,
        'title':'Fuck you'
    },
    {
        'id':4,
        'title':'Fuck you'
    },
 ]
</script>
<template>
    <div class='flex justify-between mb-4 gap-8'>
        
        <div class='w-full'>
            <h2>Recent Recipes</h2>
            
            <RecipeList recipes='recipes'/>
        </div>
    </div>
</template>