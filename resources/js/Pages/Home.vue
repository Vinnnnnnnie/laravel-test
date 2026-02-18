<script setup>
import Layout from './Components/Layout.vue'
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js';

const props = defineProps({ image: Object })

</script>
<template>
    <Layout>
        <div class="grid">
            <h2 class='w-fit justify-self-center bg-gradient-to-b from-50% from-gray-200 dark:from-gray-800 to-50% to-gray-100 dark:to-gray-900 px-3 translate-y-9'>Vincent Owens - Software Developer</h2>
            <section class='dark:bg-gray-900 bg-gray-100 border-1 border-gray-500 p-8 my-4 flex flex-row gap-4 items-center'>
                <div>
                    <img :src="image" class="rounded-full w-75">
                </div>
                <div class="flex-column gap-4">
                    <div>
                        Hi, I'm a software developer specialising in Php and Laravel applications. 
                        Here are some things you should check out:
                    </div>
                    <div class="py-4 flex flex-col gap-4">
                        <Link class="p-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 border-1 border-gray-500"  :href="route('recipes.index')">RecipeShare</Link>
                        <a class="p-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 border-1 border-gray-500" target='_blank'  href="https://ldjam.com/users/vinnnie/">Ludum Dare</a>
                        <a class="p-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 border-1 border-gray-500"  target='_blank' href="https://www.linkedin.com/in/vincent-owens-653685264/">LinkedIn</a>
                        <Link class="p-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 border-1 border-gray-500"  :href="route('cv')">CV</Link>
                    </div>
                </div>
            </section>
        </div>
    </Layout>
    
</template>