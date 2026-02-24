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

const props = defineProps({
    recipe: Object,
    comments: Object,
    tags: Object
});

</script>
<template>
    <RecipeLayout :user>
        <div class="card p-4">
            <div class='w-full flex flex-col gap-4'>
                <div v-if='recipe.user' class='flex flex-row gap-2'>
                    <ProfilePicture
                        :size='30'
                        :image='recipe.user.image_path'
                    />
                    <div>
                        <strong>{{ recipe.user.name }}</strong>
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
                        <p v-if="recipe.user.recipes && recipe.user.recipes.length === 1">{{ recipe.user.recipes.length }} Recipe</p>
                        <p v-else-if="recipe.user.recipes">{{ recipe.user.recipes.length }} Recipes</p>
                        <p v-else>0 Recipes</p>
                    </div>
                    
                </div>
                <div class='flex flex-col-reverse w-full xl:flex-row gap-4'>
                    <!--Recipe Details -->
                    <div class='flex-1 flex-col flex gap-2'>
                        <h2>{{ recipe.title }}</h2>
                        <p><strong>Prep Time: </strong>{{ recipe.preparation_time }} Minutes</p>
                        <p><strong>Cook Time: </strong>{{ recipe.cooking_time }} Minutes</p>
                        <p><strong>Difficulty: </strong>{{ recipe.difficulty }}</p>
                        <div>
                            <h4 class='text-xl font-semibold'>Ingredients</h4>
                            <pre class='font-sans text-wrap'>{{ recipe.ingredients }}</pre>
                        </div>
                        <div>
                            <h4 class='text-xl font-semibold'>Instructions</h4>
                            <pre class='font-sans text-wrap'>{{ recipe.instructions }}</pre>
                        </div>
                        <!--Recipe Tags -->
                        <div v-if='recipe.tags'>
                            <h4 class='text-xl font-semibold'>Tags</h4>
                            <ul v-for='tag in tags' class='flex flex-row gap-2'>
                                <span class='bg-blue-500 text-white p-2 rounded-md'>{{ tag.name }}</span>
                            </ul>
                        </div>
                    </div>
                    <!-- Image and Container -->
                    <div class='dark:bg-gray-950 bg-gray-50 w-full flex flex-1 justify-center align-items-center'>
                        <img :src="route('image.recipes',recipe.image_path)" class='w-100 max-w-100'>
                    </div>
                </div>
                <!--Buttons-->
                <div class='flex gap-2'>
                    <a v-if='user.id === recipe.user_id' class='btn' :href="route('recipes.edit', recipe)">Edit Recipe</a>
                    <Form v-if='user.id === recipe.user_id' method="DELETE" :action="route('recipes.destroy', recipe.id)">
                        <button class=btn type="submit">Delete Recipe</button>
                    </Form>
                    <!-- @if($recipe->savedUsers()->get()->contains(auth()->user()->id)) -->
                    <Form v-if='true' :action="route('users.removeSavedRecipe', recipe)" method='post'>
                        <input type='submit' class="btn bg-green-500" value='Remove Saved Recipe'>
                    </Form>
                    <Form v-else :action="route('users.addSavedRecipe', recipe)" method='post'>
                        <input type='submit' class="btn bg-green-500" value='Save Recipe'>
                    </Form>
                    <Link class='btn' :href="route('recipes.index')">Back to all Recipes</Link>
                </div>
            </div>
        </div>
        <div v-if='comments'>
            <Comment v-for='comment in comments' 
                :highlight='recipe.user_id === comment.user.id'
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
        <div class='bg-gray-50 items-center p-3 flex ml-12 mt-4 dark:bg-gray-700 dark:text-gray-200 gap-2'>
            <ProfilePicture
                :size='20'
                :image='user.image_path'
            />
            <div class='w-full'>
                <strong>{{ user.name }}</strong>
                <Form :action="route('comments.store', recipe)" method='POST'>
                    <input type='hidden' name='recipe_id' :value='recipe.id'>
                    <textarea name='comment' class='w-full' placeholder='Add your comment here...' required></textarea>
                    <button class='btn' type='submit'>Submit Comment</button>
                </Form>
            </div>
        </div>
    </RecipeLayout>
</template>