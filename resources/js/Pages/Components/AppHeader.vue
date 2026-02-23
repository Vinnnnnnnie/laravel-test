<script setup>
import { Link } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3';
const props = defineProps({
    user: Object
})
</script>

<template>
    <header class='bg-gray-100 dark:bg-gray-900 shadow border-b-1 border-gray-500 dark:border-gray-500'>
        <div class="flex flex-row justify-between text-center align-middle">
            <h1 class='font-mono'>vinnie.fyi</h1>
            <nav class="flex gap-12 items-center">
                <Link class='text-xl' href='/'>Home</Link>
                <Link class='text-xl' :href="route('recipes.index')">RecipeShare</Link>
                <Link class='text-xl' :href="route('games.index')">Steam Activity</Link>
            </nav>
            <div v-if="user" class="flex p-2 items-center">
                <span class="font-bold text-lg mr-2 content-center">Hello, {{ user.name }}</span>
                <Form :action="route('logout')" method='POST'>
                    <button class='btn' type='submit'>Logout</button>
                </Form>
            </div>
            <div v-else class="flex p-2 items-center gap-2">
                <Link class='btn' :href="route('show.login')">Login</Link>
                <Link class='btn' :href="route('show.register')">Register</Link>
            </div>
        </div>    
    </header>
</template>