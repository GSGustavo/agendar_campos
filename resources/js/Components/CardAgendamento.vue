<script>
export default {
    // data() {
    //     return {

    //     }
    // },
    // 0 inativo / 1 ativo
    props: {
        mode: String,

    },
    setup(props) {
   
        
    },

}
</script>

<template>
    <div class="flex justify-between border-2 rounded-xl p-5">
        <div class="flex flex-col gap-1 text-md">
            <span :class="(mode === '0' ? 'line-through' : '')">Sintético</span>
            <p :class="'font-black ' + (mode === '0' ? 'line-through' : '')">
                14 de Outubro (19:00 - 21:00)
            </p>
        </div>
        <div class="flex gap-2 text-2xl items-center">
            <div :class="'flex justify-center items-center w-10 h-10  rounded-md text-white ' + (mode === '0' ? 'bg-gray' : 'cursor-pointer transition-all duration-150 bg-blue hover:text-blue hover:bg-transparent')">
                <i class="ri-pencil-fill"></i>
            </div>
            <div>
                <i :class="'ri-delete-bin-line ' + (mode === '0' ? 'text-gray' : 'cursor-pointer  text-red-500')"></i>

            </div>
        </div>
    </div>
</template>