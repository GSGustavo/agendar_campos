<template>
    <form method="POST" :action="url" class="flex flex-col gap-10" id="form">
        <div class="flex justify-center items-center">
            <div class="w-[300px] flex flex-col mx-auto">
                <p class="my-2 font-black text-center">
                    Escolha as datas que deseja reservar:
                </p>
                <date-picker />
            </div>
        </div>
        <div class="justify-center items-center">
            <div class="w-[300px] flex flex-col mx-auto">
                <p class="my-2 font-black text-center">
                    Escolha o horário que deseja reservar:
                </p>
                <time-picker />
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
</template>

<script>
import axios from 'axios';


export default {
    data() {
        return {
            dates: '',
            init_time: '',
            end_time: ''
        }
    },
    methods: {
        saveAgendamento() {
            axios.post($("#form").attr("action"),
                {
                    dates: $("#dates").val(),
                    init_time: $("#init_time").val(),
                    end_time: $("#end_time").val()
                }
            ).then((response) => {
                console.log(response)
            })
        },

    }
}
</script>