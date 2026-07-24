<script setup>
import { ref } from 'vue';
const open = ref(false);
</script>

<template>
    <div id="update-modal" v-if="open === true" class="rounded-lg bg-grey-800 p-2">
        <button @click="open = false" class="">Close</button>
    </div>
</template>
