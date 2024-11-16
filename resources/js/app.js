import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin).use(vuetify)
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