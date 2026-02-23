<script setup>
import { Link } from '@inertiajs/vue3'
import AppHeader from './AppHeader.vue'
import AppFooter from './AppFooter.vue'
import { onMounted, defineProps } from 'vue';
import { Form } from '@inertiajs/vue3';
import UserCard from './UserCard.vue';
const props = defineProps({
    errors: {
        type: [Array, Object],
        default: []
    },
    user: Object
});

</script>

<template>
    <AppHeader :user/>
    <main class='items-center p-8'>
        <div class='flex justify-between gap-8'>
            <div v-if="user" class='flex-2 sticky top-4 h-fit flex flex-col gap-4'>
                <UserCard :user/>
                <div class='w-full mb-2'>
                    <h2>Find Recipes</h2>
                    <Form :action="route('recipes.search')" method='get' class='flex gap-2 dark:bg-gray-900 bg-gray-100 p-4'>
                        <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full' value=''>
                        <input type='submit' name='submit' class='btn' value='Go'>
                    </Form>
                </div>
                <div class='flex flex-col items-center gap-2 mb-4'>
                    <Link class='btn flex flex-row gap-2' :href="route('recipes.create')"> Create a New Recipe</Link>
                    <Link class='btn flex flex-row gap-2' :href="route('users.savedRecipes')"> Saved Recipes</Link>
                    <Link class="btn flex flex-row gap-2" > Settings</Link>
                </div>
            </div>
            <div v-if="errors" class="alert alert-danger">
                <ul v-for='error in errors' class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                    <li class='text-red-500'>{{ error.credentials.value }}</li>
                </ul>
            </div>
            <div class='grid grid-cols-12 divide-solid divide-x-1 divide-gray-500 justify-between gap-8 '>
                <div class='col-start-2 col-span-10 flex-2 gap-4 bg-gray-200 dark:bg-gray-800 border-gray-500 p-4 border-x-1'>
                    <slot />
                </div>
            </div>
        <div class='flex-2 sticky top-4 border-l-4 border-yellow-500 h-fit p-4 bg-gray-100 dark:bg-gray-900'>
            <ul>
                <li><h2>Followed</h2></li>
                    <li>
                        <!--Vue Friend Stuff-->
                        <!-- <a class="btn flex gap-2 items-center" href="{{ route('users.show', $friend->friend_user_id) }}">
                            <x-profile-picture
                                :image='$friend->image_path'
                                :size='10'
                            />
                            <strong>{{ $friend->name }}</strong>
                        </a> -->
                    </li>
                    <li>
                        You're not following anyone yet
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <AppFooter/>
</template>