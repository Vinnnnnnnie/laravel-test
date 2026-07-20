<script setup>
import {inject} from "vue";
const props = defineProps({
    recipe: Object,
    text:String
})
const triggerAction = inject('RecipeListButtonAction')
</script>

<template>
    <button @click="triggerAction(recipe)" type="button">{{ text }}</button>
</template>
