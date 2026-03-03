<script setup>
import ProfilePicture from '../Components/ProfilePicture.vue';
import { Link } from '@inertiajs/vue3';
import { Form } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import Comment from '../Components/Comment.vue';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const user = computed(() => page.props.auth.user);
const savedRecipeIds = computed(() => page.props.auth.user.saved_recipes.map((v) => v.recipe_id));

const props = defineProps({
    recipe: Object,
    comments: Object,
    tags: Object
});

</script>
<template>
    <RecipeLayout :user>
        <div class="flex flex-col gap-4">
            <div class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold" :class="{'saved': savedRecipeIds.includes(recipe.id)}">
                <div class='w-full flex flex-col gap-4'>
                    <div class='flex flex-col-reverse w-full 2xl:flex-row gap-4'>
                        <!--Recipe Details -->
                        <div class='flex-1 flex-col flex gap-4'>
                            <h2 class="text-center">{{ recipe.title }}</h2>
                            <!--ProfileComponent-->
                            <div v-if='recipe.user' class='flex flex-row gap-2'>
                                <ProfilePicture
                                    :size='30'
                                    :image='recipe.user.image_path'
                                />
                                <div>
                                    <div class="text-xl font-semibold">{{ recipe.user.first_name }} {{ recipe.user.last_name }}</div>
                                    <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                                        <span v-if="user.reputation < 5">Arsonist</span>
                                        <span v-else-if="user.reputation < 10">Barbecuer</span>
                                        <span v-else-if="user.reputation < 20">Cook</span>
                                        <span v-else-if="user.reputation < 30">Chef</span>
                                        <span v-else-if="user.reputation < 50">Gourmand</span>
                                        <span v-else-if="user.reputation < 100">Michellin</span>
                                        <span v-else-if="user.reputation > 99">Master Chef</span>
                                        {{ recipe.user.reputation }}
                                    </div>
                                </div>
                            </div>
                            <!--EndProfileComponent-->
                            <Form v-if='savedRecipeIds.includes(recipe.id)' :action="route('users.removeSavedRecipe', recipe)" className="flex justify-center" method='post'>
                                <input type='submit' class="p-3 cursor-pointer rounded-full bg-orange-500 dark:border-orange-500 border-1 font-bold hover:bg-none" value='Remove Saved Recipe'>
                            </Form>
                            <Form v-else :action="route('users.addSavedRecipe', recipe)" className="flex justify-center" method='post'>
                                <input type='submit' class="p-3 cursor-pointer rounded-full border-orange-500 dark:border-orange-500 border-1 hover:bg-orange-500 font-semibold" value='Save Recipe'>
                            </Form>
                            <div class="grid grid-cols-2 grid-rows-2 gap-2">
                                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Prep: {{ recipe.preparation_time }} mins</p>
                                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Cook: {{ recipe.cooking_time }} mins</p>
                                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">{{ recipe.difficulty }}</p>
                                <p class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold">Serves {{ recipe.servings }}</p>
                            </div>
                            <!--Recipe Tags -->
                            <div v-if='recipe.tags.length > 0'>
                                <h4 class='text-xl font-semibold'>Tags</h4>
                                <ul class="flex flex-row flex-wrap gap-2 py-2">
                                    <li v-for='tag in tags' class='flex flex-row gap-2'>
                                        <span class='bg-blue-500 text-white p-2 rounded-md'>{{ tag.name }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Image and Container -->
                        <div class='dark:bg-gray-950 bg-gray-50 w-full flex flex-1 justify-center align-items-center rounded-xl'>
                            <img :src="route('image.recipes',recipe.image_path)" class='w-100 max-w-100 object-contain'>
                        </div>
                    </div>
                </div>
            </div>
        <div class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold">
            <h4 class='text-xl font-bold pb-4'>Ingredients</h4>
            <ul class="flex flex-col divide-gray-500 divide-y-2">
                <li class="py-2" v-for="ingredient in recipe.ingredients">{{ingredient.name}}</li>
            </ul>
        </div>
        <div class="p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold">
            <h4 class='text-xl font-bold pb-4'>Method</h4>
            <ul  class="flex flex-col divide-gray-500 divide-y-2">
                <li class="py-2" v-for="step in recipe.steps">{{step.number+1}}. {{step.step}}</li>
            </ul>
        </div>
        <!--Buttons-->
        <div class='flex gap-2'>
            <a v-if='user.id === recipe.user_id' class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('recipes.edit', recipe)">Edit Recipe</a>
            <Form v-if='user.id === recipe.user_id' method="DELETE" :action="route('recipes.destroy', recipe.id)">
                <button class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' type="submit">Delete Recipe</button>
            </Form>
            <!-- @if($recipe->savedUsers()->get()->contains(auth()->user()->id)) -->
            
            <Link class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('recipes.index')">Back to all Recipes</Link>
        </div>
        <div v-if='comments' class="flex flex-col py-2 gap-2">
            <Comment v-for='comment in comments' 
                :owner='recipe.user_id === comment.user.id'
                :user='comment.user_id === user.id'
                :comment
                />
        </div>

                <!-- <x-comment 
                    :highlight='$recipe->user_id === $comment->user_id' 
                    :user='$comment->user_id === auth()->user()->id' 
                    :friend='session("friendslist")->pluck("friend_user_id")->contains($comment->user_id)'
                    :comment='$comment'
                /> -->
        <div class='flex gap-2 flex-row p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold'>
            <div class="flex w-full justify-between gap-2">
                <ProfilePicture
                    :size='20'
                    :image='user.image_path'
                />
                <div class='w-full'>
                    <div class="font-semibold text-lg">{{ user.name}}</div>
                    <Form :action="route('comments.store', recipe)" method='POST'>
                        <input type='hidden' name='recipe_id' :value='recipe.id'>
                        <textarea name='comment' class='w-full' placeholder='Add your comment here...' required></textarea>
                        <button class='btn' type='submit'>Submit Comment</button>
                    </Form>
                </div>
            </div>
        </div>
        </div>
        
    </RecipeLayout>
</template>