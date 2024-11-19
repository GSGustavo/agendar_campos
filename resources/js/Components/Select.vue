<script>
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

export default {
    data() {
        return {
            selected: 1
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
                        'id': this.selected
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
                    url: usePage().props.apigetcampo,
                },
                value: this.selected
            }
        })
    },
    watch: {
        selected() {
            this.changeCampo({
                target: {

                    dataset: {
                        url: usePage().props.apigetcampo,
                    },
                    value: this.selected
                }
            })
        }
    },
    components: {},
}
</script>

<template>
    <label class="form-control w-full max-w-xs">
        <v-select :thickness="3" :data-url="$page.props.apigetcampo" v-model="selected" :items="$page.props.campos" id="campo_id"
            item-title="nome" v-on:change="changeCampo" item-value="id" variant="outlined"></v-select>
    </label>

</template>
