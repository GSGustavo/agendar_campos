<template>
    <div class="flex justify-between border-2 rounded-xl p-5">
        <div class="flex flex-col gap-1 text-md">
            <span :class="(mode === '0' ? 'line-through' : '')">{{ campo }}</span>
            <p :class="'font-black ' + (mode === '0' ? 'line-through' : '')">
                {{ dates }} ({{ initTime }} - {{ endTime }})
            </p>
        </div>

    </div>
</template>

<script>
export default {

    data() {
        return {
            dates: ''
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
        arrumarData() {
            const splitDate = this.date.split('-')
            console.log(`${splitDate[2]}/${splitDate[1]}/${splitDate[0]}`)
            this.dates = `${splitDate[2]}/${splitDate[1]}/${splitDate[0]}`;
        }
    },
    mounted() {
        this.arrumarData()
    },

}
</script>