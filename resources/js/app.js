import './bootstrap';

import { createApp } from 'vue'

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

// Imports
import Counter from './Components/Counter.vue'
import AgendamentoForm from './Components/AgendamentoForm.vue';
import FloatBar from './Components/FloatBar.vue';
// Imports

const app = createApp({})

// Registers
app.component('VueDatePicker', VueDatePicker)
app.component('Counter', Counter)
app.component('FloatBar', FloatBar)
app.component("AgendamentoForm", AgendamentoForm)

// Registers

app.mount('#app')