<script>
import DashLayout from '../../../../Shared/Admin/DashLayout.vue';
import BreadcrumbDefault from '@/Components/Breadcrumbs/BreadcrumbDefault.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { shallowRef } from 'vue'

export default {
    data() {
        return {
            loading: false,
            users: []
        }
    },
    components: { BreadcrumbDefault },
    methods: {
        onClick() {
            this.loading = true

            axios.post(usePage().props.routegetusers, {

            }).then((response) => {
                if (response.status === 200) {
                    this.users = response.data

                    this.loading = false
                } else {
                    console.log("erro")
                }
                
            })
        },
    },
    mounted() {
        this.onClick()
    },
    layout: DashLayout
}
</script>


<template>
    <BreadcrumbDefault pageTitle="Usuários" />
    <div class="flex flex-col gap-10">

        <div>
            <v-btn :disabled="loading" append-icon="ri-refresh-line" text="Recarregar" @click="onClick"></v-btn>
        </div>

        <v-data-table :items="users" :loading="loading">
            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10"></v-skeleton-loader>
            </template>
        </v-data-table>

    </div>
</template>