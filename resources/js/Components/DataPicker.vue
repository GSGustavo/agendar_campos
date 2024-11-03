<template>
  <VueDatePicker locale="pt-br" v-model="date" placeholder="Garanta sua vaga" :multi-dates="{ limit: 3 }"
    :enable-time-picker="false" week-start="0" :day-names="['D', 'S', 'T', 'Q', 'Q', 'S', 'S']"
    @update:model-value="handleDate" select-text="Escolher" cancel-text="Fechar" />
  <input type="hidden" name="dates" id="dates">
</template>

<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';


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


  $("#dates").val(datesJson)
}
</script>



<!-- Como não tem como bloquear as datas anteriores ao dia atual 
 será feito uma validação a cada data selecionada via JS vanilla -->


<!-- https://vue3datepicker.com/props/general-configuration/#loading -->

<!-- Usar isso caso tenha alguma manutenção no campo por exemplo: -->
<!-- https://vue3datepicker.com/slots/content/#marker -->