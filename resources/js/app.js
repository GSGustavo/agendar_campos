import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

// import 'vuetify/styles'
import 'vuetify/styles'
import { createVuetify, useTheme } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import { VBtn } from 'vuetify/components'
import colors from 'vuetify/util/colors'

import { createPinia } from 'pinia'
import VueApexCharts from 'vue3-apexcharts'

const pinia = createPinia()

const vuetify = createVuetify({
    components,
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#000000',
                    error: colors.red.base,
                    info: colors.blue.base,
                    success: colors.green.base,
                    disabled: colors.grey.base,
                }
            }
        },
    },
    directives,
    aliases: {
        VBtnError: VBtn,
        VBtnInfo: VBtn,
        VBtnSuccess: VBtn,
        VBtnDisabled: VBtn,
        VBtnNone: VBtn
    },
    defaults: {
        VBtn: {
            color: 'primary',
            variant: 'flat',
            rounded: 'lg'
        },
        VBtnError: {
            rounded: true,
            variant: 'flat',
            color: 'error'
        },
        VBtnInfo: {
            rounded: true,
            variant: 'flat',
            color: 'info',
        },
        VBtnDisabled: {
            rounded: true,
            variant: 'flat',
            color: 'disabled'
        },
        VBtnSuccess: {
            variant: 'flat',
            color: 'success',
        },
        VBtnNone: {
            variant: 'flat',
            color: 'none',
        }
    },
})

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(vuetify)
            
            .mount(el)
    },
})
