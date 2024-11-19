<script setup>
import Select from './Select.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="">

            <v-dialog max-width="500">
                <template v-slot:activator="{ props: activatorProps }">
                    <v-btn-info v-bind="activatorProps" text="Sobre"></v-btn-info>
                </template>

                <template v-slot:default="{ isActive }">
                    <v-card>
                        
                        <v-card-text>
                            <h3 class="text-lg font-bold text-center">Sobre o projeto!</h3>
                            <div class=" my-4 flex flex-col gap-8">
                                <div class="flex flex-col gap-2">
                                    <p class="">Versão: {{ $page.props.appVersion }}</p>
                                    <p class="">Última Atualização: {{ $page.props.lastUpdate }}</p>
                                    <p class="">Desenvolvido por: <a class="underline" target="_blank"
                                            :href="$page.props.sociallinktree">Gustavo Gonzaga</a></p>
                                </div>
                            

                                    <v-divider class="border-opacity-100" :thickness="3" color="primary">Doe</v-divider>

                              
                                <p class="text-center">Para o projeto continuar ativo e atualizado, faça sua doação:</p>
                                <div class="my-5 flex gap-2 items-center justify-center">
                                    <v-btn-doe target="_blank" href="https://google.com">R$1</v-btn-doe>
                                    <v-btn-doe target="_blank" href="https://google.com">R$2</v-btn-doe>
                                    <v-btn-doe target="_blank" href="https://google.com">R$5</v-btn-doe>
                                    <v-btn-doe target="_blank" href="https://google.com">R$10</v-btn-doe>
                                </div>
                            </div>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn-error  class="m-4"  text="Fechar" @click="isActive.value = false"></v-btn-error>
                        </v-card-actions>
                    </v-card>
                </template>
            </v-dialog>
        </div>
        <div class="mb-5">
            <p class="text-center">{{ $page.props.today }}</p>
        </div>
        <div class="flex w-full">
            <div class="flex justify-between w-full">
                <div class="flex self-end">
                    <h1 class="font-black text-2xl">Olá, {{ $page.props.user.name }}!</h1>
                </div>
                <div>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>