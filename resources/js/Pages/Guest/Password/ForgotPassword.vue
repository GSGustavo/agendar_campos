<script>
import { useForm, usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

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
            if (this.form.email !== '') {
                this.form.post(usePage().props.routesendemail, {
                    onSuccess: () => {
                        this.showSnackBar('green', 'Email enviado com sucesso!')

                    },
                    onError: (data) => {
                        const color = 'red'
                        const msg = 'Houve um erro, tente novamente mais tarde!'
                      

                        this.showSnackBar(color, msg)
                    },

                })
            } else {
                this.showSnackBar('red', 'Preencha os campos corretamente!')
            }

        }
    },
    components: { Link }
}
</script>




<template>
    <!-- Guest/Password/ForgotPassword -->
    <div class="flex justify-center p-10">
        <div class="flex flex-col w-[350px] xl:w-[500px] gap-4">
          
            <div class="">
                <div class="text-center p-5">
                    <h3 class="h3 text-2xl font-black">
                        Enviar email de redefinição de senha
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

      
            <div class="">
                <div class="text-center">

                    <v-btn @click="submit">Enviar</v-btn>
                </div>
            </div>

    


            <div class="flex w-full flex-col border-opacity-50">

                <v-divider class="border-opacity-100" :thickness="3" color="primary">Ou</v-divider>

            </div>

            <div class="flex flex-col gap-4">
                <div class="text-center">

                    <Link as="button" href="/login"
                        class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                    Voltar
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
