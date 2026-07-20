
<script setup>
const props = defineProps({
    reputation: Number
});
</script>
<template>
    <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
        <span v-if="reputation < 5">Arsonist</span>
        <span v-else-if="reputation < 10">Barbecuer</span>
        <span v-else-if="reputation < 20">Cook</span>
        <span v-else-if="reputation < 30">Chef</span>
        <span v-else-if="reputation < 50">Gourmand</span>
        <span v-else-if="reputation < 100">Michellin</span>
        <span v-else-if="reputation > 99">Master Chef</span>
        {{ reputation }}
    </div>
</template>
