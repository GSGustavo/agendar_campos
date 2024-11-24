<script>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import ModalDisponibilidades from '../../Components/ModalDisponibilidades.vue';
import AboutBadge from '../../Components/AboutBadge.vue';

export default {
    setup() {

    },
    data() {
        return {
            snackbar: false,
            snackText: null,
            snackColor: null,
            form: useForm({
                email: '',
                password: ''
            })
        }
    },
    methods: {
        showSnackBar(color, msg) {
            this.snackbar = true
            this.snackColor = color
            this.snackText = msg
        },
        submit() {
            if (this.form.email !== '' && this.form.password !== '') {
                this.form.post('/login', {
                    onSuccess: () => {
                        this.showSnackBar('green', 'Login efetuado com sucesso!')

                    },
                    onError: (data) => {
                        const color = 'red'
                        let msg = 'Houve um erro, tente novamente mais tarde!'
                        if (data.email) {
                            msg = 'Email ou senha inválidos!'
                        } else if (data.updatePassword) {

                            if (data.updatePassword.password) {
                                msg = 'A deve ter no mínimo 8 caracteres.'
                            } else if (data.updatePassword.current_password) {
                                msg = 'A senha atual esta incorreta!'
                            } else {
                                msg = 'As senhas não coincidem.'
                            }
                           


                        } else if (data.account) {
                            msg = 'Sua conta encontra-se inativa!'
                        }

                        this.showSnackBar(color, msg)
                    },

                })
            } else {
                this.showSnackBar('red', 'Preencha os campos corretamente!')
            }

        }
    },
    components: { Link, ModalDisponibilidades, AboutBadge }
}
</script>




<template>
    <div class="flex justify-center p-10">
        <div class="flex flex-col w-[350px] xl:w-[500px] gap-4">
            <div class="flex justify-center">
                <AboutBadge />
            </div>
            <div class="">
                <div class="text-center p-5">
                    <h3 class="h3 text-2xl font-black">
                        Fazer Login
                    </h3>
                </div>
            </div>



            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Email: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field autocomplete="email" type="email" v-model="form.email" variant="outlined"
                        prepend-inner-icon="ri-mail-line" placeholder="Insira seu email"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Senha: <span class="text-red-500">*</span>
                    </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">

                    <v-text-field type="password" v-model="form.password" variant="outlined"
                        prepend-inner-icon="ri-shield-keyhole-line" placeholder="Insira sua senha"></v-text-field>
                </label>

            </div>
            <div class="">
                <div class="text-center">

                    <v-btn @click="submit">Entrar</v-btn>
                </div>
            </div>


            <div class="flex w-full flex-col border-opacity-50">

                <v-divider class="border-opacity-100" :thickness="3" color="primary">Ou</v-divider>

            </div>

            <div class="flex flex-col gap-4">
                <div class="text-center">

                    <Link as="button" href="/register"
                        class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                    Crie sua conta
                    </Link>
                </div>
            </div>

            <div class="mt-20">
                <p class="text-center">
                    Deseja apenas ver as disponibilidades? Clique no botão abaixo.
                </p>
            </div>

            <ModalDisponibilidades />
        </div>
    </div>
    <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
        <p class="text-center font-black">
            {{ snackText }}
        </p>
    </v-snackbar>
</template>
