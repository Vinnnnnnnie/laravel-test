<script setup>
import { Link } from '@inertiajs/vue3'
import AppHeader from './AppHeader.vue'
import AppFooter from './AppFooter.vue'
import { onMounted, defineProps } from 'vue';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const errors = computed(() => page.props.errors);
const success = computed(() => page.props.success);


</script>

<template>
    <AppHeader/>
    <main class='items-center striped-background'>
        <div class='grid grid-cols-12 divide-solid divide-x-1 divide-gray-500 justify-between gap-8 '>
            <div class='col-start-2 col-span-10 flex-2 gap-4 bg-gray-200 dark:bg-gray-800 border-gray-500 p-4 border-x-1'>
                <div v-if="errors"  class="alert alert-danger">
                    <ul v-for='error in errors' class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                        <li class='text-red-500'>{{ error }}</li>
                    </ul>
                </div>
                <div v-if="success"  class="alert alert-danger">
                    <ul v-for='message in success' class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                        <li class='text-green-500'>{{ message }}</li>
                    </ul>
                </div>
                <slot />
            </div>
        </div>
    </main>
    <AppFooter/>
</template>