<script>
import axios from 'axios';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';
import ModalDisponibilidades from './ModalDisponibilidades.vue';
import Select from './Select.vue';
import DatePickerInstance from "@vuepic/vue-datepicker"

export default {
    components: { VueDatePicker, ModalDisponibilidades, Select },
    data() {
        return {
            date: '',
            date_card: '',
            init_time_card: '',
            end_time_card: '',
            dates: null,
            init_time: null,
            end_time: null,
            indefinteToast: null,
            snackbar: false,
            snackText: null,
            snackColor: null

        }
    },
    props: {
        mode: String,
        startOn: String,
        endOn: String,
        campo: String,
      
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
        const startDate = ref(new Date(2020, 1));
        return { date, time, startTime, datepicker, startDate }
    },
    methods: {
        fixDateAndTime() {
            // Pegando a data e o horário inicial
            const splitStartOn = this.startOn.split(' ')
            const date = splitStartOn[0].split('-')
            this.date_card = `${date[2]}/${date[1]}/${date[0]}`;

            const init_time = splitStartOn[1].split(':')
            this.init_time_card = `${init_time[0]}:${init_time[1]}`

            // Pegando horário final
            const splitEndOn = this.endOn.split(' ')

            const end_time = splitEndOn[1].split(':')
            this.end_time_card = `${end_time[0]}:${end_time[1]}`

        },
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
        },
        selecionarData() {
            this.datepicker.selectDate(ref(new Date(2020, 1)))
        }
    },
    mounted() {
        this.fixDateAndTime()
        this.selecionarData()
    },

}
</script>

<template>
    <div class="flex justify-between border-2 rounded-xl p-5">
        <div class="flex flex-col gap-1 text-md">
            <span :class="(mode === '0' ? 'line-through' : '')">{{ campo }}</span>
            <p :class="'font-black ' + (mode === '0' ? 'line-through' : '')">
                {{ date_card }} ({{ init_time_card }} - {{ end_time_card }})
            </p>
        </div>
        <div class="flex gap-2 text-2xl items-center">
            <v-dialog max-width="500" height="700">
                <template v-slot:activator="{ props: activatorProps }">
                    <v-btn-info v-bind="activatorProps" text=""><i class="ri-pencil-fill"></i> Editar</v-btn-info>
                </template>

                <template v-slot:default="{ isActive }">
                    <v-card title="Editar">

                        <v-card-text>
                            <form method="POST" :action="url" class="flex flex-col gap-10 justify-center items-center h-full"  id="form">
                                <input v-model="start_on" type="hidden" id="start_on" name="start_on">
                                <input v-model="end_on" type="hidden" id="end_on" name="end_on">

                                <div class="flex justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">
                                        <p class="my-2 font-black">
                                            Campo:
                                        </p>
                                        Sintético
                                    </div>
                                </div>

                                <div class="flex justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">
                                        <p class="my-2 font-black">
                                            Escolha as datas que deseja reservar:
                                        </p>

                                        <VueDatePicker ref="datepicker" locale="pt-br" :start-date="startDate" v-model="date"
                                            placeholder="Garanta sua vaga" :multi-dates="{ limit: 1 }"
                                            :enable-time-picker="false" week-start="0"
                                            :day-names="['D', 'S', 'T', 'Q', 'Q', 'S', 'S']"
                                            @update:model-value="handleDate" select-text="Escolher"
                                            cancel-text="Fechar" />
                                    </div>
                                </div>
                                <div class="justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">
                                        <p class="my-2 font-black">
                                            Escolha o horário que deseja reservar:
                                        </p>

                                        <VueDatePicker locale="pt-br" :start-time="startTime" v-model="time" time-picker
                                            :range="{ disableTimeRangeValidation: true }"
                                            placeholder="Escolha seu horário" minutes-increment="5"
                                            @update:model-value="handleTime" select-text="Escolher"
                                            cancel-text="Fechar" />
                                    </div>
                                </div>
                                <div class="mx-auto">
                                    <button @click.prevent="saveAgendamento" type="submit"
                                        class="bg-green text-black py-2 px-5 rounded-[10px] hover:bg-transparent  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                                       
                                        Salvar
                                    </button>
                                </div>
                            </form>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn-error class="m-4" text="Fechar" @click="isActive.value = false"></v-btn-error>
                        </v-card-actions>
                    </v-card>
                </template>
            </v-dialog>
            <div>
                <i :class="'ri-delete-bin-line ' + (mode === '0' ? 'text-gray' : 'cursor-pointer  text-red-500')"></i>

            </div>
        </div>
    </div>
</template>