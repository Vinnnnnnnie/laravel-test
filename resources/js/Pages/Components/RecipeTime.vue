<script setup>
const props = defineProps({
    time: String
})
const output = new Date(props.time).toLocaleString()
</script>
<template>
    <p>{{ output }}</p>
</template>
