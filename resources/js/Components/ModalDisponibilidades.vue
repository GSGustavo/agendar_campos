<template>

    <v-dialog max-width="500">


        <template v-slot:activator="{ props: activatorProps }">
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
                        <!-- <select :data-url="$page.props.apigetagendamentos" v-on:change="getAgendamentos"
                        id="agendamento_campoid" class="select select-bordered w-full ">
                        <option v-for=" campo in $page.props.campos " :value="campo.id" :key="campo.id">
                            {{ campo.nome }}
                        </option>
                    </select> -->

                        <v-select :thickness="3" v-model="selected" :items="$page.props.campos" id="campo_id"
                            item-title="nome" v-on:change="getAgendamentos" item-value="id"
                            variant="outlined"></v-select>



                    </label>
                    <div class="flex flex-col gap-2">
                        <CardAgendamentoDisponibilidade :key="agendamento.id" v-for=" agendamento in agendamentos "
                            :campo="agendamento.campo_nome" :startOn="agendamento.start_on"
                            :endOn="agendamento.end_on" />
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
import { usePage } from '@inertiajs/vue3';

export default {
    data() {
        return {
            selected: 1,
            agendamentos: {}
        }
    },

    setup() {

        return {


        }
    },
    methods: {
        // Função chamada toda vez que se muda o valor do select do campo

        getAgendamentos(e) {
            // console.log(e.target.dataset.url)
            axios.post(
                usePage().props.apigetagendamentos,
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
        // Fazendo isso para pegar o valor selecionado no select quando o elemento for montado
        this.getAgendamentos({
            target: {
                value: this.selected
            }
        })
    },
    components: { CardAgendamentoDisponibilidade },
    watch: {
        selected() {
            this.getAgendamentos({
                target: {
                    value: this.selected
                }
            })
        }
    },
}
</script>