

<template>
    <VueDatePicker uid="teste" locale="pt-br" v-model="date" inline time-picker-inline :multi-dates="{ limit: 3 }" />
</template>

<script setup>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const date = ref();
</script>