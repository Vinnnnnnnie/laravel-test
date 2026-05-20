<script setup>
import { Form } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
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
    <Layout>
        <div class='form'>
            <h2>Register</h2>
            <Form class='flex flex-col gap-4' method="POST" :action="route('register')">
                <div class='flex flex-col'>
                    <label class='form-label' for="username">Username</label>
                    <input class='form-control' type="text" id="username" name="username" value='' required>
                </div>
                <div class='flex flex-col'>
                    <label class='form-label' for="name">First Name</label>
                    <input class='form-control' type="text" id="first-name" name="first_name" value='' required>
                </div>
                <div class='flex flex-col'>
                    <label class='form-label' for="name">Last Name</label>
                    <input class='form-control' type="text" id="last-name" name="last_name" value='' required>
                </div>
                <div class='flex flex-col'>
                    <label class='form-label' for="email">Email</label>
                    <input class='form-control' type="email" id="email" name="email" value='' required>
                </div>
                <div class='flex flex-col'>
                    <label class='form-label' for="password">Password</label>
                    <input class='form-control' type="password" id="password" name="password" required>
                </div>
                <div class='flex flex-col'>
                    <label class='form-label' for="password_confirmation">Confirm Password</label>
                    <input class='form-control' type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class='flex flex-col'>
                    <label class='text-xl font-semibold' for="image">Profile Picture</label>
                    <input @change="previewImage" type="file" id="image" class='form-control w-full' name="image">
                </div>
                <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                    <img v-if="imageUrl" id='image-preview' :src="imageUrl" class='aspect-auto h-fit max-h-80 self-center'>
                </div>
                <button class='btn' type="submit">Register</button>
            </Form>
        </div>
    </Layout>
</template>