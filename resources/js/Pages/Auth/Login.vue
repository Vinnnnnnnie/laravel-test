<script setup>
import Layout from '../Components/Layout.vue'
import { Form } from '@inertiajs/vue3'
</script>
<template>
    <Layout>
        <div class='flex bg-gray-100 p-4 flex-col items-center dark:bg-gray-900 justify-self-center my-20'>
        <h2>Login (Powered by Vue)</h2>
        <Form method="POST" action="/login" class='flex flex-col gap-4'>
            <div class='flex flex-col'>
                <label class='form-label' for="email">Email</label>
                <input class='form-control' type="email" id="email" name="email" value='' required>
            </div>
            <div class='flex flex-col'>
                <label for="password" class='form-label'>Password</label>
                <input class='form-control' type="password" id="password" name="password" required>
            </div>
            <button type="submit" class='btn'>Login</button>
        </Form>
    </div>
    </Layout>
</template>