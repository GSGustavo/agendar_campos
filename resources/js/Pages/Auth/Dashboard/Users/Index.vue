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
            editedItem: {
                id: '',
                name: '',
                lastname: '',
                email: '',
                is_admin: false,
            },
            defaultItem: {
                id: '',
                name: '',
                lastname: '',
                email: '',
                is_admin: false,
            },
            headers: [
                { title: 'ID', key: 'id' },
                { title: 'Nome', key: 'name' },
                { title: 'Sobrenome', key: 'lastname' },
                { title: 'Email', key: 'email' },
                { title: 'Admin', key: 'is_admin' },
                { title: 'Situação', key: 'status' },
                { title: 'Atualizado Em', key: 'updated_at' },
                { title: 'Criado Em', key: 'created_at' },
                { title: 'Actions', key: 'actions', sortable: false },

            ],
            users: []
        }
    },
    computed: {

        // Você quer realmente inativar este usuário?
        formTitle() {
            return this.editedIndex === -1 ? 'Novo Usuário' : 'Editar Usuário'
        },

        // statusTitle() {
        //     return this.statusIndex === 1 ? 'Você quer realmente inativar este usuário?' : 'Deseja ativar este usuário?' 
        // }
    },
    components: { BreadcrumbDefault },
    methods: {
        showSnackBar(color, msg) {
            this.snackbar = true
            this.snackColor = color
            this.snackText = msg
        },
        onClick() {
            this.loading = true

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
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)

            this.editedItem.is_admin = item.is_admin === 1

            this.dialog = true
        },

        deleteItem(status, id) {
            this.statusTitle = status === 0 ? 'Você quer realmente inativar este usuário?' : 'Deseja ativar este usuário?'

            this.statusData = {
                operation: 0,
                id: id,
                status: status
            }

            this.dialogDelete = true
        },

        deleteItemConfirm() {

            axios.post(usePage().props.routeapioperationsusers, this.statusData)
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
            if (this.editedIndex > -1) {
                Object.assign(this.users[this.editedIndex], this.editedItem)

                axios.post(usePage().props.routeapioperationsusers, {
                    operation: 1,
                    id: this.editedItem.id,
                    name: this.editedItem.name,
                    lastname: this.editedItem.lastname,
                    email: this.editedItem.email,
                    is_admin: this.editedItem.is_admin ? 1 : 0
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.onClick()
                    } else {
                        console.log("erro")
                    }
                })


            } else {
                this.users.push(this.editedItem)
            }
            this.close()
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
    <BreadcrumbDefault pageTitle="Usuários" />
    <div class="flex flex-col gap-10">

        <div>
            <v-btn :disabled="loading" append-icon="ri-refresh-line" text="Recarregar" @click="onClick"></v-btn>
        </div>
        


        <v-text-field v-model="search" label="Pesquisar" prepend-inner-icon="ri-search-line" variant="outlined"
            hide-details single-line></v-text-field>


        <v-data-table :search="search" :headers="headers" :items="users" :loading="loading">
            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10"></v-skeleton-loader>
            </template>

            <template v-slot:item.is_admin="{ item }">
                <v-chip color="green" v-if="item.is_admin === 1" class="">
                    Sim
                </v-chip>
                <v-chip v-else color="red">
                    Não
                </v-chip>

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

                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ props }">
                            <v-btn-info v-bind="props">
                                Novo Usuário
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

                                                <v-text-field v-model="editedItem.name" variant="outlined"
                                                    placeholder="Ex.: João"></v-text-field>
                                            </label>

                                        </div>

                                        <div class="flex flex-col gap-2">
                                            <div>
                                                <span class="label-text font-black">Sobrenome: <span
                                                        class="text-red-500">*</span> </span>
                                            </div>
                                            <label class="input input-bordered flex items-center gap-2">


                                                <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                                                <v-text-field v-model="editedItem.lastname" variant="outlined"
                                                    placeholder="Ex.: da Silva"></v-text-field>
                                            </label>

                                        </div>

                                        <div class="flex flex-col gap-2">
                                            <div>
                                                <span class="label-text font-black">Email: <span
                                                        class="text-red-500">*</span> </span>
                                            </div>
                                            <label class="input input-bordered flex items-center gap-2">


                                                <!-- <input type="text" class="grow" placeholder="Ex.: João" /> -->

                                                <v-text-field v-model="editedItem.email" variant="outlined"
                                                    prepend-inner-icon="ri-mail-line"
                                                    placeholder="Insira seu melhor email"></v-text-field>
                                            </label>

                                        </div>

                                        
                            

                                        <div class="flex flex-col gap-2">
                                            <v-switch v-model="editedItem.is_admin"  label="Administrador"></v-switch>
                                        </div>
                                    
                                
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
                </v-toolbar>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-icon class="me-2" size="small" @click="editItem(item)">
                    ri-pencil-line
                </v-icon>
                <v-icon v-if="item.status === 1" size="small" @click="deleteItem(0, item.id)">
                    ri-delete-bin-line
                </v-icon>
                <v-icon v-else size="small" @click="deleteItem(1, item.id)">
                    ri-check-line
                </v-icon>
            </template>
        </v-data-table>

    </div>
</template>