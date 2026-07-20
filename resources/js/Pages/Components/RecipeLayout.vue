<script setup>
import { Link } from '@inertiajs/vue3'
import AppHeader from './AppHeader.vue'
import AppFooter from './AppFooter.vue'
import { Form } from '@inertiajs/vue3';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import RecipeProfile from './RecipeProfile.vue';
import Toast from './Toast.vue';
import { Cog6ToothIcon, HeartIcon, PlusIcon } from '@heroicons/vue/16/solid';
import UserDetails from "@/Pages/Components/UserDetails.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
if (!page.props.auth.user.id)
{
    page.props.auth.user = {
        "id":0,
        "email":"Guest",
        "first_name":"Guest",
        "last_name":"User",
        "username":"GuestUser",
        "image_path":"Pan.jpg",
        "recipes":[],
        "saved_recipes":[],
        "following":[],
        "followers":[]}

}
</script>

<template>
    <AppHeader :user/>
    <main class='container mx-auto p-8'>
        <div class='flex justify-between xl:flex-row flex-col gap-4'>
            <div v-if="user" class='flex-1 xl:sticky xl:top-4 h-fit flex flex-col gap-4'>
                <div v-if="user !== 'Guest'" class="hidden xl:flex bg-gray-100 dark:bg-gray-900 p-4 rounded-md">
                    <RecipeProfile :size="30" :user :column="true" :rounded="true"/>
                </div>
                <div class="hidden xl:flex bg-gray-100 dark:bg-gray-900 p-4 rounded-md" v-if="user.id !== 0">
                    <Link class="flex flex-row gap-2 items-center" :href="route('users.settings')"><Cog6ToothIcon class="size-4"/> Settings</Link>
                </div>
                <div class='w-full mb-2'>
                    <h2>Find Recipes</h2>
                    <Form :action="route('recipes.search')" method='get' class='flex gap-2 dark:bg-gray-900 bg-gray-100 p-4 rounded-md '>
                        <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full' value=''>
                        <input type='submit' name='submit' class='p-2 rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' value='Go'>
                    </Form>
                </div>
                <div v-if="user.id !== 0" class='flex flex-row xl:flex-col justify-center items-center gap-4 mb-4'>
                    <Link class='p-2 flex gap-2 items-center rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('recipes.create')"><PlusIcon class="size-4"/> Create a New Recipe</Link>
                    <Link class='p-2 flex gap-2 items-center rounded-md border-gray-900 dark:border-gray-100 border-1 font-semibold' :href="route('users.savedRecipes')"><HeartIcon class="size-4"/> Saved Recipes</Link>
                </div>
            </div>
            <div class='flex-4 justify-between gap-8 '>
                <div class='flex-2 flex flex-col gap-2 dark:bg-gray-800 justify-center '>
                    <Toast />
                    <Link class="p-3 w-100 flex mb-2 gap-2 align-baseline self-center justify-center items-center cursor-pointer rounded-sm bg-blue-500 hover:bg-blue-500 font-semibold" :href="route('recipes.index')">See Latest Recipes</Link>
                    <ul v-if="page.props.errors">
                        <li v-for="error in page.props.errors" class="bg-red-500 rounded-sm text-white font-semibold">
                            {{ error }}
                        </li>
                    </ul>
                    <div v-if="page.props.success" class="bg-green-500 rounded-sm p-4 text-gray-100 font-semibold">
                        {{ page.props.success }}
                    </div>
                    <slot />
                </div>
            </div>
            <div class='hidden xl:block xl:sticky xl:top-4 h-min flex-1 p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold '>
                <ul class="flex gap-2 flex-col">
                    <li><h2>Followed</h2></li>
                    <div v-if="user.following.length > 0">
                        <li class="p-2" v-for="followed in user.following">
                            <UserDetails :user="followed"/>
                        </li>
                    </div>
                    <li v-else-if="user.id === 0">
                        Login to follow other users
                    </li>
                    <li v-else>
                        You're not following anyone yet
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <AppFooter/>
    <Toast/>

</template>
