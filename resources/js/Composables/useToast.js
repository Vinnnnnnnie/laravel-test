import { ref } from 'vue'
export const toast = ref(null)
export function showToast(type, text) {
    toast.value = {type, text}
    setTimeout(()=>{
        toast.value = null
    }, 3000)
}