<script setup>
import { Link } from '@inertiajs/vue3'
import AppHeader from './AppHeader.vue'
import AppFooter from './AppFooter.vue'
import { onMounted, defineProps } from 'vue';
import { Form } from '@inertiajs/vue3';
import UserCard from './UserCard.vue';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import RecipeProfile from './RecipeProfile.vue';
import ProfilePicture from './ProfilePicture.vue';
const page = usePage();

const user = computed(() => page.props.auth.user);
const errors = computed(() => page.props.errors);
const success = computed(() => page.props.success);

</script>

<template>
    <AppHeader :user/>
    <main class='items-center p-8'>
        <div class='flex justify-between xl:flex-row flex-col gap-8'>
            <div v-if="user" class='flex-2 xl:sticky xl:top-4 h-fit flex flex-col gap-4'>
                <div class="hidden xl:flex bg-gray-100 dark:bg-gray-900 p-4 rounded-md">
                    <RecipeProfile :size="30" :user/>
                </div>
                <div class='w-full mb-2'>
                    <h2>Find Recipes</h2>
                    <Form :action="route('recipes.search')" method='get' class='flex gap-2 dark:bg-gray-900 bg-gray-100 p-4 rounded-md '>
                        <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full' value=''>
                        <input type='submit' name='submit' class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' value='Go'>
                    </Form>
                </div>
                <div class='flex flex-row xl:flex-col justify-center items-center gap-4 mb-4'>
                    <Link class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('recipes.create')"> Create a New Recipe</Link>
                    <Link class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('users.savedRecipes')"> Saved Recipes</Link>
                    <Link class="p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold" > Settings</Link>
                </div>
            </div>
            <div class='flex-4 justify-between gap-8 '>
                <div class='flex-2 gap-4 dark:bg-gray-800'>
                    <div v-if="errors.length>0"  class="alert alert-danger">
                        <ul v-for='error in errors' class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                            <li class='text-red-500'>{{ error }}</li>
                        </ul>
                    </div>
                    <div v-if="success.length>0"  class="alert alert-success">
                        <ul class='px-4 py-2 bg-green-200 dark:bg-green-800 rounded-lg mb-2'>
                            <li class='text-green-500'>{{ success }}</li>
                        </ul>
                    </div>
                    <slot />
                </div>
            </div>
            <div class='hidden xl:block xl:sticky xl:top-4 h-min flex-2 p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold '>
                <ul class="flex gap-2 flex-col">
                    <li><h2>Followed</h2></li>
                    <div v-if="user.following.length > 0">
                        <li class="p-2" v-for="followed in user.following">
                            <div class='flex flex-row gap-2'>
                                <ProfilePicture
                                    :image='followed.image_path'
                                    :size="10"
                                />
                                <div>
                                    <div><Link :href="route('users.show', followed.user_id)">{{ followed.first_name}} {{ followed.last_name }}</Link></div>
                                    <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                                        <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                                            <span v-if="followed.reputation < 5">Arsonist</span>
                                            <span v-else-if="followed.reputation < 10">Barbecuer</span>
                                            <span v-else-if="followed.reputation < 20">Cook</span>
                                            <span v-else-if="followed.reputation < 30">Chef</span>
                                            <span v-else-if="followed.reputation < 50">Gourmand</span>
                                            <span v-else-if="followed.reputation < 100">Michellin</span>
                                            <span v-else-if="followed.reputation > 99">Master Chef</span>
                                            {{ followed.reputation }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                    <li v-else>
                        You're not following anyone yet
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <AppFooter/>
</template>