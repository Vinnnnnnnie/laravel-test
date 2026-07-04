<script setup>
import { ArrowUpIcon, ArrowDownIcon, XCircleIcon, XMarkIcon, PlusCircleIcon, PlusIcon } from '@heroicons/vue/16/solid';
import { usePage } from '@inertiajs/vue3';
const props = defineProps({
    ingredients: Object
})

function addToArray(value, fieldType)
{
    fieldType.push({});
}
function removeFromArray(index, fieldType)
{
    fieldType.splice(index, 1);
}
</script>
<template>
    <div class="flex flex-col gap-2">
        <div class="flex flex-row gap-2 items-baseline" v-for="(input, index) in ingredients" :key="`ingredient-${index}`">
            <input v-model="input.name" name="ingredients[]" class='bg-gray-200 dark:bg-gray-800 p-2  w-full' required/>
            <!-- Remove Ingredient -->
            <button 
                v-show="ingredients.length > 1" 
                type="button" 
                class="cursor-pointer rounded-full border-2 border-red-500 p-2" 
                @click="removeFromArray(index, ingredients)">
                <XMarkIcon class="size-4"/>
            </button>
        </div>
        <!-- Add Ingredient -->
        <button 
            type="button" 
            class="cursor-pointer self-center flex flex-row gap-2 justify-center items-center rounded-full border-2 border-green-500 p-2 w-fit" 
            @click="addToArray(input, ingredients)">
            <PlusIcon class="size-4"/> Add Ingredient <PlusIcon class="invisible size-4"/>
        </button>
    </div>
</template>