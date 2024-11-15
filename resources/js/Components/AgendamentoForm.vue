<template>

    <div class="flex flex-col gap-5 justify-center items-center">

        <ModalDisponibilidades />

        <form method="POST" :action="url" class="flex flex-col gap-10 justify-center items-center" id="form">
            <input v-model="dates" type="hidden" id="dates">
            <input v-model="init_time" type="hidden" name="init_time" id="init_time">
            <input v-model="end_time" type="hidden" name="end_time" id="end_time">

            <div class="flex justify-center items-center">
                <div class="w-[300px] flex flex-col mx-auto">
                    <p class="my-2 font-black text-center">
                        Escolha as datas que deseja reservar:
                    </p>
                    <VueDatePicker id="teste" locale="pt-br" v-model="date" placeholder="Garanta sua vaga"
                        :multi-dates="{ limit: 3 }" :enable-time-picker="false" week-start="0"
                        :day-names="['D', 'S', 'T', 'Q', 'Q', 'S', 'S']" @update:model-value="handleDate"
                        select-text="Escolher" cancel-text="Fechar" />
                </div>
            </div>
            <div class="justify-center items-center">
                <div class="w-[300px] flex flex-col mx-auto">
                    <p class="my-2 font-black text-center">
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
                    class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-green  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                    <i class="ri-calendar-line" />
                    Agendar
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue';
import ModalDisponibilidades from './ModalDisponibilidades.vue';



export default {
    components: { VueDatePicker, ModalDisponibilidades },
    props: {
        'url': String
    },
    setup() {

        const date = ref();
        const time = ref();
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
        return { date, time, startTime }
    },
    data() {
        return {
            dates: null,
            init_time: null,
            end_time: null
        }
    },


    methods: {
        saveAgendamento() {
            axios.post($("#form").attr("action"),
                {
                    dates: this.dates,
                    init_time: this.init_time,
                    end_time: this.end_time
                }
            ).then((response) => {
                console.log(response)
            })
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

                datesJson = JSON.stringify(dates);
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


<!-- Como não tem como bloquear as datas anteriores ao dia atual 
 será feito uma validação a cada data selecionada via JS vanilla -->


<!-- https://vue3datepicker.com/props/general-configuration/#loading -->

<!-- Usar isso caso tenha alguma manutenção no campo por exemplo: -->
<!-- https://vue3datepicker.com/slots/content/#marker -->