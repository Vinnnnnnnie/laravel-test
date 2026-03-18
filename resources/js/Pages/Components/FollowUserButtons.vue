<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const page = usePage();
const savedRecipeIds = computed(() => page.props.auth.user.saved_recipes.map((v) => v.recipe_id));
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
            throw new Error(`Response status: ${response.status}`);
        }
        page.props.auth.user.following.push({
            'user_id' : user.id
        })
        console.log('user:',user)
        const result = await response.json();
        alert(result);
    }
    catch(error)
    {
        console.log(`Fuck we fucked: ${error}`)
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
            throw new Error(`Response status: ${response.status}`);
        }
        page.props.auth.user.following = page.props.auth.user.following.filter(saved => saved.recipe_id !== recipe.id);
        const result = await response.json();
        alert(result);
    }
    catch(error)
    {
        console.log(`Fuck we fucked: ${error}`)
    }
}
</script>
<template>
    <button 
        @click="addUser(user)" 
        type="button" 
        class="p-3 cursor-pointer rounded-full border-orange-500 border-1 hover:bg-orange-500 font-semibold">
        Follow
    </button>
    <button 
        @click="removeUser(user)" 
        type="button" 
        class="p-3 cursor-pointer rounded-full bg-orange-500 hover:bg-orange-500 font-semibold">
        Unfollow
    </button>
</template>
