<template>
 

</template>

<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';
import AgendamentoForm from './AgendamentoForm.vue';


const date = ref();

const handleDate = (modelData) => {
  let datesJson = modelData
  if (modelData) {
    const dates = Array()
    // biome-ignore lint/complexity/noForEach: <explanation>
    modelData.forEach(date => {
      // 2000-12-31
      dates.push(`${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`)
    });

    datesJson = JSON.stringify(dates);
  }

}
</script>



