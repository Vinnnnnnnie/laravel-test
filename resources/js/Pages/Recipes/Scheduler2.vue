<script setup>
import { DayPilot, DayPilotScheduler } from "@daypilot/daypilot-lite-vue";
import { computed, onMounted, ref } from "vue";
import RecipeLayout from "../Components/RecipeLayout.vue";
// const startDate = ref(Date.now())
const startDate = ref("2026-07-06T09:00:00")

const days = computed(() => 1)

console.log('Days:', startDate.value.today)

// const startTime = ref(DayPilot.Date("00:00"));
const hours = [
    "00:00",
    "01:00",
    "02:00",
    "03:00",
    "04:00",
    "05:00",
    "06:00",
    "07:00",
    "08:00",
    "09:00",
    "10:00",
    "11:00",
    "12:00",
    "13:00",
    "14:00",
    "15:00",
    "16:00",
    "17:00",
    "18:00",
    "19:00",
    "20:00",
    "21:00",
    "22:00",
    "23:00",

]
const resources = ref([])
const events = ref([])

onMounted(() => {

  resources.value = [
    {name: "Resource 1", id: "R1"},
    {name: "Resource 2", id: "R2"},
    {name: "Resource 3", id: "R3"},
    // ...
  ]

  events.value = [
    {
      id: 1,
      start: "2026-07-06T10:00:00",
      end: "2026-07-06T12:45:00",
      text: "Event 1",
      resource: "R1",
      tags: {
        color: "#6fa8dc"
      }
    },
    // ...
  ]
  
})

function hideEarlyTimes() {
  console.log('Yo I am here');
}
</script>
<template>
    <RecipeLayout>
      <div class="w-full">
        <DayPilotScheduler
            :timeHeaders="[{ groupBy: 'Hour'}, {groupBy: 'Cell', format: 'h:mm'}]"
            scale="CellDuration"
            cellDuration="15"
            :startDate="startDate"

            :days="days"
            :events="events"
            :resources="resources"
            businessBeginsHour="9"
            businessEndsHour="18"
            showNonBusiness="false"
            @includeTimeCell="hideEarlyTimes"
        />
      </div>
        
    </RecipeLayout>
</template>