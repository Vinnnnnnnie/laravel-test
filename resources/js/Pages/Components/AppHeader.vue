<script setup>
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <header class='bg-gray-100 dark:bg-gray-900 shadow border-b-1 border-gray-500 dark:border-gray-500'>
        <div class="flex flex-row justify-between text-center align-middle">
            <h1 class='font-mono'>vinnie.fyi</h1>
            <nav class="flex gap-12 items-center">
                <Link class='text-xl' href='/home'>Home</Link>
                <Link class='text-xl' :href="route('recipes.index')">RecipeShare</Link>
                <Link class='text-xl' :href="route('games.index')" disabled>Steam Activity</Link>
            </nav>
        </div>      
    </header>
</template>