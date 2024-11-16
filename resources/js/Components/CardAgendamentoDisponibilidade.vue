<template>
    <div class="flex justify-between border-2 border-green rounded-xl p-5">
        <div class="flex flex-col gap-1 text-md">
            <span :class="(mode === '0' ? 'line-through' : '')">{{ campo }}</span>
            <p :class="'font-black ' + (mode === '0' ? 'line-through' : '')">
                {{ date }} ({{ init_time }} - {{ end_time }})
            </p>
        </div>

        <div class="flex gap-2 text-2xl items-center">
            <div class="flex justify-center items-center w-10 h-10  rounded-md text-white transition-all duration-150 bg-green ">
                <i class="ri-checkbox-fill"></i>
            </div>
            
        </div>

    </div>
</template>

<script>
export default {

    data() {
        return {
            date: '',
            init_time: '',
            end_time: ''
        }
    },
    props: {
        mode: String,
        startOn: String,
        endOn: String,
        campo: String

    },
    setup() {

    },
    methods: {
        fixDateAndTime() {

            // Pegando a data e o horário inicial
            const splitStartOn = this.startOn.split(' ')
            const date = splitStartOn[0].split('-')
            this.date = `${date[2]}/${date[1]}/${date[0]}`;

            const init_time = splitStartOn[1].split(':')
            this.init_time = `${init_time[0]}:${init_time[1]}`

            // Pegando horário final
            const splitEndOn = this.endOn.split(' ')

            const end_time = splitEndOn[1].split(':')
            this.end_time = `${end_time[0]}:${end_time[1]}`

        },
    },
    mounted() {
        this.fixDateAndTime()
    },

}
</script>