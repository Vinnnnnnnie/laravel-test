<script setup>
import { Form } from '@inertiajs/vue3';
import RecipeLayout from '../Components/RecipeLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const page = usePage()
const user = page.props.auth.user;

const imageUrl = ref('');
const previewImage = (event) => {
    const file = event.target.files[0]
    if (!file) return
    console.log(event)
    const reader = new FileReader()
    reader.onload = (e) => {
        imageUrl.value = e.target.result
    }
    reader.readAsDataURL(file)
}

</script>
<template>
    <RecipeLayout>
        <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
            <h2>Edit User</h2>
            <Form class='flex flex-col gap-4' :action="route('users.update')" method='POST' enctype="multipart/form-data">
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src="imageUrl" class='aspect-auto h-fit max-h-80 self-center'>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="image">Image</label>
                    <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image">
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