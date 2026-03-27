<script setup>
    import { computed } from 'vue';
    import { Transition } from 'vue';
    import { toast } from '../../Composables/useToast';
    const visible = computed (()=> toast.value !== null)
</script>
<template>
    <Transition name="fade">
        <div v-if="visible" 
            class="fixed top-4 right-4 px-4 py-3 rounded shadow-lg text-white"
            :class="{
                'bg-green-500' : toast.type === 'success',
                'bg-red-500' : toast.type === 'error'
            }">
            {{ toast.text }}
        </div>
    </Transition>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
