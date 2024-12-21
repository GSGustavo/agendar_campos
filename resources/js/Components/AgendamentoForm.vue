<script>
import axios from 'axios';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';
import ModalDisponibilidades from './ModalDisponibilidades.vue';
import Select from './Select.vue';
import DatePickerInstance from "@vuepic/vue-datepicker"
import { Link } from '@inertiajs/vue3';



export default {
    components: { VueDatePicker, ModalDisponibilidades, Select, Link },
    props: {
        'url': String
    },
    setup() {

        const date = ref();
        const time = ref();
        const datepicker = ref < DatePickerInstance > (null);
        const startTime = ref(
            [
                {
                    hours: 19,
                    minutes: 0
                },
                {
                    hours: 21,
                    minutes: 0
                }
            ]
        )
        return { date, time, startTime, datepicker }
    },
    data() {
        return {
            dates: null,
            init_time: null,
            end_time: null,
            indefinteToast: null,
            snackbar: false,
            snackText: null,
            snackColor: null
        }
    },

    methods: {
        saveAgendamento() {
            if (this.dates && this.init_time && this.end_time) {
                axios.post($("#form").attr("action"),
                    {
                        campo_id: document.getElementById("campo_id").value,
                        start_on: `${this.dates[0]} ${this.init_time}`,
                        end_on: `${this.dates[0]} ${this.end_time}`
                    }
                ).then((response) => {
                    if (response.data.status) {
                        this.snackText = 'Agendamento efetuado com sucesso!'
                        this.snackColor = 'green'
                        // this.datepicker.value.clearValue()
                    } else {
                        this.snackText = 'Houve um erro, tente novamente mais tarde!'
                        this.snackColor = 'red'

                        if (response.data.error === 1) {
                            this.snackText = 'Sem disponibilidade!'
                        }
                    }
                })
            } else {
                this.snackText = 'Preencha todos os campos!'
                this.snackColor = 'red'
            }
            this.snackbar = true
        },
        handleDate(modelData) {
            let datesJson = modelData
            if (modelData) {
                const dates = Array()
                // biome-ignore lint/complexity/noForEach: <explanation>
                modelData.forEach(date => {
                    // 2000-12-31
                    const year = date.getFullYear()
                    const month = String(date.getMonth() + 1).padStart(2, '0')
                    const day = String(date.getDate()).padStart(2, '0')

                    dates.push(`${year}-${month}-${day}`)
                });

                datesJson = dates;
            }

            this.dates = datesJson

        },
        handleTime(modelData) {
            let modelDataInit = null
            let modelDataEnd = null

            if (modelData) {
                const initHour = String(modelData[0].hours).padStart(2, '0');
                const initMinutes = String(modelData[0].minutes).padStart(2, '0');

                const endHour = String(modelData[1].hours).padStart(2, '0');
                const endMinutes = String(modelData[1].minutes).padStart(2, '0');

                modelDataInit = `${initHour}:${initMinutes}`
                modelDataEnd = `${endHour}:${endMinutes}`
            }

            this.init_time = modelDataInit
            this.end_time = modelDataEnd
        }
    }
}

</script>

<template>

    <div class="flex flex-col gap-5 justify-center items-center">

        <template v-if="!$page.props.permitiragendamento">
            <v-alert icon="ri-information-line"
                text="Você ainda não pode realizar agendamentos pois precisa completar seu cadastro."
                title="Complete seu cadastro" type="error" variant="tonal">
            </v-alert>
            <Link as="button" href="/profile">
            <v-btn-info> <v-icon icon="ri-arrow-right-s-fill"></v-icon> Completar Cadastro</v-btn-info>
            </Link>
        </template>
        <template v-else>
            <form method="POST" :action="url" class="flex flex-col gap-10 justify-center items-center" id="form">
                <input v-model="start_on" type="hidden" id="start_on" name="start_on">
                <input v-model="end_on" type="hidden" id="end_on" name="end_on">

                <div class="flex justify-center items-center">
                    <div class="w-[300px] flex flex-col mx-auto">
                        <p class="my-2 font-black">
                            Escolha o campo:
                        </p>
                        <Select />
                    </div>
                </div>


                <div class="flex justify-center items-center">
                    <div class="w-[300px] flex flex-col mx-auto">
                        <p class="my-2 font-black">
                            Escolha as datas que deseja reservar:
                        </p>

                        <VueDatePicker ref="datepicker" id="teste" locale="pt-br" v-model="date"
                            placeholder="Garanta sua vaga" :multi-dates="{ limit: 1 }" :enable-time-picker="false"
                            week-start="0" :day-names="['D', 'S', 'T', 'Q', 'Q', 'S', 'S']"
                            @update:model-value="handleDate" select-text="Escolher" cancel-text="Fechar" />
                    </div>
                </div>
                <div class="justify-center items-center">
                    <div class="w-[300px] flex flex-col mx-auto">
                        <p class="my-2 font-black">
                            Escolha o horário que deseja reservar:
                        </p>

                        <VueDatePicker locale="pt-br" :start-time="startTime" v-model="time" time-picker
                            :range="{ disableTimeRangeValidation: true }" placeholder="Escolha seu horário"
                            minutes-increment="5" @update:model-value="handleTime" select-text="Escolher"
                            cancel-text="Fechar" />
                    </div>
                </div>
                <div class="mx-auto">
                    <button @click.prevent="saveAgendamento" type="submit"
                        class="bg-green text-black py-2 px-5 rounded-[10px] hover:bg-transparent  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                        <i class="ri-calendar-line" />
                        Agendar
                    </button>
                </div>
            </form>
        </template>


        <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
            <p class="text-center font-black">
                {{ snackText }}
            </p>
        </v-snackbar>
    </div>
</template>
