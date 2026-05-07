<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { showToast } from '../../Composables/useToast';
const page = usePage();
const followedIds = computed(() => page.props.auth.user.following.map((v) => v.user_id));
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const props = defineProps({
    user: Object,
});

async function addUser(user) {
    try {
        let response = await fetch(route('users.follow', user), {
                method:'Post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: user
            })

        if (!response.ok) {
            showToast('error', 'Error following User!');
        }
        page.props.auth.user.following.push({
            'user_id' : user.id,
            'image_path' : user.image_path,
            'first_name' : user.first_name,
            'last_name' : user.last_name,
            'reputation' : user.reputation 
        })
        const result = await response.json();
        showToast('success', result);
    }
    catch(error)
    {
        showToast('error', error);
        console.log(`Error: ${error}`)
    }
}
async function removeUser(user) {
    try {
        let response = await fetch(route('users.unfollow', user), {
                method:'Delete',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: user
            })
        if (!response.ok) {
            showToast('error', 'Error unfollowing User!');
        }
        page.props.auth.user.following = page.props.auth.user.following.filter(followed => followed.user_id !== user.id);
        const result = await response.json();
        showToast('success', result);
    }
    catch(error)
    {
        showToast('error', error);
        console.log(`Fuck we fucked: ${error}`)
    }
}
</script>
<template>
    <button v-if=" page.props.auth.user.id !== 0 && followedIds.includes(user.id)"
        @click="removeUser(user)" 
        type="button" 
        class="p-3 cursor-pointer rounded-full bg-orange-500 hover:bg-orange-500 font-semibold">
        Unfollow
    </button>
    <button v-else-if="page.props.auth.user.id !== 0"
        @click="addUser(user)" 
        type="button" 
        class="p-3 cursor-pointer rounded-full border-orange-500 border-1 hover:bg-orange-500 font-semibold">
        Follow
    </button>
    
</template>
