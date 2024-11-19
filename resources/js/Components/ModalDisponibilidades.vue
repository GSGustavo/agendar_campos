<template>

    <v-dialog max-width="500">


        <template  v-slot:activator="{ props: activatorProps }">
            <v-btn v-bind="activatorProps" :color="isHovering ? 'success' : 'primary'">
                        <i class="ri-calendar-line"></i>
                        Disponibilidades
                    </v-btn>
        </template>

        <template v-slot:default="{ isActive }">
            <v-card>

                <v-card-text>
                    <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-center">Campo:</span>
                    </div>
                    <select :data-url="$page.props.apigetagendamentos" v-on:change="getAgendamentos"
                        id="agendamento_campoid" class="select select-bordered w-full ">
                        <option v-for=" campo in $page.props.campos " :value="campo.id" :key="campo.id">
                            {{ campo.nome }}
                        </option>
                    </select>
                </label>
                <div class="flex flex-col gap-2">
                    <CardAgendamentoDisponibilidade :key="agendamento.id" v-for=" agendamento in agendamentos "
                        :campo="agendamento.campo_nome" :startOn="agendamento.start_on" :endOn="agendamento.end_on" />
                </div>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn-error class="m-4" text="Fechar" @click="isActive.value = false"></v-btn-error>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>

   
</template>

<script>
import axios from 'axios';
import CardAgendamentoDisponibilidade from './CardAgendamentoDisponibilidade.vue';

export default {
    data() {
        return {
            teste: '',
            agendamentos: {}
        }
    },

    setup() {

        return {

            // Função chamada toda vez que se muda o valor do select do campo

        }
    },
    methods: {
        getAgendamentos(e) {
            // console.log(e.target.dataset.url)
            axios.post(
                e.target.dataset.url,
                {
                    'id': e.target.value
                }
            ).then((response) => {
                if (response.status === 200) {
                    if (response.data.status) {
                        this.agendamentos = response.data.agendamentos
                        // this.$forceUpdate();
                    }

                }
            })
        }
    },
    mounted() {
        // Fazendo isso para pegar o valor selecionado no select quand o elemento for montado
        // this.getAgendamentos({
        //     target: {

        //         dataset: {
        //             url: document.getElementById("agendamento_campoid").dataset.url,
        //         },
        //         value: document.getElementById("agendamento_campoid").value
        //     }
        // })
    },
    components: { CardAgendamentoDisponibilidade },
}
</script>