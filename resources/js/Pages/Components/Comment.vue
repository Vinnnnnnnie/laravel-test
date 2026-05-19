<script setup>
import { Link } from '@inertiajs/vue3';
import ProfilePicture from './ProfilePicture.vue';
import { MinusIcon } from '@heroicons/vue/16/solid';
import { showToast } from '../../Composables/useToast';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const props = defineProps({
    comment: Object,
    highlight: Boolean,
    user: Boolean,
    owner: Boolean,
    friend: Boolean,    
    recipe: Object
})
const page = usePage();
async function removeComment(comment) {
    try {
        console.log(`Comment:`,comment)
        let response = await fetch(route('comments.destroy', comment), {
                method:'Delete',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
        if (!response.ok) {
            showToast('error', 'Error deleting comment.');
        }
        const result = await response.json();
        showToast('success', result);
        page.props.comments = page.props.comments.filter(newComments => newComments.id !== comment);

    }
    catch(error)
    {
        showToast('error', error);
        console.log(`Something broke: ${error}`);
    }
}

</script>
<template>
    <div :class="{'highlight':highlight,'user':user, 'owner':owner, 'friend':friend}" 
        class='p-4 rounded-md dark:bg-gray-900 bg-gray-100 font-semibold flex'>
        <div class='flex w-full justify-between gap-2'>
            <ProfilePicture
                :size='20'
                :image='comment.user.image_path'
            />
            <div class="w-full flex flex-col items-start h-full">
                <h5 class='text-l font-semibold'><Link :href="route('users.show', comment.user)">{{ comment.user.first_name }} {{  comment.user.last_name }}</Link></h5>
                {{ comment.comment}}
            </div>
        </div>
        <button
            @click="removeComment(comment.id)" 
            type="button" 
            class="p-3 flex gap-2 align-baseline self-center items-center cursor-pointer rounded-sm border-red-500 border-1 hover:bg-red-500 font-semibold">
            <MinusIcon class="size-4"/> Delete {{  }}
        </button>
    </div>
</template>