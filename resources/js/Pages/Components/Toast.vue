<script setup>
    import { usePage} from '@inertiajs/vue3';
    import { toRef } from 'vue';
    import { watch } from 'vue';
    const page = usePage();
    const errors = toRef(page.props.errors)
    watch (errors, (newVal, oldVal) => {
        console.log('NewVal',newVal)    
    })
</script>
<template>
    <Teleport>
        <div v-if="errors.length > 0" class="bg-green-500">
            testingggg
        </div>
    </Teleport>
    
</template>