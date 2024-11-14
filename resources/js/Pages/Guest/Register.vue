<script>



</script>

<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { Link } from '@inertiajs/vue3'

    let form = useForm({
        name: '',
        email: '',
        lastname: '',
        password: '',
        password_confirmation: ''
    })

    let submit = () => {
        form.post('/register')
    }
</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex flex-col gap-10 p-10 justify-center items-center">
            <p class="text-center font-black text-2xl">
                Criar uma Conta
            </p>
            <div class="flex flex-col gap-4 w-full max-w-xl ">
               
                <label class="form-control ">
                    <div class="label">
                        <span class="label-text font-black">Nome: <span class="text-red-500">*</span> </span>
                    </div>
                    <input v-model="form.name" id="name" name="name" type="text" placeholder="Ex.: João" class="input input-bordered w-full" />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-black">Sobrenome: <span class="text-red-500">*</span> </span>
                    </div>
                    <input v-model="form.lastname" id="lastname" name="lastname" type="text" placeholder="Ex.: da Silva" class="input input-bordered w-full" />
                </label>
                <div>
                    <div class="label">
                        <span class="label-text font-black">Email: <span class="text-red-500">*</span> </span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path
                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                            <path
                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                        </svg>
                        <input v-model="form.email" id="email" name="email" type="text" class="grow" placeholder="Ex.: joaosilva@gmail.com" />
                    </label>
                </div>
                <div>
                    <div class="label">
                        <span  class="label-text font-black">Senha: <span class="text-red-500">*</span> </span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input v-model="form.password" id="password" name="password" type="password" class="grow" placeholder="Senha" />
                    </label>
                </div>
                <div>
                    <div class="label">
                        <span class="label-text font-black">Confirmar Senha: <span class="text-red-500">*</span> </span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" class="grow" placeholder="Senha" />
                    </label>
                </div>
                <div class="flex justify-center">
                    <button :disabled="form.processing" class="btn btn-active btn-neutral text-white">Criar Conta</button>
                </div>
                <div class="flex w-full flex-col border-opacity-50">
                    <div class="divider">Ou</div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="text-center">
                        <Link as="button" type="submit" href="/login"
                            class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                        Ja tenho uma conta
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>


