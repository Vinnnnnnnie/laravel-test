<script setup>
import ProfilePicture from './ProfilePicture.vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({ 
    user: Object,
    created: String
 });
</script>
<template>
    <div class='flex flex-row gap-2'>
        <ProfilePicture
            :image='user.image_path'
            :size='20'
        />
        <div>
            <h5><Link :href="route('users.show', user)">{{ user.name }}</Link></h5>
            <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
                    <span v-if="user.reputation < 5">Arsonist</span>
                    <span v-else-if="user.reputation < 10">Barbecuer</span>
                    <span v-else-if="user.reputation < 20">Cook</span>
                    <span v-else-if="user.reputation < 30">Chef</span>
                    <span v-else-if="user.reputation < 50">Gourmand</span>
                    <span v-else-if="user.reputation < 100">Michellin</span>
                    <span v-else-if="user.reputation > 99">Master Chef</span>
                    {{ user.reputation }}
                </div>
            </div>
            <p>{{ Date(created) }}</p>
        </div>
    </div>
</template>