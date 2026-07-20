<script setup>
import UserImage from "./UserImage.vue";
import UserName from "./UserName.vue";
import UserReputation from "./UserReputation.vue";
const props = defineProps({
    user: Object,
})
</script>
<template>
    <div class="flex gap-2">
        <UserImage :username="user.username" :image-path="user.image_path"/>
        <div class="flex flex-col gap-1 justify-start">
            <UserName :user="user"/>
            <UserReputation :reputation="user.reputation"/>
        </div>
    </div>

</template>
