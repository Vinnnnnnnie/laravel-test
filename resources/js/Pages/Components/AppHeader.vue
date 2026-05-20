<script setup>
import { Link } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import ProfilePicture from './ProfilePicture.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

</script>

<template>
    <header class='bg-gray-100 dark:bg-gray-900 shadow border-b-1 border-gray-500 dark:border-gray-500'>
        <div class="flex flex-col xl:flex-row  justify-between text-center align-middle">
            <h1 class='font-mono'>vinnie.fyi</h1>
            <nav class="flex gap-12 items-center justify-around">
                <Link class='text-lg xl:text-xl' href='/'>Home</Link>
                <Link class='text-lg xl:text-xl' :href="route('recipes.index')">RecipeShare</Link>
                <Link class='text-lg xl:text-xl' :href="route('games.index')">Steam</Link>
            </nav>
            <div v-if="user.id" class="flex p-2 items-center gap-2 justify-center ">
                <Link class="hidden xl:block" :href="route('users.show', user)">
                    <ProfilePicture :image="user.image_path" :size="10"/>
                </Link>
                <span class=" font-bold text-lg mr-2 content-center">Hello, {{ user.username ?? 'Username' }} </span>
                <Form :action="route('logout')" method='POST'>
                    <button class='rounded-2xl bg-blue-500 px-4 py-2 m-4 font-bold' type='submit'>Logout</button>
                </Form>
            </div>
            <div v-else class="flex p-2 items-center gap-2 justify-center">
                <Link class='rounded-2xl bg-blue-500 px-4 py-2 m-4 font-bold' :href="route('show.login')">Login</Link>
                <Link class='rounded-2xl border-green-500 border-1 px-4 py-2 m-4 font-bold' :href="route('show.register')">Register</Link>
            </div>
        </div>    
    </header>
</template>