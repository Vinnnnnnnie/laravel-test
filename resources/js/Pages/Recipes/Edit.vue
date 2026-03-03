<script setup>
import { Form } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { ref } from 'vue';
const props = defineProps({
    recipe: Object,
    tags: Object
})

const imageUrl = ref('');
const previewImage = (event) => {
    const file = event.target.files[0]
    if (!file) return
    console.log(event)
    const reader = new FileReader()
    reader.onload = (e) => {
        imageUrl.value = e.target.result
    }
    reader.readAsDataURL(file)
}
const ingredients = ref(props.recipe.ingredients);
const steps = ref(props.recipe.steps);

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
    <RecipeLayout>
        <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
            <h2>Edit Recipe</h2>
            <Form class='flex flex-col gap-4' :action="route('recipes.update', recipe.id)" method='POST' enctype="multipart/form-data">
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src="imageUrl" class='aspect-auto h-fit max-h-80 self-center'>
                </div>            
                <div hidden>
                    <label class='text-xl font-semibold' for="id">Recipe id</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="id" name="id" :value='recipe.id' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold form-label' for="image">Image</label>
                    <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image">
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="title">Recipe Title</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="title" name="title" :value='recipe.title' required>
                </div>
                 <div>
                    <label for="ingredients" class='form-label'>Ingredients</label>
                    <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in ingredients" :key="`ingredient-${index}`">
                        <input  v-model="input.name" name="ingredients[]" class='form-control w-full' required/>
                        <button type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, ingredients)">Add</button>
                        <button v-show="ingredients.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, ingredients)">Remove</button>
                    </div>

                </div>
                <div>
                    <label for="instructions" class='form-label'>Method</label>
                    <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in steps" :key="`step-${index}`">
                        <label for="steps" class='form-label'>{{ index+1 }}.</label>
                        <input  v-model="input.step" name="steps[]" class='form-control w-full' required/>
                        <button type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, steps)">Add</button>
                        <button v-show="steps.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, steps)">Remove</button>
                    </div>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="preparation_time">Preparation Time (minutes)</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="preparation_time" name="preparation_time" :value='recipe.preparation_time' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="cooking_time">Cooking Time (minutes)</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="cooking_time" name="cooking_time" :value='recipe.preparation_time' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="servings">Servings</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="servings" name="servings" :value='recipe.servings' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="difficulty">Difficulty</label>
                    <select v-model="recipe.difficulty" class='bg-gray-200 dark:bg-gray-800 p-2' id="difficulty" name="difficulty" required>
                        <option value="">Select Difficulty</option>
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>
                </div>
                <ul class=" select-none  flex flex-row gap-2 flex-wrap">
                    <li v-for="(tag, index) in tags" :key="`tag-${index}`">
                        <input type="checkbox" :id="tag.id" name='tags[]' :value="tag.id" class="hidden peer" />
                        <label :for="tag.id" class="select-none bg-gray-500 cursor-pointer flex items-center justify-center rounded-lg  
                                py-3 px-6 font-bold transition-colors duration-200 ease-in-out peer-checked:bg-blue-500  ">
                                <span>{{ tag.name }}</span>
                        </label>
                    </li>
                </ul>
                <button class='bg-gray-200 dark:bg-gray-800 p-2' type='submit'>Save Recipe</button>
            </form>
        </div>
    </RecipeLayout>
</template>