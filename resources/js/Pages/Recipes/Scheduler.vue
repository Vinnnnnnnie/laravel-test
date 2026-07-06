<script setup>
import { Sortable } from "sortablejs-vue3";
import { computed, onMounted, onBeforeUnmount, ref } from "vue";
// const hours = [
//   '00:00',
//   '01:00',
//   '02:00',
//   '03:00',
//   '04:00',
//   '05:00',
//   '06:00',
//   '07:00',
//   '08:00',
//   '09:00',
//   '10:00',
//   '11:00',
//   '12:00',
//   '13:00',
//   '14:00',
//   '15:00',
//   '16:00',
//   '17:00',
//   '18:00',
//   '19:00',
//   '20:00',
//   '21:00',
//   '22:00',
//   '23:00',
// ];

const hours = [
  '14:00',
  '15:00',
  '16:00',
  '17:00',
]

const currentTime = ref('')

onMounted(() => {
  updateTime();
  let timer = setInterval(updateTime, 30000);
});

onBeforeUnmount(() => {
  clearInterval(timer);
});

function updateTime() {
  currentTime.value = new Date().toLocaleTimeString();
}

let times = [];
for(let hour of hours) {
  console.log('Hour:', hour.substring(3, -1))
  let minute
  for (let x = 0; x < 12; x++) {
    minute = x * 5;
    times.push(hour.substring(3, -1) + minute.toString().padStart(2, '0'))
  }
}
console.log('Time', times);
const numberOfCells = ref(times.length);
const recipesExample = [
  {
    id: 1,
    name: 'Chicken Liver Pate',
    preparation_time: 45,
    cooking_time:20,
  },
  {
    id: 2,
    name: 'Pizza',
    preparation_time: 60,
    cooking_time:10,
  },
]

let tableArray = [];

function addNewScheduleRow() {
  tableArray.push([]);
  for (let index = 0; index < numberOfCells.value; index++) {
    tableArray[tableArray.length-1].push({id:index, time:5, name:'', empty:true});
  }
}

console.log('tableArray', tableArray)
let index = 0;
recipesExample.forEach((recipe) => {
  // Make a preparation time cell
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
})

console.log('Table Array Final:', tableArray)
</script>
<template>
  <table class="w-full text-left table-auto min-w-max">
    <thead>
      <tr>
        <th v-for="hour in hours" class="bg-gray-750 text-xl text-center  text-gray-100  border border-gray-700 p-2 first:rounded-tl-sm" colspan="12">{{ hour }}</th>
      </tr>
      <tr>
        <th 
          v-for="time in times" 
          class="bg-gray-750 text-l text-center round text-gray-200  border border-gray-700 p-2 first:rounded-tl-sm last:rounded-tr-sm"
          :class="{'bg-green-700':currentTime < time}"
          >
            {{time}}
          </th>
      </tr>
    </thead>
    <Sortable
      :list="row"
      item-key="id"
      tag="tr"
      v-for="row in tableArray"
      class="border-1 border-gray-600 py-2"
      >
      <template #item="{element, index}">
        <td 
          class="draggable border py-4 px-2" 
          :key="element.id" 
          :colspan="element.time/5 ?? 1"
          :class="{
            'border-0':element.empty,
            'border-0 bg-red-700 rounded-lg shadow':element.type === 'cooking',
            'border-0 bg-yellow-700 rounded-lg shadow':element.type === 'preparation',
            
            }">
          {{ element.name }}
        </td>
      </template>
    </Sortable>    
    <p>{{ currentTime  }}</p>
  </table>
</template>