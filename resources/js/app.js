import './bootstrap';

import { createApp } from 'vue'

// Imports
import Counter from './Components/Counter.vue'
import DataPicker from './Components/DataPicker.vue'
import TimePicker from './Components/TimePicker.vue';
// Imports

const app = createApp({})

// Registers
app.component('Counter', Counter)
app.component('DatePicker', DataPicker);
app.component('TimePicker', TimePicker);
// Registers

app.mount('#app')