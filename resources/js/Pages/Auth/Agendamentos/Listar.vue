<script>
import App from '../../../App.vue';
import Header from '../../../Components/Header.vue';
import CardAgendamento from '../../../Components/CardAgendamento.vue';


export default {
    components: { App, Header, CardAgendamento }
}
</script>

<template>
    <App floatbarmode="0">
        <div class="flex flex-col gap-10 p-10">
            <Header>
                <h1 class="font-black text-2xl"> Seus Agendamentos</h1>
            </Header>

            <div class="flex flex-col gap-4">
                <p class="text-xl font-black">
                    2024
                </p>

                <!-- agendamentos list -->
                <div class="flex flex-col gap-5">
                    <CardAgendamento mode="1"/>
                    <CardAgendamento mode="1"/>
                    <CardAgendamento mode="1"/>
                    <CardAgendamento mode="1"/>
                </div>
                <!-- agendamentos list -->
            </div>
        </div>
    </App>
</template>
