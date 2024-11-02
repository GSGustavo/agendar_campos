

<template>
    <VueDatePicker
    uid="teste"
    locale="pt-br"
    v-model="date"
    time-picker-inline
    placeholder="Garanta sua vaga"
    :multi-dates="{ limit: 3 }"
    :enable-time-picker="false"
    />
</template>

<script setup>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const date = ref();
</script>

<!-- Como não tem como bloquear as datas anteriores ao dia atual 
 será feito uma validação a cada data selecionada via JS vanilla -->