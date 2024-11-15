<script>
import axios from 'axios';

export default {
    data() {
        return {
            teste: '',

        }
    },
    setup() {

        return {

            // Função chamada toda vez que se muda o valor do select do campo
            changeCampo(e) {
                // console.log(e.target.dataset.url)
                axios.post(
                    e.target.dataset.url,
                    {
                        'id': e.target.value
                    }
                ).then((response) => {
                    if (response.status === 200) {
                        if (response.data.status) {
                            document.getElementById("iframe").src = response.data.maps_link
                        }
                    }
                })
            }
        }
    },
    mounted() {
        // Fazendo isso para pegar o valor selecionado no select quand o elemento for montado
        this.changeCampo({
            target: {

                dataset: {
                    url: document.getElementById("campo_id").dataset.url,
                },
                value: document.getElementById("campo_id").value
            }
        })
    },
    components: {},
}
</script>

<template>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Campo:</span>

        </div>
        <select :data-url="$page.props.apigetcampo" v-on:change="changeCampo" id="campo_id"
            class="select select-bordered w-full max-w-xs">

            <option v-for=" campo in $page.props.campos " :value="campo.id" :key="campo.id">
                {{ campo.nome }}
            </option>
        </select>
    </label>

</template>
