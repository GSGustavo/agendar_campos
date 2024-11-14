<script setup>

import Header from '../../../Components/Header.vue';
import CardAgendamento from '../../../Components/CardAgendamento.vue';
import UserAuthLayout from '../../../Shared/User/UserAuthLayout.vue';

</script>

<script>
export default {
    layout: UserAuthLayout
}
</script>

<template>

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

</template>
