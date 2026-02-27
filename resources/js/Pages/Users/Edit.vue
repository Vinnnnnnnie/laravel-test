<script setup>
import { Form } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage()
const user = page.props.auth.user;
</script>
<template>
    <RecipeLayout>
        <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
            <h2>Edit User</h2>
            <Form class='flex flex-col gap-4' :action="route('users.update')" method='POST' enctype="multipart/form-data">
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img id='image-preview' :src="route('image.users',user.image_path)" class='aspect-auto h-fit max-h-80 self-center'>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="image">Image</label>
                    <input type="file" id="image" class='form-control w-full' name="image">
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="first-name">First Name</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="first-name" name="first_name" :value='user.first_name' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="last_name">Last Name</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="last_name" name="last_name" :value='user.last_name' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="email">Email</label>
                    <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="email" name="email" :value='user.email' required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="bio">Description</label>
                    <textarea class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="bio" name="bio">{{ user.bio }}</textarea>
                </div>
                <button class='bg-gray-200 cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 dark:bg-gray-800 p-2' type='submit'>Save Changes</button>
            </Form>
        </div>
    </RecipeLayout>
</template>