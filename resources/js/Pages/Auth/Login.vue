<script setup>
import Layout from '../Components/Layout.vue'
import { Form, Link } from '@inertiajs/vue3'
</script>
<template>
    <Layout>
        <div class='flex bg-gray-100 p-4 flex-col items-center rounded-sm dark:bg-gray-900 justify-self-center my-20'>
            <h2>Login</h2>
            <Form method="POST" action="/login" class='flex flex-col gap-4'>
                <div class='flex flex-col'>
                    <label class='form-label' for="email">Email</label>
                    <input class='form-control' type="email" id="email" name="email" value='' required>
                </div>
                <div class='flex flex-col'>
                    <label for="password" class='form-label'>Password</label>
                    <input class='form-control' type="password" id="password" name="password" required>
                </div>
                <button type="submit" class='rounded-2xl bg-blue-500 px-4 py-2 mx-4 font-bold'>Login</button>
            </Form>
            <Link class="rounded-2xl border-green-500 border-1 px-4 py-2 m-4 font-bold" :href="route('show.register')">Register</Link>
            <Link class="rounded-2xl border-blue-500 border-1  px-4 py-2 m-4" :href="route('recipes.index')">Login as a Guest</Link>

        </div>
    </Layout>
</template>