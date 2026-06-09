<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue';
import { Form, Head, useForm, usePage } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import { watch } from 'vue';
import { showToast } from '../../Composables/useToast';

const props = defineProps({
    tags: Object
})

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

const ingredients = ref([{}]);
const steps = ref([{}]);

function addToArray(value, fieldType)
{
    fieldType.push({});
}
function removeFromArray(index, fieldType)
{
    fieldType.splice(index, 1);
}

const form = useForm({
    title: '',
    image: '',
    ingredients: [],
    steps: [],
    preparation_time: 0,
    cooking_time: 0,
    servings: 0,
    difficulty: '',
    tags: []
})
const submit = () => {
    form.image = file;
    form.steps = steps.value;
    form.ingredients = ingredients.value;
    form.post(route('recipes.store'), {
        onError: () => {
            Object.keys(form.errors).forEach(key => {
                showToast('error', form.errors[key])
            })
        },
        onSuccess: () => {
            showToast('success', 'Recipe created successfully!')
        }
    });
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
        <title>Create Recipe</title>
    </Head>
    <RecipeLayout>
        <div class='bg-gray-100 dark:bg-gray-900 p-4'>
            <div class="flex flex-col gap-2">
                <h2>Create a New Recipe</h2>
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src='imageUrl' class='aspect-auto h-fit max-h-80 self-center'>
                </div>             
                <form @submit.prevent="submit" class='flex flex-col p-4 gap-2' enctype="multipart/form-data">
                    <div>
                        <label for="image" class='form-label'>Image</label>
                        <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image" accept="image/*">
                    </div>
                    <div>
                        <label for="title" class='form-label'>Recipe Title</label> <span v-if="form.errors.title" class="text-red-500">{{form.errors.title}}</span>
                        <input type="text" v-model="form.title" id="title" name="title" class='form-control w-full' value='' required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="ingredients" class='form-label'>Ingredients</label> <span v-if="form.errors.ingredients" class="text-red-500">{{form.errors.ingredients}}</span>
                        <div class="flex flex-row gap-2 items-baseline" v-for="(input, index) in ingredients" :key="`ingredient-${index}`">
                            <input v-model="input.value" name="ingredients[]" class='form-control w-full' required/>
                            <button type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, ingredients)">Add</button>
                            <button v-show="ingredients.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, ingredients)">Remove</button>
                        </div>

                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="instructions" class='form-label'>Method</label> <span v-if="form.errors.method" class="text-red-500">{{form.errors.method}}</span>
                        <div class="flex flex-row items-baseline gap-2" v-for="(input, index) in steps" :key="`step-${index}`">
                            <label for="steps" class='form-label'>{{ index+1 }}.</label>
                            <textarea v-model="input.value" name="steps[]" class='form-control w-full' required/>
                            <button type="button" class="cursor-pointer rounded-full border-2 border-green-500 p-2" @click="addToArray(input, steps)">Add</button>
                            <button v-show="steps.length > 1" type="button" class="cursor-pointer rounded-full border-2 border-red-500 p-2" @click="removeFromArray(index, steps)">Remove</button>
                        </div>
                    </div>
                    <div>
                        <label for="preparation_time" class='form-label'>Preparation Time (minutes)</label> <span v-if="form.errors.preparation_time" class="text-red-500">{{form.errors.preparation_time}}</span>
                        <input v-model="form.preparation_time" type="number" id="preparation_time" class='form-control w-full' name="preparation_time" value='' required>
                    </div>
                    <div>
                        <label for="cooking_time" class='form-label'>Cooking Time (minutes)</label> <span v-if="form.errors.cooking_time" class="text-red-500">{{form.errors.cooking_time}}</span>
                        <input v-model="form.cooking_time" type="number" id="cooking_time" class='form-control w-full' name="cooking_time" value='' required>
                    </div>
                    <div>
                        <label class='form-label' for="servings">Servings</label> <span v-if="form.errors.servings" class="text-red-500">{{form.errors.servings}}</span>
                        <input v-model="form.servings" type="number" id="servings" name="servings" class='form-control w-full' value='' required>
                    </div>
                    <div class='w-full'>
                        <label class='form-label'>Difficulty</label> <span v-if="form.errors.difficulty" class="text-red-500">{{form.errors.difficulty}}</span>
                        <div class="flex  mb-2">
                            <input v-model="form.difficulty" name="difficulty" id='easy' type="radio" value="Easy">
                            <label class='form-label' for="easy">Easy</label>
                        </div>
                        <div class="flex  mb-2">
                            <input v-model="form.difficulty" name="difficulty" id='medium' type="radio" value="Medium">
                            <label class='form-label' for="medium">Medium</label>
                        </div>
                        <div class="flex  mb-2">
                            <input v-model="form.difficulty" name="difficulty" id='hard' type="radio" value="Hard">
                            <label class='form-label' for="hard">Hard</label>
                        </div>
                    </div>
                    <ul class=" select-none  flex flex-row gap-2 flex-wrap">
                        <li v-for="(tag, index) in tags" :key="`tag-${index}`">
                            <input v-model="form.tags" type="checkbox" :id="tag.id" name='tags[]' :value="tag.id" class="hidden peer" />
                            <label :for="tag.id" class="select-none bg-gray-500 cursor-pointer flex items-center justify-center rounded-lg  
                                    py-3 px-6 font-bold transition-colors duration-200 ease-in-out peer-checked:bg-blue-500  ">
                                    <span>{{ tag.name }}</span>
                            </label>
                        </li>
                    </ul>
                    <button type="submit" :disabled="form.processing" class='btn'>Create Recipe</button>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </form>
            </div>
        </div>
        
    </RecipeLayout>
</template>