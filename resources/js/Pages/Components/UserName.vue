<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
})
</script>
<template>
    <Link :href="route('users.show', {
                'user':user,})">{{ user.username }}</Link>
</template>
