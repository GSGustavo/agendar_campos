<template>
    <button
        class="w-[300px] bg-primary items-center justify-center flex gap-4 text-white py-2 px-5 rounded-[10px] hover:bg-green  hover:text-black font-black border-2 hover:border-black transition-all duration-100"
        onclick="disponibilidade.showModal()">
        <i class="ri-calendar-line"></i>
        Disponibilidades
    </button>
    <dialog id="disponibilidade" class="modal">
        <div class="modal-box">
            <div class="flex flex-col gap-4">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Campo:</span>
                    </div>
                    <select :data-url="$page.props.apigetagendamentos" v-on:change="getAgendamentos" id="agendamento_campoid"
                        class="select select-bordered w-full max-w-xs">
                        <option v-for=" campo in $page.props.campos " :value="campo.id" :key="campo.id">
                            {{ campo.nome }}
                        </option>
                    </select>
                </label>
                <div class="flex flex-col gap-2">
                    <CardAgendamentoDisponibilidade :key="agendamento.id"  v-for=" agendamento in agendamentos " :endTime="agendamento.end_time" :initTime="agendamento.init_time" :campo="agendamento.campo_nome" :date="agendamento.date"/>
                </div>
            </div>





            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn btn-error text-white">Fechar</button>
                </form>
            </div>
        </div>
    </dialog>
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
        this.getAgendamentos({
            target: {

                dataset: {
                    url: document.getElementById("agendamento_campoid").dataset.url,
                },
                value: document.getElementById("agendamento_campoid").value
            }
        })
    },
    components: {CardAgendamentoDisponibilidade},
}
</script>