<template>
    <div class="flex justify-center">
        <div class="flex flex-col w-[350px] xl:w-[500px] ">
            <div>

            </div>
            <div class="mb-5">
                <div class="text-center p-5">
                    <h3 class="h3 text-2xl font-black">
                        Fazer Login
                    </h3>
                </div>
            </div>
            <div class="">
                <div class="">

                    <div class="mb-3 flex flex-col gap-2">
                        <label for="email" class="">
                            Email: <span class="text-red-500">*</span>
                        </label>

                        <input type="text" class="focus:border-b-5 border-2 p-2 focus:border-primary border-black transition-all duration-150 rounded-[10px]"
                            id="email" placeholder="Ex: joaosilva@gmail.com">
                        </input>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <div class="mb-3 flex flex-col">
                        <label for="password" class="">Senha: <span
                                class="text-danger ">*</span></label>

                                <input type="text" class="focus:border-b-5 border-2 p-2 focus:border-primary border-black transition-all duration-150 rounded-[10px]"
                                id="password" placeholder="Ex: joaosilva@gmail.com">
                            </input>

                    </div>
                </div>
            </div>
            <div class="my-5">
                <div class="text-center">
                    
                    <button class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-transparent hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                        Entrar
                    </button>
                </div>
            </div>
            <div class="my-5">
                <p class="text-center">
                    Ou se deseja apenas ver a disponibilidade sem
                    entrar em sua conta, clique no botão abaixo.
                </p>
            </div>
            <div class="my-5">
                <div class=" text-center">
                    <button class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-green  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                        <i class="ri-calendar-line"></i>
                          Disponibilidade
                    </button>
              
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props: {
        'user': String
    },
    setup(props) {
        console.log(props.user)
    },

}
</script>