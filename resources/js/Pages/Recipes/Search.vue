<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue'
import RecipeList from '../Components/RecipeList.vue';
import { Link }  from '@inertiajs/vue3';
import UserReputation from "../Components/UserReputation.vue";

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
                                    <h2 class='text-xl font-bold'><Link :href="route('users.show', user)">{{ user.user.username ?? 'Username' }}</Link></h2>
                                    <UserReputation :reputation="user.reputation"/>
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
