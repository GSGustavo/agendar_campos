<script>
import UserAuthLayout from '../../Shared/User/UserAuthLayout.vue';


export default {
    layout: UserAuthLayout
}
</script>

<script setup>import { Link } from '@inertiajs/vue3';</script>

<template>

        <div class="flex flex-col gap-10 p-10 justify-center items-center">
            <p class="text-center font-black text-2xl">
                Perfil
            </p>
            <div class="flex flex-col gap-4 w-full max-w-xl ">
                <label class="form-control flex">
                    <div class="dropdown mx-auto">
                        <div tabindex="0" role="button" class="btn m-1">
                            Tema
                            <svg width="12px" height="12px" class="inline-block h-2 w-2 fill-current opacity-60"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                                <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                            </svg>
                        </div>
                        <ul tabindex="0" class="dropdown-content bg-base-300 rounded-box z-[1] w-52 p-2 shadow-2xl">
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                                    aria-label="Claro" value="default" />
                            </li>
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                                    aria-label="Escuro" value="retro" />
                            </li>
                          
                        </ul>
                    </div>

                </label>
                <label class="form-control ">
                    <div class="label">
                        <span class="label-text font-black">Nome: <span class="text-red-500">*</span> </span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">


<input type="text" class="grow" placeholder="Ex.: João" />
</label>

                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-black">Sobrenome: <span class="text-red-500">*</span> </span>

                    </div>
                    <label class="input input-bordered flex items-center gap-2">
<input type="text" class="grow" placeholder="Ex.: da Silva" />
</label>

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
                        <input type="text" class="grow" placeholder="Ex.: joaosilva@gmail.com" />
                    </label>
                </div>

                <div>
                    <div class="label">
                        <span class="label-text font-black">Senha: <span class="text-red-500">*</span> </span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="password" class="grow" placeholder="Senha" />
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
                        <input type="password" class="grow" placeholder="Senha" />
                    </label>
                </div>


                <div class="flex justify-center">
                    <button class="btn btn-active btn-neutral text-white">Salvar</button>
                </div>

                <div class="flex justify-center">
                    <Link method="post" href="/logout" as="button" class="btn btn-active btn-error text-white">
                        <i class="ri-logout-box-r-line"></i> Sair
                    </Link>
                </div>

            </div>
        </div>

</template>