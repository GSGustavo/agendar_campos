<script>
import DashLayout from '../../../../Shared/Admin/DashLayout.vue';
import BreadcrumbDefault from '@/Components/Breadcrumbs/BreadcrumbDefault.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import VueDatePicker from '@vuepic/vue-datepicker';



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

            editedItem: {
                id: null,
                user_id: '',
                campo_id: '',
                start_on: '',
                end_on: '',

            },
            defaultItem: {
                id: null,
                user_id: '',
                campo_id: '',
                start_on: '',
                end_on: '',
            },
            headers: [
                { title: 'ID', key: 'id' },
                { title: 'Usuário', key: 'user' },
                { title: 'Campo', key: 'campo' },
                { title: 'Início', key: 'start_on' },
                { title: 'Término', key: 'end_on' },
                { title: 'Situação', key: 'status' },
                { title: 'Atualizado Em', key: 'updated_at' },
                { title: 'Criado Em', key: 'created_at' },
                { title: 'Actions', key: 'actions', sortable: false },

            ],
            users: [],
            agendamentos: [],
            campos: [],
        }
    },
    computed: {


        formTitle() {
            return this.editedIndex === -1 ? 'Novo Agendamento' : 'Editar Agendamento'
        },


    },
    components: { VueDatePicker, BreadcrumbDefault  },

    methods: {

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

            axios.post(usePage().props.routegetagendamentos, {

            }).then((response) => {
                if (response.status === 200) {
                    this.agendamentos = response.data.agendamentos

                    this.loading = false
                } else {
                    console.log("erro")
                }
            })

            axios.post(usePage().props.routegetusers, {

            }).then((response) => {
                if (response.status === 200) {
                    this.users = response.data

                    this.loading = false
                } else {
                    console.log("erro")
                }
            })
        },
        editItem(item) {
            this.editedIndex = this.agendamentos.indexOf(item)
            this.editedItem = Object.assign({}, item)


            this.dialog = true
        },

        deleteItem(status, id) {
            this.statusTitle = status === 0 ? 'Você quer realmente inativar este agendamento?' : 'Deseja ativar este agendamento?'

            this.statusData = {
                operation: 0,
                id: id,
                status: status
            }

            this.dialogDelete = true
        },

        deleteItemConfirm() {

            axios.post(usePage().props.routeapioperationsagendamentos, this.statusData)
                .then((response) => {
                    if (response.status === 200) {
                        this.onClick()
                    } else {
                        console.log("erro")
                    }
                })

            this.closeDelete()
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

            if (this.editedItem.user_id !== '' && this.editedItem.campo_id !== '' && this.editedItem.start_on !== '' && this.editedItem.end_on !== '') {

                // 06/12/2024 20:06:00

                const start_on_before = this.editedItem.start_on
                const splitedStartOn = start_on_before.split(' ')
                const dateStartOn = splitedStartOn[0].split("/")
                const timeStartOn = splitedStartOn[1]

                const start_on = `${dateStartOn[2]}-${dateStartOn[1]}-${dateStartOn[0]} ${timeStartOn}`


                const end_on_before = this.editedItem.end_on
                const splitedEndOn = end_on_before.split(' ')
                const dateEndOn = splitedEndOn[0].split("/")
                const timeEndOn = splitedEndOn[1]

                const end_on = `${dateEndOn[2]}-${dateEndOn[1]}-${dateEndOn[0]} ${timeEndOn}`

                axios.post(usePage().props.routeapioperationsagendamentos, {
                    operation: 1,
                    id: this.editedItem.id,
                    user_id: this.editedItem.user_id,
                    campo_id: this.editedItem.campo_id,
                    start_on: start_on,
                    end_on: end_on
                })
                    .then((response) => {
                        if (response.status === 200) {
                            this.onClick()
                            this.showSnackBar("green", 'Agendamento salvo com sucesso!')
                            this.close()
                        } else {
                            this.showSnackBar("red", 'Houve um erro!')
                        }
                    })
            
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
    <!-- Auth/Dashboard/Agendamentos/Index -->
    <BreadcrumbDefault pageTitle="Agendamentos" />
    <div class="flex flex-col gap-10">

        <div>
            <v-btn :disabled="loading" append-icon="ri-refresh-line" text="Recarregar" @click="onClick"></v-btn>
        </div>



        <v-text-field v-model="search" label="Pesquisar" prepend-inner-icon="ri-search-line" variant="outlined"
            hide-details single-line></v-text-field>


        <v-data-table :search="search" :headers="headers" :items="agendamentos" :loading="loading">
            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10"></v-skeleton-loader>
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

                    <v-dialog v-model="dialog" max-width="800">
                        <template v-slot:activator="{ props }">
                            <v-btn-info v-bind="props">
                                Novo Agendamento
                            </v-btn-info>
                        </template>

                        <template v-slot:default="{ isActive }">
                            <v-card title="Editar">

                                <v-card-text>

                                    <v-row>
                                        <v-col>

                                            <div class="flex justify-center items-center">
                                                <div class="flex justify-center items-center">
                                                    <div class="w-[300px] flex flex-col mx-auto">
                                                        <p class="my-2 font-black">
                                                            Campo:
                                                        </p>
                                                        <label class="form-control w-full max-w-xs">
                                                            <v-select :thickness="3"
                                                                v-model="editedItem.campo_id" :items="campos"
                                                                 item-title="nome" item-value="id"
                                                                variant="outlined"></v-select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-col>
                                        <v-col>

                                            <div class="flex justify-center items-center">
                                                <div class="flex justify-center items-center">
                                                    <div class="w-[300px] flex flex-col mx-auto">
                                                        <p class="my-2 font-black">
                                                            Usuário:
                                                        </p>
                                                        <label class="form-control w-full max-w-xs">
                                                            <v-select :thickness="3"
                                                                v-model="editedItem.user_id" :items="users"
                                                                 item-title="full_name" item-value="id"
                                                                variant="outlined"></v-select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <div class="flex justify-center items-center">
                                                <div class="flex justify-center items-center">
                                                    <div class="w-[300px] flex flex-col mx-auto">
                                                        <div>
                                                            <span class="label-text font-black">Início: <span
                                                                    class="text-red-500">*</span> </span>
                                                        </div>
                                                        <label class="input input-bordered flex items-center gap-2">

                                                            <v-text-field v-model="editedItem.start_on" variant="outlined"
                                                                placeholder="Ex.: João"></v-text-field>
                                                
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-col>
                                        <v-col>
                                            <div class="flex justify-center items-center">
                                                <div class="flex justify-center items-center">
                                                    <div class="w-[300px] flex flex-col mx-auto">
                                                        <div>
                                                            <span class="label-text font-black">Término: <span
                                                                    class="text-red-500">*</span> </span>
                                                        </div>
                                                        <label class="input input-bordered flex items-center gap-2">

                                                            <v-text-field v-model="editedItem.end_on" variant="outlined"
                                                                placeholder="Ex.: João"></v-text-field>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn-error class="m-4" text="Fechar"
                                        @click="isActive.value = false"></v-btn-error>
                                    <v-btn color="blue-darken-1" variant="text"
                                        @click="save">Salvar</v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
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