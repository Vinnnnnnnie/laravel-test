<script setup>
import { Link } from '@inertiajs/vue3'
import AppHeader from './AppHeader.vue'
import AppFooter from './AppFooter.vue'
</script>

<template>
    <AppHeader/>
    <main>
        <article>
            <slot />
        </article>
    </main>
    <AppFooter/>
</template>