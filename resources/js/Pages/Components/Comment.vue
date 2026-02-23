<script setup>
import { Link } from '@inertiajs/vue3';
import ProfilePicture from './ProfilePicture.vue';
const props = defineProps({
    comment: Object,
    highlight: Boolean,
    user: Boolean,
    owner: Boolean,
    friend: Boolean,    
})
</script>
<template>
    <div :class="{highlight: 'highlight',user:'user', owner:'owner', friend:'friend', }" class='comment'>
        <div class='flex w-full justify-between gap-2'>
            <ProfilePicture
                :size='20'
                :image='comment.user.image_path'
            />
            <div class="w-full flex flex-col items-start h-full">
                <h5 class='text-l font-semibold'><Link :href="route('users.show', comment.user)">{{ comment.user.name }}</Link></h5>
                {{ comment.comment}}
            </div>
        </div>
    </div>
</template>