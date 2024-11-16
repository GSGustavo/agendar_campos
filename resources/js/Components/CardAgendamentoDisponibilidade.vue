<template>
    <div class="flex justify-between border-2 border-green rounded-xl p-5">
        <div class="flex flex-col gap-1 text-md">
            <span :class="(mode === '0' ? 'line-through' : '')">{{ campo }}</span>
            <p :class="'font-black ' + (mode === '0' ? 'line-through' : '')">
                {{ dates }} ({{ init_time }} - {{ end_time }})
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
            dates: '',
            init_time: '',
            end_time: ''
        }
    },
    props: {
        mode: String,
        initTime: String,
        endTime: String,
        date: String,
        campo: String

    },
    setup() {

    },
    methods: {
        fixDateAndTime() {
            const splitDate = this.date.split('-')
            this.dates = `${splitDate[2]}/${splitDate[1]}/${splitDate[0]}`;


            const splitInitTime = this.initTime.split(":")
            this.init_time = `${splitInitTime[0]}:${splitInitTime[1]}`

             const splitEndTime = this.endTime.split(":")
            this.end_time = `${splitEndTime[0]}:${splitEndTime[1]}`

        },
    },
    mounted() {
        this.fixDateAndTime()
    },

}
</script>