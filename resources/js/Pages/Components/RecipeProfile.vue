<script setup>
import { computed } from 'vue';
import ProfilePicture from './ProfilePicture.vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({ 
    user: Object,
    userId: Number,
    size: {
        type: Number,
        default: 20
    }
});

const userId = props.userId === null ?? props.user.id 
const fontClass = props.size > 20 ? 'text-3xl font-semibold' : 'text-xl'
</script>
<template>
    <div class='flex flex-row gap-2'>
        <ProfilePicture
            :image='user.image_path'
            :size
        />
        <div>
            <div><Link :href="route('users.show', user)"  :class="fontClass">{{ user.first_name }} {{ user.last_name }}</Link></div>
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
        </div>
    </div>
</template>