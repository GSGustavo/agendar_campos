import './bootstrap';

import { createApp } from 'vue'

// Imports
import Counter from './Components/Counter.vue'
import DataPicker from './Components/DataPicker.vue'
// Imports

const app = createApp({})

// Registers
app.component('Counter', Counter)
app.component('VueDatePicker', DataPicker);
// Registers

app.mount('#app')