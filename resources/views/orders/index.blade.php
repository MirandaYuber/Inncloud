@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content_header')
    <h1>Ordenes</h1>
@stop

@section('content')
    <div id="app">
        <div class="card card-secondary">
            <div class="card-header d-flex">
                <h3 class="card-title">
                    <i class="fas fa-search"></i> Buscar ordenes
                </h3>
                <a href="{{route('Orders.Index')}}" class=" align-self-center ml-auto">
                    <i class="fas fa-retweet"></i> Actualizar
                </a>
            </div>
            <div class="card-body">
                <form @submit.prevent="searchOrders()">
                    <div class="row d-flex">
                        <div class="col-sm-11">
                            <select aria-label="" class="form-control custom-select rounded-0" id="clientId" required>
                                <option value="" selected disabled>Seleccione un cliente</option>
                                <option :value="client.id" v-for="client in clients"> @{{ client.name }} </option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" id="searchOrdersButton" class="btn btn-primary" style="float: right">
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
                    <i class="fa fa-list-ul"></i> Listado de ordenes
                </h3>
                <button type="button" id="openCreateOrderButton" class="btn btn-success"
                        @click="openCreateOrderModal()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Crear orden
                </button>
            </div>
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-sm-12">
                        <table id="OrdersTable" class="table table-bordered table-striped dtr-inline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de creación</th>
                                    <th>Cliente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in orders">
                                    <td>@{{ order.id }}</td>
                                    <td>@{{ order.createdAt }}</td>
                                    <td>@{{ order.clientName }}</td>
                                    <td>
                                        <a class="btn btn-sm" title="Editar Orden" @click="openDetailsOrderModal(order.id)">
                                            <i class="fa fa-info-circle mr-1"></i>Ver detalles
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('orders.modals.create')
        @include('orders.modals.details')
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    orders: @json($orders),
                    clients: @json($clients),
                    products: [],
                    productsSelected: [],
                    orderDetail: []
                }
            },
            methods: {
                searchOrders() {
                    $('#searchOrdersButton').loading()
                    fetch('{{ route('Orders.GetOrdersByClientId') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            clientId: $('#clientId').val()
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            $('#searchOrdersButton').unloading()
                            if (response.success) {
                                this.orders = response.orders
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
                            $('#searchOrdersButton').unloading()
                        })
                },
                openCreateOrderModal() {
                    $('#createOrderClientId').val('')
                    this.products = []
                    this.productsSelected = []
                    $('#createOrderModal').modal('show')
                },
                getProductsByClientId(clientId) {
                    fetch('{{ route('Products.GetProductsByClientId') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            clientId: clientId
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if (response.success) {
                                this.products = response.products
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
                addProductToOrder(productId) {
                    let index = this.products.findIndex(obj => obj.id === productId)
                    let [product] = this.products.splice(index, 1);

                    this.productsSelected.push(product)

                },
                removeProductToOrder(productId) {
                    let index = this.productsSelected.findIndex(obj => obj.id === productId)
                    let [product] = this.productsSelected.splice(index, 1);

                    this.products.push(product)
                },
                createOrder(){
                    $('#createOrderButton').loading()
                    fetch('{{ route('Orders.CreateOrder') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            clientId: $('#createOrderClientId').val(),
                            listProducts: this.productsSelected
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            $('#createOrderButton').unloading()
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
                            $('#createOrderButton').unloading()
                        })
                },
                openDetailsOrderModal(orderId) {
                    fetch('{{ route('Orders.GetOrderDetailByOrderId') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            orderId: orderId
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            if (response.success) {
                                if (response.orderDetail.length === 0) {
                                    Swal.fire({
                                        title: "Esta orden no cuenta con detalles",
                                        text: "",
                                        icon: "error"
                                    });
                                } else {
                                    this.orderDetail = response.orderDetail
                                    $('#orderDetailModal').modal('show')
                                }
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
                            $('#createOrderButton').unloading()
                        })
                },
                initClientsTable() {
                    $('#OrdersTable').dataTable({
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
                        },
                        ordering: false,
                        searching: false
                    })
                },
            },
            mounted() {
                this.initClientsTable()
            }
        }).mount('#app')

        $(document).ready(function () {
            $('#createOrderClientId').change(function () {
                let clientId = $(this).val()
                app.getProductsByClientId(clientId)
            })

        })
    </script>
@stop
