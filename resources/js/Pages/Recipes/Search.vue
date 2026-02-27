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
            <h2>Users</h2>
                <ul data='users' manual v-if="users" class='flex flex-col gap-4'>
                    <li v-for="user in users">
                        <div class='w-100 sticky top-4 h-fit'>
                            <div class='profile'>
                                <img :src="route('image.users', user.image_path)" class='w-20 max-w-20'>
                                <div>
                                    <h2 class='text-xl font-bold'><Link :href="route('users.show', user.id)">{{ user.first_name }} {{ user.last_name }}</Link></h2>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-else>No Users</div>
            <h2>Recipes</h2>
            <RecipeList 
                :recipes='recipes'

            />
        </div>
    </RecipeLayout>
</template>