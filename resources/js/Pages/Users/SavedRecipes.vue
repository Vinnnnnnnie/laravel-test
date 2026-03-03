<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue';
import RecipeList from '../Components/RecipeList.vue';

const props = defineProps({
        recipes: Object
    }
)
</script>
<template>
    <RecipeLayout>
        <div class='w-full flex flex-col gap-4'>
            <h2 class="text-center">Saved Recipes</h2>
            <RecipeList :recipes='recipes'/>
        </div>
    </RecipeLayout>
    
</template>