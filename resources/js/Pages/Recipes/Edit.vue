<script setup>
import { Form, Head, useForm, usePage } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { ref, computed, watch } from 'vue';
import { showToast } from '../../Composables/useToast';
import { ArrowUpIcon, ArrowDownIcon, XCircleIcon, XMarkIcon, PlusCircleIcon, PlusIcon } from '@heroicons/vue/16/solid';

const props = defineProps({
    recipe: Object,
    tags: Object
})

const page = usePage();
const imageUrl = ref('');
let file
const previewImage = (event) => {
    file = event.target.files[0]
    if (!file) return
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

function shiftUp(index, array) {
    const movedItem = steps.value.splice(index, 1)[0];
    steps.value.splice(index-1, 0, movedItem)

}

function shiftDown(index, array) {
    const movedItem = steps.value.splice(index, 1)[0];
    steps.value.splice(index+1, 0, movedItem)
}

const form = useForm({
    id: page.props.recipe.id,
    title: page.props.recipe.title,
    image: page.props.recipe.image,
    ingredients: page.props.recipe.ingredients,
    steps: page.props.recipe.steps,
    preparation_time: page.props.recipe.preparation_time,
    cooking_time: page.props.recipe.cooking_time,
    servings: page.props.recipe.servings,
    difficulty: page.props.recipe.difficulty,
    tags: page.props.recipe.tags
});

const recipeTagIds = computed(() => page.props.recipe.tags.map((t) => t.id));

const checkedTags = ref(page.props.recipe.tags.map((t) => t.id))
const submit = () => {
    form.image = file;
    form.steps = steps.value;
    form.ingredients = ingredients.value;
    form.difficulty = page.props.recipe.difficulty;
    form.tags = checkedTags
    form.post(route('recipes.update', page.props.recipe.id), {
        onError: () => {
            Object.keys(form.errors).forEach(key => {
                showToast('error', form.errors[key])
            })
        },
        onSuccess: () => {
            showToast('success', 'Recipe updated!');
        }
    })
}

watch(form.errors, (errors)=> {
    console.log('got an error mate')
    for(const error of errors) {
        showToast('error', error)
    }
})
</script>
<template>
    <Head>
        <title>Edit Recipe</title>
    </Head>
    <RecipeLayout>
        <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
            <h2>Edit Recipe</h2>
            <form @submit.prevent="submit" class='flex flex-col gap-4' enctype="multipart/form-data">
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src="imageUrl" class='aspect-auto h-fit max-h-80 self-center'>
                </div>
                <div hidden>
                    <label class='text-xl font-semibold' for="id">Recipe id</label>
                    <input v-model="form.id" class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="id" name="id" required>
                </div>
                <div>
                    <label for="image" class='form-label'>Image</label>
                    <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image" accept="image/*">
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="title">Recipe Title</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' v-model="form.title" type="text" id="title" name="title" required>
                </div>
                 <div>
                    <label for="ingredients" class='form-label'>Ingredients</label>
                    <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in ingredients" :key="`ingredient-${index}`">
                        <input  v-model="input.name" name="ingredients[]" class='form-control w-full' required/>
                        <button v-show="ingredients.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, ingredients)"><XMarkIcon class="size-4"/></button>
                    </div>
                    <button type="button" class="cursor-pointer flex flex-row gap-2 justify-center items-center rounded-full border-2 border-green-500 p-2" @click="addToArray(input, ingredients)"><PlusIcon class="size-4"/> Add Ingredient</button>

                </div>
                <div class="flex flex-col gap-2">
                    <label for="instructions" class='form-label'>Method</label>
                    <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in steps" :key="`step-${index}`">
                        <label for="steps" class='form-label'>{{ index+1 }}.</label>
                        <textarea v-model="input.step" name="steps[]" class='form-control w-full' required/>
                        <div>
                            <button v-show="steps.length > 1 && index > 0" type="button" @click="shiftUp(index, steps)"><ArrowUpIcon class="size-4"/></button>
                            <button v-show="steps.length > 1 && index+1 !== steps.length" type="button" @click="shiftDown(index, steps)"><ArrowDownIcon class="size-4"/></button>
                        </div>
                        <button v-show="steps.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, steps)"><XMarkIcon class="size-4"/></button>

                    </div>
                    <button type="button" class="cursor-pointer flex flex-row gap-2 justify-center items-center rounded-full border-2 border-green-500 p-2" @click="addToArray(input, steps)"><PlusIcon class="size-4"/> Add Step</button>

                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="preparation_time">Preparation Time (minutes)</label>
                    <input v-model="form.preparation_time" class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="preparation_time" name="preparation_time"  required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="cooking_time">Cooking Time (minutes)</label>
                    <input v-model="form.cooking_time" class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="cooking_time" name="cooking_time"  required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="servings">Servings</label>
                    <input v-model="form.servings" class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="servings" name="servings"  required>
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
                        <input v-model='checkedTags' type="checkbox" :id="tag.id" name='tags[]' :value="tag.id" class="hidden peer" />
                        <label :for="tag.id" class="select-none bg-gray-500 cursor-pointer flex items-center justify-center rounded-lg  
                            py-3 px-6 font-bold transition-colors duration-200 ease-in-out peer-checked:bg-blue-500 peer  ">
                            <span>{{ tag.name }}</span>
                        </label>
                    </li>
                </ul>
                <button class='bg-gray-200 dark:bg-gray-800 p-2' type='submit' :disabled="form.processing">Save Recipe</button>
            </form>
        </div>
    </RecipeLayout>
</template>