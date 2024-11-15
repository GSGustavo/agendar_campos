<script setup>
import Select from './Select.vue';

</script>

<template>
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="">
            Versão:
            <div class="badge badge-info gap-2 text-white">
                {{ $page.props.appVersion }}
            </div>
        </div>
        <div class="mb-5">
            <p class="text-center">{{ $page.props.today }}</p>
        </div>
        <div class="flex w-full">
            <div class="flex justify-between w-full">
                <div class="flex self-end">
                    <h1 class="font-black text-2xl">Olá, {{ $page.props.name }}!</h1>
                </div>
                <div>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>