<template>
    <VueDatePicker  locale="pt-br" :start-time="startTime" v-model="time" time-picker
        :range="{ disableTimeRangeValidation: true }" placeholder="Escolha seu horário" minutes-increment="5" @update:model-value="handleDate" select-text="Escolher" cancel-text="Fechar"/>
    <input type="hidden" name="init_time" id="init_time">
    <input type="hidden" name="end_time" id="end_time">
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

const clearTrigger = () => {
  $("#dates").val('')
}

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