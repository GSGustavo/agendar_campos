<script>
import App from '../../App.vue';
import Header from '../../Components/Header.vue';



export default {
    components: { App, Header }
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

                <div class="flex justify-between border-2 rounded-md p-5">
                    <div class="flex flex-col gap-1 text-md">
                        Sintético
                        <p class="font-black">
                            14 de Outubro (19:00 - 21:00)
                        </p>
                    </div>
                    <div class="flex gap-2 text-2xl">
                        <button class="w-10 h-10 bg-blue rounded-md text-white transition-all duration-150 hover:text-blue hover:bg-transparent">
                            <i class="ri-pencil-fill"></i>
                        </button>
                        <button>
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>
