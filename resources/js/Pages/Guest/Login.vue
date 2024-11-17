<script>

</script>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

let form = useForm({
    email: '',
    password: ''
})

let submit = () => {
    form.post('/login')
}
</script>



<template>
    <div class="flex justify-center">
        <div class="flex flex-col w-[350px] xl:w-[500px] gap-4">
            <div>

            </div>
            <div class="">
                <div class="text-center p-5">
                    <h3 class="h3 text-2xl font-black">
                        Fazer Login
                    </h3>
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="">
                    <div class="">
                        <div class="mb-3 flex flex-col gap-2">

                            <div class="label">
                                <span class="label-text font-black">Email: <span class="text-red-500">*</span> </span>
                            </div>
                            <label class="input input-bordered flex items-center gap-2">

                                <input type="text" v-model="form.email" class="grow" id="email" name="email"
                                    placeholder="Ex.: joaosilva@gmail.com" />
                            </label>


                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="mb-3 flex flex-col">
                            <div class="label">
                                <span class="label-text font-black">Senha: <span class="text-red-500">*</span> </span>
                            </div>
                            <label class="input input-bordered flex items-center gap-2">

                                <input type="password" v-model="form.password" class="grow"  id="password" name="password"
                                    placeholder="Sua senha" />
                            </label>

                           
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="text-center">
                        <button :disabled="form.processing"
                            class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-primary font-black border-2 hover:border-black transition-all duration-100">
                            Entrar
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex w-full flex-col border-opacity-50">

                <div class="divider">Ou</div>

            </div>

            <div class="flex flex-col gap-4">
                <div class="text-center">

                    <Link as="button" href="/register"
                        class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                    Crie sua conta
                    </Link>
                </div>
            </div>

            <div class="">
                <p class="text-center">
                    Deseja apenas ver as disponibilidades? Clique no botão abaixo.
                </p>
            </div>
            <div class="">
                <div class=" text-center">
                    <button
                        class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-green  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                        <i class="ri-calendar-line"></i>
                        Disponibilidade
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>
