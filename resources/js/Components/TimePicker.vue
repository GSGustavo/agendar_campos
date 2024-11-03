<template>
    <VueDatePicker locale="pt-br" :start-time="startTime" v-model="time" time-picker
        :range="{ disableTimeRangeValidation: true }" placeholder="Escolha seu horário" minutes-increment="5" @update:model-value="handleDate" select-text="Escolher" cancel-text="Fechar"/>

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
  console.log(modelData)
}

</script>

<style>
.none-select {
    display: none;
}
</style>