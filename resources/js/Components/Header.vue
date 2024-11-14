<script setup>
import Select from './Select.vue';


</script>

<template>
    <div class="mb-5">
        <p class="text-center">14 de outubro, 2024</p>
    </div>
    <div class="flex justify-between">
        <div class="self-center ">
            <h1 class="font-black text-2xl">Olá, João</h1>
        </div>
        <div>

            <slot />

        </div>
    </div>
</template>