@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <div id="app">
        <div class="card card-secondary">
            <div class="card-header d-flex">
                <h3 class="card-title">
                    <i class="fas fa-search"></i> Buscar clientes
                </h3>
                <a href="{{route('Clients.Index')}}" class=" align-self-center ml-auto">
                    <i class="fas fa-retweet"></i> Actualizar
                </a>
            </div>
            <div class="card-body">
                <form @submit.prevent="searchClients()">
                    <div class="row d-flex">
                        <div class="col-sm-3">
                            <select aria-label="" class="form-control custom-select rounded-0" id="typeFilter" v-model="typeFilter">
                                <option value="name" selected>Nombre</option>
                                <option value="email">Correo</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <input id="dataClient" class="form-control" :type="typeFilter === 'name' ? 'text' : 'email'"
                                   v-model="dataClient" required
                            >
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" id="searchButton" class="btn btn-primary" style="float: right">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-secondary">
            <div class="card-header d-flex">
                <h3 class="card-title align-self-center mr-auto">
                    <i class="fa fa-list-ul"></i> Listado de clientes
                </h3>
                <button type="button" id="openCreateClientButton" class="btn btn-success"
                        @click="openCreateClientModal()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Crear cliente
                </button>
            </div>
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-sm-12">
                        <table id="ClientsTable" class="table table-bordered table-striped dtr-inline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in clients">
                                    <td>@{{ client.id }}</td>
                                    <td>@{{ client.name }}</td>
                                    <td>@{{ client.email }}</td>
                                    <td>
                                        <a class="btn btn-sm" title="Editar cliente" @click="openUpdateClientModal(client)">
                                            <i class="fa fa-edit mr-1"></i>Editar
                                        </a>
                                        <a class="btn btn-sm" title="Eliminar cliente" @click="openDeleteClientModal(client.id)">
                                            <i class="fa fa-times-circle mr-1"></i>Eliminar
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('clients.modals.create')
        @include('clients.modals.update')
        @include('clients.modals.delete')

    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    typeFilter: 'name',
                    dataClient: '',
                    clients: @json($clients),
                    products: @json($products),
                    newClient: {
                        name: '',
                        email: '',
                        products: []
                    },
                    modifyClient: {
                        name: '',
                        email: '',
                        products: []
                    },
                    clientIdToDelete: ''
                }
            },
            methods: {
                searchClients() {
                    $('#searchButton').loading()

                    fetch('{{ route('Clients.getClientsByFilter') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            'typeFilter': this.typeFilter,
                            'dataClient': this.dataClient
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            $('#searchButton').unloading()
                            if (response.success) {
                                this.clients = response.clients
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                title: 'Error!',
                                text: err,
                                icon: "error"
                            });
                            $('#searchButton').unloading()
                        })
                },
                openCreateClientModal() {
                    this.newClient = {
                        name: '',
                            email: '',
                            products: []
                    }
                    $('#createClientProducts').val(null).trigger('change')
                    $('#createClientModal').modal('show')
                },
                createClient() {
                    $('#createButton').loading()
                    fetch('{{ route('Clients.CreateClient') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            'name': this.newClient.name,
                            'email': this.newClient.email,
                            'products': this.newClient.products
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if (response.success) {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 3000)
                            } else {
                                ResponseUtility.processFailFetchRequest(response)
                                $('#searchButton').unloading()
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                title: 'Error!',
                                text: err,
                                icon: "error"
                            });
                            $('#searchButton').unloading()
                        })
                },
                openUpdateClientModal(client) {
                    fetch('{{ route('Products.GetProductsIdByClientId') }}', {
                        headers: {
                            'Accept' : 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            'clientId' : client.id
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if (response.success) {
                                this.modifyClient = {
                                    id: client.id,
                                    name: client.name,
                                    email: client.email,
                                }
                                $('#updateClientProducts').val(response.productsId).trigger('change')
                                $('#updateClientModal').modal('show')
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                title: 'Error!',
                                text: err,
                                icon: "error"
                            });
                        })
                },
                updateClient() {
                    $('#updateButton').loading()
                    fetch('{{ route('Clients.UpdateClient') }}', {
                        headers: {
                            'Accept' : 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            'id': this.modifyClient.id,
                            'name': this.modifyClient.name,
                            'email': this.modifyClient.email,
                            'products': this.modifyClient.products
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if(response.success) {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 3000)
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                title: 'Error!',
                                text: err,
                                icon: "error"
                            });
                            $('#updateButton').unloading()
                        })
                },
                openDeleteClientModal(clientId) {
                    this.clientIdToDelete = clientId
                    $('#deleteClientModal').modal('show')
                },
                deleteClient() {
                    $('#deleteButton').loading()
                    fetch('{{ route('Clients.DeleteClient') }}', {
                        headers: {
                            'Accept' : 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            'idClient': this.clientIdToDelete,
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if(response.success) {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 3000)
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                title: 'Error!',
                                text: err,
                                icon: "error"
                            });
                            $('#deleteButton').unloading()
                        })
                },
                initClientsTable() {
                    $('#ClientsTable').dataTable({
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
                        },
                        ordering: false,
                        searching: false
                    })
                },
                initSelect2() {
                    $('#createClientProducts').select2({
                        theme: 'bootstrap4'
                    }).change(function () {
                        app.newClient.products = $(this).val()
                    })

                    $('#updateClientProducts').select2({
                        theme: 'bootstrap4'
                    }).change(function () {
                        app.modifyClient.products = $(this).val()
                    })
                }
            },
            mounted() {
                this.initClientsTable()
                this.initSelect2()
            }
        }).mount('#app')

        $(document).ready(function () {
        })
    </script>
@stop
