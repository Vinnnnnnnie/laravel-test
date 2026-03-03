<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue';
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
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
const ingredients = ref([{ingredient: ''}]);
const steps = ref([{step: ''}]);
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
        <div class='bg-gray-100 dark:bg-gray-900 p-4'>
            <div class="flex flex-col gap-2">
                <h2>Create a New Recipe</h2>
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src='imageUrl' class='aspect-auto h-fit max-h-80 self-center'>
                </div>             
                <Form class='flex flex-col p-4 gap-2' method="POST" :action="route('recipes.store')" enctype="multipart/form-data">
                    <div>
                        <label for="image" class='form-label'>Image</label>
                        <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image">
                    </div>
                    <div>
                        <label for="title" class='form-label'>Recipe Title</label>
                        <input type="text" id="title" name="title" class='form-control w-full' value='' required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="ingredients" class='form-label'>Ingredients</label>
                        <div class="flex flex-row gap-2 items-baseline" v-for="(input, index) in ingredients" :key="`ingredient-${index}`">
                            <input v-model="input.value" name="ingredients[]" class='form-control w-full' required/>
                            <button  type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, ingredients)">Add</button>
                            <button v-show="ingredients.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, ingredients)">Remove</button>
                        </div>

                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="instructions" class='form-label'>Method</label>
                        <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in steps" :key="`step-${index}`">
                            <label for="steps" class='form-label'>{{ index+1 }}.</label>
                            <input v-model="input.value" name="steps[]" class='form-control w-full' required/>
                            <button type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, steps)">Add</button>
                            <button v-show="steps.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, steps)">Remove</button>
                        </div>
                    </div>
                    <div>
                        <label for="preparation_time" class='form-label'>Preparation Time (minutes)</label>
                        <input type="number" id="preparation_time" class='form-control w-full' name="preparation_time" value='' required>
                    </div>
                    <div>
                        <label for="cooking_time" class='form-label'>Cooking Time (minutes)</label>
                        <input type="number" id="cooking_time" class='form-control w-full' name="cooking_time" value='' required>
                    </div>
                    <div>
                        <label class='form-label' for="servings">Servings</label>
                        <input type="number" id="servings" name="servings" class='form-control w-full' value='' required>
                    </div>
                    <div class='w-full'>
                        <label class='form-label'>Difficulty</label>
                        <div class="flex  mb-2">
                            <input name="difficulty" id='easy' type="radio" value="Easy">
                            <label class='form-label' for="easy">Easy</label>
                        </div>
                        <div class="flex  mb-2">
                            <input name="difficulty" id='medium' type="radio" value="Medium">
                            <label class='form-label' for="medium">Medium</label>
                        </div>
                        <div class="flex  mb-2">
                            <input name="difficulty" id='hard' type="radio" value="Hard">
                            <label class='form-label' for="hard">Hard</label>
                        </div>
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
                    <button type="submit" class='btn'>Create Recipe</button>
                </Form>
            </div>
        </div>
        
    </RecipeLayout>
</template>