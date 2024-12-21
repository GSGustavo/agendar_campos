<script>
import UserAuthLayout from '../../Shared/User/UserAuthLayout.vue';
import Header from '../../Components/Header.vue';
import { useForm, usePage } from '@inertiajs/vue3'

export default {
    layout: UserAuthLayout,
    data() {
        return {

            snackbar: false,
            snackText: null,
            snackColor: null,
            cpfvalido: false,
            cpfMsg: 'Digite seu CPF',
            cpfMsgType: 'error',
            logoutForm: useForm({}),
            saveProfileForm: useForm({
                'name': usePage().props.user.name,
                'lastname': usePage().props.user.lastname,
                'email': usePage().props.user.email,
                'cpf': usePage().props.user.cpf,
            }),
            changePasswordForm: useForm({
                'current_password': '',
                'password': '',
                'password_confirmation': ''
            })
        }
    },
    setup() {

    },
    methods: {

        showSnackBar(color, msg) {
            this.snackbar = true
            this.snackColor = color
            this.snackText = msg
        },
        save() {
            if (this.saveProfileForm.name !== '' &&
                this.saveProfileForm.lastname !== '' &&
                this.saveProfileForm.email !== "" &&

                (this.saveProfileForm.cpf !== '' ? this.saveProfileForm.cpf.lenght === 11 : true)
            ) {
                this.saveProfileForm.patch('/profile', {
                    onSuccess: () => {
                        this.showSnackBar('green', 'Perfil atualizado com sucesso!')

                    },
                    onError: (data) => {
                        const color = 'red'
                        let msg = 'Houve um erro, tente novamente mais tarde!'
                        if (data.email) {
                            msg = 'O email ja esta sendo utilizado!'
                        }

                        this.showSnackBar(color, msg)
                    }
                })
            } else {
                this.showSnackBar('red', 'Preencha os campos corretamente!')
            }

        },
        logout() {
            this.logoutForm.post('/logout')
        },
        changepass() {
            if (this.changePasswordForm.current_password !== '' && this.changePasswordForm.password !== '' && this.changePasswordForm.password_confirmation !== '') {
                this.changePasswordForm.put(
                    '/password',
                    {
                        onSuccess: () => {
                            this.showSnackBar('green', 'Senha atualizada com sucesso!')

                        },
                        onError: (data) => {
                            const color = 'red'
                            let msg = 'Houve um erro, tente novamente mais tarde!'
                            if (data.email) {
                                msg = 'O email ja esta sendo utilizado!'
                            } else if (data.updatePassword) {
                                msg = 'As senhas não coincidem.'
                            } else if (data.updatePassword.password) {
                                msg = 'A deve ter no mínimo 8 caracteres.'
                            } else if (data.updatePassword.current_password) {
                                msg = 'A senha atual esta incorreta!'
                            }

                            this.showSnackBar(color, msg)
                        },

                    }
                )
            } else {
                this.showSnackBar('red', 'Preencha os campos corretamente!')
            }

            this.changePasswordForm.current_password = ''
            this.changePasswordForm.password = ''
            this.changePasswordForm.password_confirmation = ''
        }
    },
    components: { Header }
}
</script>


<template>



    <div class="flex flex-col gap-10 p-10">
        <Header>

            <v-btn-error @click="logout">
                <i class="ri-logout-box-r-line"></i> Sair
            </v-btn-error>
        </Header>

        <div class="flex flex-col gap-4  ">

            <v-alert icon="ri-information-line"
                text="Para utilizar as ferramentas de agendamentos, você precisa cadastrar seu CPF."
                title="Agendamentos" type="error" variant="tonal">
            </v-alert>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">CPF: <span class="text-red-500 text-sm">Apenas
                            Números</span></span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field type="number" v-model="saveProfileForm.cpf" variant="outlined"
                        prepend-inner-icon="ri-info-card-line" placeholder="Apenas números"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Nome: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field v-model="saveProfileForm.name" variant="outlined"
                        placeholder="Ex.: João"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Sobrenome: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field v-model="saveProfileForm.lastname" variant="outlined"
                        placeholder="Ex.: da Silva"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Email: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field v-model="saveProfileForm.email" variant="outlined" prepend-inner-icon="ri-mail-line"
                        placeholder="Insira seu melhor email"></v-text-field>
                </label>

            </div>


            <div class="flex justify-center">
                <v-btn-success @click="save">Salvar</v-btn-success>
            </div>

            <div class="my-20">
                <p class="text-center my-5">
                    Alterar senha
                </p>
                <v-dialog max-width="500">
                    <template v-slot:activator="{ props: activatorProps }">
                        <div class="flex justify-center">
                            <v-btn-info v-bind="activatorProps">Alterar minha senha</v-btn-info>
                        </div>
                    </template>
                    <template v-slot:default="{ isActive }">
                        <v-card title="Alterar minha senha">
                            <v-card-text>
                                <div class="flex flex-col gap-2">
                                    <div>
                                        <span class="label-text font-black">Senha atual: <span
                                                class="text-red-500">*</span>
                                        </span>
                                    </div>
                                    <label class="input input-bordered flex items-center gap-2">
                                        <v-text-field type="password" v-model="changePasswordForm.current_password"
                                            variant="outlined" prepend-inner-icon="ri-shield-keyhole-line"
                                            placeholder="Insira sua senha atual"></v-text-field>
                                    </label>
                                </div>
                                <v-divider class="border-opacity-100" :thickness="3" color="primary">Nova
                                    senha</v-divider>
                                <div class="flex flex-col gap-2">
                                    <div>
                                        <span class="label-text font-black">Nova senha: <span
                                                class="text-red-500">*</span>
                                        </span>
                                    </div>
                                    <label class="input input-bordered flex items-center gap-2">
                                        <v-text-field type="password" v-model="changePasswordForm.password"
                                            variant="outlined" prepend-inner-icon="ri-shield-keyhole-line"
                                            placeholder="Crie uma nova senha"></v-text-field>
                                    </label>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div>
                                        <span class="label-text font-black">Confirmar nova senha: <span
                                                class="text-red-500">*</span> </span>
                                    </div>
                                    <label class="input input-bordered flex items-center gap-2">
                                        <v-text-field type="password" v-model="changePasswordForm.password_confirmation"
                                            variant="outlined" prepend-inner-icon="ri-shield-keyhole-line"
                                            placeholder="Confirme a nova senha"></v-text-field>
                                    </label>
                                </div>
                                <div class="flex justify-center">
                                    <v-btn-success
                                        @click="() => { changepass(); isActive.value = false }">Alterar</v-btn-success>
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn-error class="m-4" text="Fechar" @click="isActive.value = false"></v-btn-error>
                            </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>
            </div>

            <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
                <p class="text-center font-black">
                    {{ snackText }}
                </p>
            </v-snackbar>
        </div>
    </div>

</template>
