<template>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Campo:</span>

        </div>
        <select  id="campo_id" v-model="changeCampo" class="select select-bordered w-full max-w-xs">
            <option selected value="">Teste</option>
            <option  v-for=" campo in $page.props.campos " :value="campo.id" :key="campo.id">
                {{ campo.nome }}
            </option>
        </select>
    </label>

</template>

<script>
export default {
    data() {
        return {
            teste: '',

        }
    },
    setup() {

    },
    components: {},
    watch: {
        changeCampo() {
            console.log(this.teste)
        }
    }
}
</script>