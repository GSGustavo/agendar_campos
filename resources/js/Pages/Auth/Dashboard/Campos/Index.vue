<script>
import DashLayout from '../../../../Shared/Admin/DashLayout.vue';
import BreadcrumbDefault from '@/Components/Breadcrumbs/BreadcrumbDefault.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    data() {
        return {
            snackbar: false,
            snackText: null,
            snackColor: null,
            search: '',
            loading: false,
            editedIndex: -1,
            statusTitle: '',
            statusData: {},
            dialog: false,
            dialogDelete: false,
            dialogMaps: false,

            maps_link: "",

            editedItem: {
                id: null,
                name: '',
                maps_link: '',

            },
            defaultItem: {
                id: null,
                name: '',
                maps_link: '',
            },
            headers: [
                { title: 'ID', key: 'id' },
                { title: 'Nome', key: 'nome' },
                { title: 'Maps Link', key: 'maps_link' },
                { title: 'Situação', key: 'status' },
                { title: 'Atualizado Em', key: 'updated_at' },
                { title: 'Criado Em', key: 'created_at' },
                { title: 'Actions', key: 'actions', sortable: false },

            ],
            campos: []
        }
    },
    computed: {

        // Você quer realmente inativar este usuário?
        formTitle() {
            return this.editedIndex === -1 ? 'Novo Campo' : 'Editar Campo'
        },

 
    },
    components: { BreadcrumbDefault },
    methods: {
        openDialogMaps(link) {
            this.maps_link = link
            this.dialogMaps = true
        },
        showSnackBar(color, msg) {
            this.snackbar = true
            this.snackColor = color
            this.snackText = msg
        },
        onClick() {
            this.loading = true

            axios.post(usePage().props.routegetcampos, {

            }).then((response) => {
                if (response.status === 200) {
                    this.campos = response.data.campos

                    this.loading = false
                } else {
                    console.log("erro")
                }
            })
        },
        editItem(item) {
            this.editedIndex = this.campos.indexOf(item)
            this.editedItem = Object.assign({}, item)


            this.dialog = true
        },

        deleteItem(status, id) {
            this.statusTitle = status === 0 ? 'Você quer realmente inativar este campo?' : 'Deseja ativar este campo?'

            this.statusData = {
                operation: 0,
                id: id,
                status: status
            }

            this.dialogDelete = true
        },

        deleteItemConfirm() {

            axios.post(usePage().props.routeapioperationscampos, this.statusData)
                .then((response) => {
                    if (response.status === 200) {
                        this.onClick()
                    } else {
                        console.log("erro")
                    }
                })

            this.closeDelete()
        },

        closeDialogMaps() {
            this.dialogMaps = false
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1

            })
        },

        save() {

            if (this.editedItem.nome !== '' && this.editedItem.maps_link !== '') {
                axios.post(usePage().props.routeapioperationscampos, {
                    operation: 1,
                    id: this.editedItem.id,
                    nome: this.editedItem.nome,
                    maps_link: this.editedItem.maps_link,

                })
                    .then((response) => {
                        if (response.status === 200) {
                            this.onClick()
                        } else {
                            console.log("erro")
                        }
                    })
                    this.close()
            } else {
                this.showSnackBar("red", 'Preencha todos os campos!')
            }
        
        },
    },
    mounted() {
        this.onClick()
    },
    layout: DashLayout,
    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    // routeapioperationsusers
}
</script>


<template>
    <BreadcrumbDefault pageTitle="Campos" />
    <div class="flex flex-col gap-10">

        <div>
            <v-btn :disabled="loading" append-icon="ri-refresh-line" text="Recarregar" @click="onClick"></v-btn>
        </div>



        <v-text-field v-model="search" label="Pesquisar" prepend-inner-icon="ri-search-line" variant="outlined"
            hide-details single-line></v-text-field>


        <v-data-table :search="search" :headers="headers" :items="campos" :loading="loading">
            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10"></v-skeleton-loader>
            </template>



            <template v-slot:item.maps_link="{ item }">

                <v-btn @click="openDialogMaps(item.maps_link)">
                    Maps
                </v-btn>


            </template>

            <template v-slot:item.status="{ item }">
                <v-chip color="green" v-if="item.status === 1" class="">
                    Ativo
                </v-chip>
                <v-chip v-else color="red">
                    Inativo
                </v-chip>

            </template>

            <template v-slot:top>
                <v-toolbar color="transparent">

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="800px">
                        <template v-slot:activator="{ props }">
                            <v-btn-info v-bind="props">
                                Novo Campo
                            </v-btn-info>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>

                                    <div class="flex flex-col gap-4  ">

                                        <div class="flex flex-col gap-2">
                                            <div>
                                                <span class="label-text font-black">Nome: <span
                                                        class="text-red-500">*</span> </span>
                                            </div>
                                            <label class="input input-bordered flex items-center gap-2">


                                                <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                                                <v-text-field v-model="editedItem.nome" variant="outlined"
                                                    placeholder="Ex.: João"></v-text-field>
                                            </label>

                                        </div>

                                        <div class="flex flex-col gap-2">
                                            <div>
                                                <span class="label-text font-black">Maps Link: <span
                                                        class="text-red-500">*</span> </span>
                                            </div>
                                            <label class="input input-bordered flex items-center gap-2">


                                                <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                                                <v-text-field v-model="editedItem.maps_link" variant="outlined"
                                                    placeholder="Ex.: da Silva"></v-text-field>
                                            </label>

                                        </div>

                                        <iframe id="iframe" ref="iframe" :src="editedItem.maps_link" height="350"
                                            loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>



                                    </div>

                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue-darken-1" variant="text" @click="close">
                                    Cancelar
                                </v-btn>
                                <v-btn color="blue-darken-1" variant="text" @click="save">
                                    Salvar
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">{{ statusTitle }}</v-card-title>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancelar</v-btn>
                                <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">Sim</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogMaps" max-width="900px">
                        <v-card>

                            <v-card-text>
                                <div class="flex items-center justify-center">
                                    <iframe id="iframe" ref="iframe" :src="maps_link" height="450" width="800"
                                        loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
                                </div>

                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>

                                <v-btn color="blue-darken-1" variant="text" @click="closeDialogMaps">Fechar</v-btn>

                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>



                </v-toolbar>
            </template>

            <template v-slot:item.actions="{ item }">
                <div class="flex gap-2">
                    <v-icon size="small" @click="editItem(item)">
                        ri-pencil-line
                    </v-icon>
                    <v-icon v-if="item.status === 1" size="small" @click="deleteItem(0, item.id)">
                        ri-delete-bin-line
                    </v-icon>
                    <v-icon v-else size="small" @click="deleteItem(1, item.id)">
                        ri-check-line
                    </v-icon>
                </div>
            </template>
        </v-data-table>

    </div>

    <v-snackbar :timeout="5000" elevation="50" :color="snackColor" v-model="snackbar">
        <p class="text-center font-black">
            {{ snackText }}
        </p>
    </v-snackbar>
</template>