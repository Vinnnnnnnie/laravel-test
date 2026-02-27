<script setup>
import { Form } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue'
</script>
<template>
    <Layout>
        <div class='form'>
            <h2>Register</h2>
            <Form class='flex flex-col gap-4' method="POST" :action="route('register')">
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
                <button class='btn' type="submit">Register</button>
            </Form>
        </div>
    </Layout>
</template>