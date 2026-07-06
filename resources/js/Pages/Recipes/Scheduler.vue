<template>
  <DayPilotScheduler
    ref="timesheetRef"
    :timeHeaders="timeHeaders"
    scale="CellDuration"
    :cellDuration="15"
    :days="0.4167" 
    viewType="Days"
    :startDate="startDate"
    :showNonBusiness="false"
    :businessBeginsHour="8"
    :businessEndsHour="18"
    :events="events"
  />
</template>

<script setup>
import { DayPilotScheduler } from '@daypilot/daypilot-lite-vue'
import { ref, onMounted } from 'vue'

const startDate = "2026-10-01"

const timeHeaders = [
  {groupBy: "Hour"},
  {groupBy: "Cell", format: "mm"}
]

const events = ref([])
const timesheetRef = ref(null)

const loadEvents = () => {
  events.value = [
    {
      id: 1,
      start: "2026-10-02T09:30:00",
      end: "2026-10-02T11:30:00",
      text: "Task 1",
      project: 1,
      client: 1
    },
    {
      id: 2,
      start: "2026-10-04T10:00:00",
      end: "2026-10-04T12:30:00",
      text: "Task 2",
      project: 2,
      client: 1
    }
  ]
}

onMounted(() => {
  loadEvents()
  timesheetRef.value?.control.scrollTo("2026-10-01T08:00:00")
  // timesheetRef.value?.control.message("Welcome!")
})
</script>