<script setup>
import { Sortable } from "sortablejs-vue3";
import { computed, onMounted, onBeforeUnmount, ref, watch} from "vue";

const props = defineProps({
    hours: Array,
    recipes: Array
})

console.log('Props', props)

const hours = computed(() => { return props.hours});
const currentTime = ref('')
let timer
onMounted(() => {
    updateTime();
    timer = setInterval(updateTime, 30000);
});

onBeforeUnmount(() => {
    clearInterval(timer);
});

function updateTime() {
    currentTime.value = new Date().toLocaleTimeString();
}

let times = computed(() => {
    let timesArray = [];
    for (let hour of hours.value) {
        let minute
        for (let x = 0; x < 12; x++) {
            minute = x * 5;
            timesArray.push(minute.toString().padStart(2, '0'))
        }
    }
    return timesArray
})
    
const numberOfCells = ref(times.value.length);

let tableArray = [];

function addNewScheduleRow() {
    tableArray.push([]);
    for (let index = 0; index < numberOfCells.value; index++) {
        tableArray[tableArray.length - 1].push({ id: index, time: 5, name: '', empty: true });
    }
}

let index = 0;

const newRecipe = [{
        id: 3,
        name: 'Strognaoff',
        preparation_time: 20,
        cooking_time: 90,
    }]

    console.log('Recipes: ', props.recipes)
function addRecipe(recipe) {
    let preparationCell = {
        id: 1,
        name: recipe.name + ': Preparation',
        time: recipe.preparation_time,
        type: 'preparation',
    }
    // Make a cook time cell
    let cookingCell = {
        id: 2,
        name: recipe.name + ': Cooking',
        time: recipe.cooking_time,
        type: 'cooking',

    }
    // Make Empty Row
    addNewScheduleRow();

    // Make space for each cell
    tableArray[index].splice(0, 0, preparationCell)
    tableArray[index].splice(1, 0, cookingCell)
    let cellsToPop = (recipe.cooking_time + recipe.preparation_time) / 5
    tableArray[index].splice(tableArray[index].length - cellsToPop)
    console.log('Popped off ' + cellsToPop)
    index++
}
watch(props.recipes, (addedRecipe) => {
    console.log('Recipes In Table', addedRecipe);
    addRecipe(addedRecipe)
})
newRecipe.forEach((recipe) => {
    // Make a preparation time cell
    addRecipe(recipe)
})
</script>
<template>
    <div class="overflow-x-auto w-4xl">
        <table class="text-left table-auto p-4">
            <thead>
                <tr>
                    <th v-for="hour in hours"
                        class="bg-gray-750 text-lg text-center  text-gray-100  border border-gray-700 p-2 first:rounded-tl-sm"
                        colspan="12">{{ hour }}
                    </th>
                </tr>
                <tr>
                    <th v-for="time in times"
                        colspan="1"
                        class="bg-gray-750 text-xs text-center round text-gray-200  border border-gray-700 p-2 first:rounded-tl-sm last:rounded-tr-sm"
                        :class="{ 'bg-green-700': currentTime < time }">
                        {{ time }}
                    </th>
                </tr>
            </thead>
            <Sortable 
                :list="row" 
                item-key="id" 
                tag="tr" 
                v-for="row in tableArray"
                class="border-1 border-gray-600 py-2">
                <template #item="{ element, index }">
                    <td 
                        class="draggable border py-4 px-2" 
                        :key="element.id" 
                        :colspan="element.time / 5 ?? 1" 
                        :class="{
                            'border-0': element.empty,
                            'border-0 bg-red-700 rounded-lg shadow': element.type === 'cooking',
                            'border-0 bg-yellow-700 rounded-lg shadow': element.type === 'preparation',
                    }">
                        {{ element.name }}
                    </td>
                </template>
            </Sortable>
        </table>
    </div>
    <button @click="addRecipe(newRecipe)">Add Recipe</button>
</template>