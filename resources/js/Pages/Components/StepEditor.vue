<script setup>
import { ArrowUpIcon, ArrowDownIcon, XCircleIcon, XMarkIcon, PlusCircleIcon, PlusIcon } from '@heroicons/vue/16/solid';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
    steps: Object
})

const page = usePage();
const steps = ref(props.steps)
function addToArray(value, fieldType)
{
    fieldType.push({});
}
function removeFromArray(index, fieldType)
{
    fieldType.splice(index, 1);
}
function shiftUp(index, array) {
    console.log('Shifting element up');
    const movedItem = steps.value.splice(index, 1)[0];
    steps.value.splice(index-1, 0, movedItem)

}

function shiftDown(index, array) {
    console.log('Shifting element down');
    const movedItem = steps.value.splice(index, 1)[0];
    steps.value.splice(index+1, 0, movedItem)
}
</script>
<template>
    <div class="flex flex-row items-center border-1 rounded-sm border-gray-100 p-1 gap-2" v-for="(input, index) in steps" :key="`step-${index}`">
        <label for="steps" class='form-label'>{{ index+1 }}.</label>
        <textarea 
            v-model="input.step" 
            name="steps[]" 
            class='bg-gray-200 dark:bg-gray-800 p-2 w-full field-sizing-content' 
            required>
        </textarea>

        <!-- Move Step -->
        <div>
            <button 
                v-show="steps.length > 1 && index > 0" 
                type="button" 
                @click="shiftUp(index, steps)">
                <ArrowUpIcon class="size-4"/>
            </button>
            <button 
                v-show="steps.length > 1 && index+1 !== steps.length" 
                type="button" 
                @click="shiftDown(index, steps)">
                <ArrowDownIcon class="size-4"/>
            </button>
        </div>

        <!-- Remove Step -->
        <button 
            v-show="steps.length > 1" 
            type="button" 
            class="cursor-pointer rounded-full border-2 border-red-500 p-2" 
            @click="removeFromArray(index, steps)">
            <XMarkIcon class="size-4"/>
        </button>
    </div>

    <!-- Add Step -->
    <button 
        type="button" 
        class="cursor-pointer self-center flex flex-row gap-2 justify-center items-center rounded-full border-2 border-green-500 p-2 w-fit" 
        @click="addToArray(input, steps)">
        <PlusIcon class="size-4"/> Add Step <PlusIcon class="invisible size-4"/>
    </button>
</template>