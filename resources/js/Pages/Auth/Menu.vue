<script setup>
import UserAuthLayout from '../../Shared/User/UserAuthLayout.vue';
import AgendamentoForm from '../../Components/AgendamentoForm.vue';
import Header from '../../Components/Header.vue';
import Select from '../../Components/Select.vue';
</script>

<script>

export default {
    layout: UserAuthLayout,
    
}
</script>

<template>
    <div class="flex flex-col gap-10 p-10">
        <Header>
            <Select />
        </Header>


        <AgendamentoForm url="/menu/agendamento/save" />


        <div class="w-full border-solid border-2 rounded-xl flex flex-col p-5 gap-4">
            <p class="text-center font-black text-xl">Como chegar no campo?</p>
            <iframe id="iframe" ref="iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr"
                height="450" loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</template>
