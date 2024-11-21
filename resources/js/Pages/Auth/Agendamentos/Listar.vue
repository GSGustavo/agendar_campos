<script setup>

import Header from '../../../Components/Header.vue';
import CardAgendamento from '../../../Components/CardAgendamento.vue';
import UserAuthLayout from '../../../Shared/User/UserAuthLayout.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

// Eu iria fazer a condição do modo do card aqui mas parei e pensei que é melhor fazer isso dentro do componente do card
// import { usePage } from '@inertiajs/vue3';

// const page = usePage()

// console.log(page.props)

</script>

<script>

export default {
    layout: UserAuthLayout,
    props: {
        apigetagendamentos: String
    },
    methods: {
        getAgendamentos() {
            axios.post(
                usePage().props.apigetmeusagendamentos,
                {}
            ).then((response) => {
                if (response.status) {
                    this.agendamentos = response.data.agendamentos
                }
            })
        }
    },
    data() {
        return {
            agendamentos: null
        }
    },
    mounted() {
        this.getAgendamentos()
    }
}
</script>

<template :key="rerender">

    <div class="flex flex-col gap-10 p-10 " >
        <Header>
            <h1 class="font-black text-2xl">Seus Agendamentos</h1>
        </Header>

        <div class="flex flex-col gap-4">
            <!-- <p class="text-xl font-black">
                2024
            </p> -->

            <!-- agendamentos list -->
            <div class="flex flex-col gap-5">
                <CardAgendamento @updateComponent="getAgendamentos" :key="agendamento.id"
                    v-for="agendamento in this.agendamentos" :url="$page.props.urlsave"
                    :urldestroy="$page.props.urldestroy" :campo_id="agendamento.campo_id"
                    :campo="agendamento.campo_nome" :startOn="agendamento.start_on" :endOn="agendamento.end_on"
                    :id="agendamento.id" />
            </div>
            <!-- agendamentos list -->
          
        </div>
    </div>

</template>
