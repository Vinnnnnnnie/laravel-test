<script setup>
import { Form, Link } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import RecipeList from '../Components/RecipeList.vue';
import FollowUserButtons from '../Components/FollowUserButtons.vue';
import { PencilIcon } from '@heroicons/vue/16/solid';
const page = usePage();
const authUser = computed(() => page.props.auth.user);
const props = defineProps({
    user: Object,
    recipes: Object
})
</script>
<template>
    <RecipeLayout>
        <div class="flex flex-col ">
            <div class='p-4 rounded-md bg-gray-100 dark:bg-gray-900 flex flex-row gap-4'>
                <div class='dark:bg-gray-950 aspect-square overflow-hidden min-w-50 min-h-50 w-50 h-50 flex items-center justify-center bg-gray-50 align-items-center rounded-sm'>
                    <img :src="route('image.users', user.image_path)" class='w-full h-full object-cover'>
                </div>
                <div class='flex flex-col gap-4'>
                    <div class='flex flex-col justify-start w-full'>
                        <h2>{{user.username ?? 'Username'}}</h2>
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
                    <p>{{user.bio}}</p>
                </div>
            </div>
            <div class="flex flex-row py-4 gap-4">
                <FollowUserButtons v-if="user.id !== authUser.id" :user></FollowUserButtons>
                <Link v-else-if="authUser.id === user.id" 
                    :href="route('users.edit')" 
                    :data-auth="authUser.id" 
                    :data-user="user.id" 
                    className='p-3 flex items-center gap-2 cursor-pointer rounded-full border-green-500 dark:border-green-500 border-1 hover:bg-green-500 font-semibold'>
                    <PencilIcon class="size-4"/> Edit
                </Link>
            </div>
        </div>
        
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recipes by {{user.username ?? 'Username' }}</h2>
            </div>
            <RecipeList 
                :recipes='recipes'
            />
        </div>
    </RecipeLayout>

</template>