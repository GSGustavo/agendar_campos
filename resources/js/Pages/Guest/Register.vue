<script>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
export default {
    setup() {
        return {}
    },
    data() {
        return {
            form: useForm({
                name: '',
                email: '',
                lastname: '',
                password: '',
                password_confirmation: ''
            }),
            snackbar: false,
            snackText: null,
            snackColor: null,
        }
    },
    components: {
        Link
    },
    methods: {
        showSnackBar(color, msg) {
            this.snackbar = true
            this.snackColor = color
            this.snackText = msg
        },
        submit() {

            if (this.form.name !== '' &&
            this.form.email !== '' &&
            this.form.lastname !== '' &&
            this.form.password !== '' &&
            this.form.password_confirmation !== '') {
                this.form.post('/register',  {
                    onSuccess: () => {
                        this.showSnackBar('green', 'Conta criada com sucesso!')

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
                    
                })
            } else {
                this.showSnackBar('red', 'Preencha os campos corretamente!')
            }

                
        }
    }
}

</script>

<template>

    <div class="flex flex-col gap-10 p-10 justify-center items-center">
        <p class="text-center font-black text-2xl">
            Criar uma Conta
        </p>
        <div class="flex flex-col gap-4 w-full max-w-xl ">

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Nome: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field v-model="form.name" variant="outlined" placeholder="Ex.: João"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Sobrenome: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field v-model="form.lastname" variant="outlined" placeholder="Ex.: da Silva"></v-text-field>
                </label>

            </div>
            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Email: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">


                    <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                    <v-text-field type="email" v-model="form.email" variant="outlined" prepend-inner-icon="ri-mail-line"
                        placeholder="Insira seu email"></v-text-field>
                </label>

            </div>
            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Senha: <span class="text-red-500">*</span>
                    </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">

                    <v-text-field type="password" v-model="form.password" variant="outlined"
                        prepend-inner-icon="ri-shield-keyhole-line" placeholder="Crie uma senha"></v-text-field>
                </label>

            </div>

            <div class="flex flex-col gap-2">
                <div>
                    <span class="label-text font-black">Confirmar senha: <span class="text-red-500">*</span> </span>
                </div>
                <label class="input input-bordered flex items-center gap-2">

                    <v-text-field type="password" v-model="form.password_confirmation" variant="outlined"
                        prepend-inner-icon="ri-shield-keyhole-line" placeholder="Confirme a senha"></v-text-field>
                </label>

            </div>
            <div class="flex justify-center mb-20">
                <v-btn @click="submit">Criar Conta</v-btn>
            </div>

            <v-divider class="border-opacity-100 " :thickness="3" color="primary">Já tem uma conta?</v-divider>
            <div class="flex flex-col gap-4">
                <div class="text-center">
                    <Link as="button" type="submit" href="/login"
                        class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                    Faça login!
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
                <p class="text-center font-black">
                    {{ snackText }}
                </p>
            </v-snackbar>
</template>
