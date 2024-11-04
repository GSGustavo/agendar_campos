<template>
  
</template>

<script setup>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const time = ref();
const startTime = ref(
    [
        {
            hours: 19,
            minutes: 0
        },
        {
            hours: 21,
            minutes: 0
        }
    ]
);

const handleDate = (modelData) => {
  $("#init_time").val(`${modelData[0].hours}:${modelData[0].minutes}`)
  $("#end_time").val(`${modelData[1].hours}:${modelData[1].minutes}`)
}

</script>

<style>
.none-select {
    display: none;
}
</style>