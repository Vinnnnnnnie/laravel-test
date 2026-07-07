<script setup>
    import { computed, ref } from 'vue';
    import RecipeLayout from '../Components/RecipeLayout.vue';
    import SchedulerTable from '../Components/SchedulerTable.vue';
    import RecipeSearch from '../Components/RecipeSearch.vue';
    const startHour = ref('07:00')
    const endHour = ref('13:00')
    const hoursInDay = [
        '00:00',
        '01:00',
        '02:00',
        '03:00',
        '04:00',
        '05:00',
        '06:00',
        '07:00',
        '08:00',
        '09:00',
        '10:00',
        '11:00',
        '12:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00',
        '17:00',
        '18:00',
        '19:00',    
        '20:00',
        '21:00',
        '22:00',
        '23:00',
    ]
    const hours = computed(() => {
        let hoursArray = []
        let loopHour;
        let isInRange = false;
        
        hoursInDay.forEach((hour) => {
            if (hour === startHour.value) {
                isInRange = true
            }
            if (isInRange) {
                hoursArray.push(hour)
            }
            if (hour === endHour.value) {
                isInRange = false
            }
        })
        return hoursArray
    })
</script>
<template>
    <RecipeLayout>
        <div class="flex flex-col flex-4 vw-50 gap-4">
            <label for="start-time">Start Hour</label>
            <select  name="start-time" class id="start-time" v-model="startHour">
                <option v-for="hour in hoursInDay" :value="hour">{{ hour }}</option>
            </select>
            <label for="end-time">End Hour</label>
            <select  name="end-time" id="end-time"  v-model="endHour">
                <option v-for="hour in hoursInDay" :value="hour">{{ hour }}</option>
            </select>
            <RecipeSearch/>
            <SchedulerTable :hours/>
        </div>
    </RecipeLayout>
    
</template>