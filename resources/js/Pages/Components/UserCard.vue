<script setup>
import { Link } from '@inertiajs/vue3';

import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>
<template>
    <div class='p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold '>
        <div v-if="user.image_path" class='dark:bg-gray-950 aspect-square overflow-hidden min-w-30 min-h-30 w-30 h-30 flex items-center justify-center bg-gray-50 align-items-center rounded-sm'>
            <img :src="route('image.users', user.image_path)" class='w-full h-full object-cover'>
        </div>
        <div>
            <h2 v-if="user.id !== 0" class='text-xl font-bold mb-0 flex flex-row items-center justify-between w-full'>
                <Link  :href="route('users.show', user)">{{ user.user.username ?? 'Username' }}</Link>
            </h2>
            <h2 else class='text-xl font-bold mb-0 flex flex-row items-center justify-between w-full'> Guest</h2>

            <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                <span v-if="user.reputation < 5">Arsonist</span>
                <span v-else-if="user.reputation < 10">Barbecuer</span>
                <span v-else-if="user.reputation < 20">Cook</span>
                <span v-else-if="user.reputation < 30">Chef</span>
                <span v-else-if="user.reputation < 50">Gourmand</span>
                <span v-else-if="user.reputation < 100">Michellin</span>
                <span v-else-if="user.reputation > 99">Master Chef</span>
                {{ user.reputation }}
            </div>
            <p v-if="user.recipes && user.recipes.length === 1">{{ user.recipes.length }} Recipe</p>
            <p v-else-if="user.recipes">{{ user.recipes.length }} Recipes</p>
            <p v-else>0 Recipes</p>
        </div>
    </div>
</template>
