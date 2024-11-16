<script setup>
import Select from './Select.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="">
            <button class="badge badge-info gap-2 text-white p-3" onclick="about.showModal()">Sobre</button>
            <dialog id="about" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold text-center">Sobre o projeto!</h3>

                    <div class=" my-4 flex flex-col gap-2">
                        <p class="">Versão: {{ $page.props.appVersion }}</p>
                        <p class="">Última Atualização: {{ $page.props.lastUpdate }}</p>
                        <p class="">Desenvolvido por: <a class="underline" target="_blank"
                                :href="$page.props.sociallinktree">Gustavo Gonzaga</a></p>
                        <div class="flex w-full flex-col border-opacity-50">

                            <div class="divider">Doe</div>

                        </div>
                        <p class="text-center">Para o projeto continuar ativo e atualizado, faça sua doação:</p>
                        <div class="my-5 flex gap-2 items-center justify-center">
                            <a class="badge badge-success text-white p-5 text-xl font-black" href="">
                                R$1
                            </a>
                            <a class="badge badge-success text-white p-5 text-xl font-black" href="">
                                R$2
                            </a>
                            <a class="badge badge-success text-white p-5 text-xl font-black" href="">
                                R$5
                            </a>
                            <a class="badge badge-success text-white p-5 text-xl font-black" href="">
                                R$10
                            </a>
                        </div>
                    </div>


                    <div class="modal-action">
                        <form method="dialog">
                            <!-- if there is a button in form, it will close the modal -->
                            <button class="btn btn-error text-white">Fechar</button>
                        </form>
                    </div>
                </div>
            </dialog>
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