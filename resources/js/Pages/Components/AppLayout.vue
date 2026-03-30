<script setup>
import { usePage } from '@inertiajs/vue3'
import { watch } from 'vue'
import { showToast } from '../../Composables/useToast'

const page = usePage()

watch(
  () => page.props.success,
  (msg) => {
    if (msg) showToast('success', msg)
  }
)

watch(
  () => page.props.error,
  (msg) => {
    if (msg) showToast('error', msg)
  }
)
</script>

<template>
  <slot />
</template>
