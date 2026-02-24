<script setup>
import RecipeList from '../Components/RecipeList.vue'
import RecipeLayout from '../Components/RecipeLayout.vue';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const user = computed(() => page.props.auth.user);

const props = defineProps({ 
    recipes: Object,
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