<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue'
import { InfiniteScroll, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import RecipeList from '../Components/RecipeList.vue';
import { Link }  from '@inertiajs/vue3';

const props = defineProps({
    recipes: Object,
    users: Object
})
</script>
<template>
    <RecipeLayout>
        <div>
            <h2 class="py-4">Users</h2>
                <ul data='users' manual v-if="users.length > 0" class='flex flex-col gap-4'>
                    <li v-for="user in users">
                        <div class='w-100 h-fit'>
                            <div class='p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold hidden xl:flex'>
                                <img :src="route('image.users', user.image_path)" class='w-20 max-w-20'>
                                <div>
                                    <h2 class='text-xl font-bold'><Link :href="route('users.show', user.id)">{{ user.first_name }} {{ user.last_name }}</Link></h2>
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
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul v-else>
                    <li>
                        <span class='text-3xl py-4'>
                            No Users found
                        </span>
                    </li>
                </ul>
            <h2 class="py-4">Recipes</h2>
            <RecipeList 
                :recipes='recipes'
            />
        </div>
    </RecipeLayout>
</template>