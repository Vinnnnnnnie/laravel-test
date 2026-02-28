<script setup>
import { Form, Link } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import RecipeList from '../Components/RecipeList.vue';
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
            <div class='card flex flex-row gap-4'>
                <div class='dark:bg-gray-950 aspect-square overflow-hidden min-w-50 min-h-50 w-50 h-50 flex items-center justify-center bg-gray-50 align-items-center rounded-sm'>
                    <img :src="route('image.users', user.image_path)" class='w-full h-full object-cover'>
                </div>
                <div class='flex flex-col gap-4'>
                    <div class='flex flex-col justify-start w-full'>
                        <h2>{{ user.first_name}} {{ user.last_name }}</h2>
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
            <div class="flex flex-row">
                <Form v-if="authUser.following.find(u => u.user_id === authUser.id)" :action="route('users.unfollow', user)" method='DELETE'>
                    <input hidden id='friend_user_id' name='friend_user_id' :value='user.id'>
                    <input type='submit' class="btn bg-red-500" value='Unfollow'>
                </Form >
                <Form v-else-if="authUser.id != user.id" :action="route('users.follow', user)" method='post'>
                    <input hidden readonly id='friend_user_id' name='friend_user_id' :value='user.id'>
                    <input type='submit' class="btn bg-green-500" value='Follow'>
                </Form>
                <Link v-if="authUser.id === user.id" :href="route('users.edit')">Edit Profile</Link>
            </div>
        </div>
        
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recipes by {{user.first_name}} {{ user.last_name }}</h2>
            </div>
            <RecipeList 
                :recipes='recipes'
            />
        </div>
    </RecipeLayout>

</template>