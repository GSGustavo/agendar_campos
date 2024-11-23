import { defineConfig } from 'vite';
// import { fileURLToPath, URL } from 'node:url'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig({
    plugins: [
        vueJsx(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
     
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',

        },
        
    },
});
