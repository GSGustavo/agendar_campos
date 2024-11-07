import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})







// import './bootstrap';

// import { createApp } from 'vue'

// import VueDatePicker from '@vuepic/vue-datepicker';
// import '@vuepic/vue-datepicker/dist/main.css'

// // Imports
// import Counter from './Components/Counter.vue'
// import AgendamentoForm from './Components/AgendamentoForm.vue';
// import FloatBar from './Components/FloatBar.vue';
// // Imports

// const app = createApp({})

// // Registers
// app.component('VueDatePicker', VueDatePicker)
// app.component('Counter', Counter)
// app.component('FloatBar', FloatBar)
// app.component("AgendamentoForm", AgendamentoForm)

// // Registers

// app.mount('#app')