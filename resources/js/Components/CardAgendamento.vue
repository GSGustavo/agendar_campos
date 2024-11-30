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
            hasChangedDates: false,
            hasChangedTime: false,
            date: '',
            date_card: '',
            init_time_card: '',
            end_time_card: '',
            dates: null,
            startTime: ref(
                [
                    {
                        hours: 0,
                        minutes: 0
                    },
                    {
                        hours: 0,
                        minutes: 0
                    }
                ]
            ),

            originalDates: null,
            originalTimes: ref(
                [
                    {
                        hours: 0,
                        minutes: 0
                    },
                    {
                        hours: 0,
                        minutes: 0
                    }
                ]
            ),

            init_time: null,
            end_time: null,
            indefinteToast: null,
            snackbar: false,
            snackText: null,
            snackColor: null,
            init_hour: null,
            init_min: null,
            end_hour: null,
            end_min: null,


            mode: null
        }
    },
    props: {
        // mode: String,
        startOn: String,
        endOn: String,
        campo: String,
        id: Number,
        campo_id: Number,
        url: String,
        urldestroy: String
    },
    setup(props) {
        const date = ref([new Date(props.startOn)]);
        const time = ref();
        const datepicker = ref < DatePickerInstance > (null);
        // const startTime = ref(
        //     [
        //         {
        //             hours: data.init_hour,
        //             minutes: this.init_min
        //         },
        //         {
        //             hours: this.end_hour,
        //             minutes: this.end_min
        //         }
        //     ]
        // )


        // date.value = [startDate]
        return { date, time, datepicker }
    },
    methods: {
        fixDateAndTime() {
            // Pegando a data e o horário inicial
            const splitStartOn = this.startOn.split(' ')
            const date = splitStartOn[0].split('-')
            this.date_card = `${date[2]}/${date[1]}/${date[0]}`;

            // Atribuindo o valor da data no data -> data
            this.originalDates = [splitStartOn[0]]

            const init_time = splitStartOn[1].split(':')
            this.init_time_card = `${init_time[0]}:${init_time[1]}`


            // Pegando horário final
            const splitEndOn = this.endOn.split(' ')

            const end_time = splitEndOn[1].split(':')
            this.end_time_card = `${end_time[0]}:${end_time[1]}`

            this.startTime[0].hours = init_time[0]
            this.startTime[0].minutes = init_time[1]
            this.startTime[1].hours = end_time[0]
            this.startTime[1].minutes = end_time[1]

            this.originalTimes[0].hours = init_time[0]
            this.originalTimes[0].minutes = init_time[1]
            this.originalTimes[1].hours = end_time[0]
            this.originalTimes[1].minutes = end_time[1]


            // Preenchendo os valores dos inputs
            this.init_time = `${init_time[0]}:${init_time[1]}`
            this.end_time = `${end_time[0]}:${end_time[1]}`

            this.dates = [splitStartOn[0]]

        },
        saveAgendamento() {
            this.snackText = null
            this.snackColor = null
            if (!this.hasChangedDates && !this.hasChangedTime) {
                this.snackText = 'Não houve mudanças!'
                this.snackColor = 'red'
            } else if (this.dates && this.init_time && this.end_time) {
                axios.post($("#form").attr("action"),
                    {
                        id: this.id,
                        campo_id: this.campo_id,
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

            if (this.originalDates[0] !== datesJson[0]) {
                this.hasChangedDates = true
            } else {
                this.hasChangedDates = false
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

                const pickedTimeRef =
                    [
                        {
                            hours: initHour,
                            minutes: initMinutes
                        },
                        {
                            hours: endHour,
                            minutes: endMinutes
                        }
                    ]


                if (
                    (this.originalTimes[0].hours !== pickedTimeRef[0].hours ||
                        this.originalTimes[0].minutes !== pickedTimeRef[0].minutes) ||
                    this.originalTimes[1].hours !== pickedTimeRef[1].hours ||
                    this.originalTimes[1].minutes !== pickedTimeRef[1].minutes) {
                    this.hasChangedTime = true
                } else {
                    this.hasChangedTime = false
                }
            }


            this.init_time = modelDataInit
            this.end_time = modelDataEnd
        },
        setMode() {
            const startOn = new Date(this.startOn)
            const endOn = new Date(this.endOn)
            const now = new Date()

            // modos
            // 0 desativado
            // 1 ativo
            // 2 live


            if (now > startOn && now < endOn) {
                this.mode = 2
            } else if (startOn < now) {
                this.mode = 0
            } else {
                this.mode = 1
            }
        },
        destroyAgendamento() {
            this.snackText = null
            this.snackColor = null

            axios.post(this.urldestroy,
                {
                    id: this.id,
                }
            ).then((response) => {
                if (response.data.status) {
                    this.snackText = 'Agendamento excluído com sucesso!'
                    this.snackColor = 'green'
                    // this.datepicker.value.clearValue()
                } else {
                    this.snackText = 'Houve um erro, tente novamente mais tarde!'
                    this.snackColor = 'red'
                }
            })

            this.snackbar = true
            setTimeout(() => {
                this.$emit('updateComponent')
            }, 1500);
        },
        
    },
    mounted() {
        this.fixDateAndTime()
        this.setMode()
    },
    emits: ['updateComponent']
}



</script>

<template>
    <div class="flex justify-between items-center border-2 rounded-xl p-5">



        <div v-if="mode === 0" class="flex flex-col gap-1 text-md">
            <span class="line-through">{{ campo }}</span>
            <p class='font-black line-through'>
                {{ date_card }} ({{ init_time_card }} - {{ end_time_card }})
            </p>
        </div>

        <div v-else-if="mode === 1" class="flex flex-col gap-1 text-md">
            <span>{{ campo }}</span>
            <p class='font-black'>
                {{ date_card }} ({{ init_time_card }} - {{ end_time_card }})
            </p>
        </div>

        <div v-else class="flex flex-col gap-1 text-md">
            <span>{{ campo }}</span>
            <p class='font-black'>
                {{ date_card }} ({{ init_time_card }} - {{ end_time_card }})
            </p>
        </div>

        <div v-if="mode === 2" class="blob"></div>

        <div v-if="mode === 1 || mode == 0" class="flex gap-2 text-2xl items-center">
            <v-dialog max-width="500" height="700">
                <template v-slot:activator="{ props: activatorProps }">
                    <v-btn-info v-if="mode === 1" v-bind="activatorProps" text=""><i class="ri-pencil-fill"></i>
                        Editar</v-btn-info>
                    <v-btn-disabled v-else-if="mode === 0"><i class="ri-pencil-fill"></i>
                        Editar</v-btn-disabled>

                </template>

                <template v-slot:default="{ isActive }">
                    <v-card title="Editar">

                        <v-card-text>
                            <form method="POST" :action="url" class="flex flex-col gap-10  h-full" id="form">
                                <input v-model="start_on" type="hidden" id="start_on" name="start_on">
                                <input v-model="end_on" type="hidden" id="end_on" name="end_on">

                                <div class="flex justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">
                                        <p class="my-2 font-black">
                                            Campo:
                                        </p>
                                        {{ campo }}
                                    </div>
                                </div>

                                <div class="flex justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">
                                        <p class="my-2 font-black">
                                            Escolha as datas que deseja reservar:
                                        </p>

                                        <VueDatePicker ref="datepicker" locale="pt-br" :start-date="startDate"
                                            v-model="date" placeholder="Garanta sua vaga" :multi-dates="{ limit: 1 }"
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

                                        <VueDatePicker locale="pt-br" :start-time="startTime" v-model="startTime"
                                            time-picker :range="{ disableTimeRangeValidation: true }"
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


            <v-dialog max-width="500">
                <template v-slot:activator="{ props: activatorProps }">
                    <v-btn-none v-if="mode === 1" v-bind="activatorProps" text="">
                        <i class="text-2xl ri-delete-bin-line text-gray cursor-pointer text-red-500"></i>
                    </v-btn-none>


                </template>

                <template v-slot:default="{ isActive }">
                    <v-card title="Excluir">

                        <v-card-text>
                            <form method="POST" :action="urldestroy"
                                class="flex flex-col gap-10  h-full items-center justify-center" id="formdestroy">


                                <div class="flex justify-center items-center">
                                    <div class="w-[300px] flex flex-col mx-auto">

                                        <i class="ri-information-line text-center text-5xl text-red-500"></i>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col justify-center items-center text-center font-black gap-4 max-w-[400px]">
                                    <p>
                                        ATENÇÃO!
                                    </p>
                                    <p>
                                        Ao clicar em "Excluir", este agendamento será permanentemente apagado. Deseja
                                        realmente prosseguir com a ação?
                                    </p>
                                </div>

                                <div class="mx-auto">
                                    <v-btn-error @click.prevent="destroyAgendamento" type="submit" @click="isActive.value = false">

                                        Sim
                                    </v-btn-error>
                                </div>
                            </form>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn-error class="m-4" text="Cancelar" @click="isActive.value = false"></v-btn-error>
                        </v-card-actions>
                    </v-card>
                </template>
            </v-dialog>



        </div>
    </div>
    <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
        <p class="text-center font-black">
            {{ snackText }}
        </p>
    </v-snackbar>
</template>