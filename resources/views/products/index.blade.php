@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <div id="app">
        <div class="card card-secondary">
            <div class="card-header d-flex">
                <h3 class="card-title">
                    <i class="fas fa-search"></i> Buscar productos
                </h3>
                <a href="{{route('Products.Index')}}" class=" align-self-center ml-auto">
                    <i class="fas fa-retweet"></i> Actualizar
                </a>
            </div>
            <div class="card-body">
                <form @submit.prevent="searchProduct()">
                    <div class="row d-flex">
                        <div class="col-sm-11">
                            <input id="productName" class="form-control" type="text" placeholder="Ingrese el nombre del producto"
                                   v-model="productName" required
                            >
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" id="searchProductButton" class="btn btn-primary" style="float: right">
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
                    <i class="fa fa-list-ul"></i> Listado de productos
                </h3>
                <button type="button" id="openCreateProductButton" class="btn btn-success" @click="openCreateProductModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Crear producto
                </button>
            </div>
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-sm-12">
                        <table id="ProductsTable" class="table table-bordered table-striped dtr-inline">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad disponible</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products">
                                <td> @{{ product.id }} </td>
                                <td> @{{ product.name }} </td>
                                <td> @{{ product.stock }} </td>
                                <td>
                                    <a class="btn btn-sm" title="Editar producto" @click="openUpdateProductModal(product)">
                                        <i class="fa fa-edit mr-1"></i>Editar
                                    </a>
                                    <a class="btn btn-sm" title="Eliminar producto" @click="openDeleteProductModal(product.id)">
                                        <i class="fa fa-times-circle mr-1"></i>Editar
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('products.modals.create')
        @include('products.modals.update')
        @include('products.modals.delete')
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        Vue.createApp({
            data() {
                return {
                    productName: '',
                    products: @json($products),
                    newProduct : {
                        name: '',
                        stock: ''
                    },
                    modifyProduct : {
                        id: '',
                        name: '',
                        stock: ''
                    },
                    productIdToDelete: ''
                }
            },
            methods: {
                searchProduct() {
                    $('#searchProductButton').loading()
                    fetch('{{ route('Products.GetProductsByName') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            name: this.productName
                        })
                    })
                        .then((res) => res.json())
                        .then((response) => {
                            $('#searchProductButton').unloading()
                            if(response.success) {
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
                            ResponseUtility.processFailFetchRequest(response)
                            $('#searchProductButton').unloading()
                        })
                },
                openCreateProductModal() {
                    this.newProduct = {
                        name: '',
                        stock: ''
                    }
                    $('#createProductModal').modal('show')
                },
                createProduct() {
                    $('#createProductButton').loading()
                    fetch('{{ route('Products.CreateProduct') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            name: this.newProduct.name,
                            stock: this.newProduct.stock,
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
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                                $('#createProductButton').unloading()
                            }
                        })
                        .catch((err) => {
                            ResponseUtility.processFailFetchRequest(response)
                            $('#createProductButton').unloading()
                        })
                },
                openUpdateProductModal(product) {
                    this.modifyProduct = {
                        id: product.id,
                        name: product.name,
                        stock: product.stock
                    }
                    $('#updateProductModal').modal()
                },
                updateProduct() {
                    $('#updateProductButton').loading()
                    fetch('{{ route('Products.UpdateProduct') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            productId: this.modifyProduct.id,
                            name: this.modifyProduct.name,
                            stock: this.modifyProduct.stock,
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
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                                $('#updateProductButton').unloading()
                            }
                        })
                        .catch((err) => {
                            ResponseUtility.processFailFetchRequest(response)
                            $('#updateProductButton').unloading()
                        })
                },
                openDeleteProductModal(productId) {
                    this.productIdToDelete = productId
                    $('#deleteProductModal').modal('show')
                },
                deleteProduct() {
                    $('#updateProductButton').loading()
                    fetch('{{ route('Products.DeleteProduct') }}', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify({
                            productId: this.productIdToDelete,
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
                                })
                            } else {
                                Swal.fire({
                                    title: response.message,
                                    text: "",
                                    icon: "error"
                                });
                                $('#updateProductButton').unloading()
                            }
                        })
                        .catch((err) => {
                            ResponseUtility.processFailFetchRequest(response)
                            $('#updateProductButton').unloading()
                        })
                },
                initClientsTable() {
                    $('#ProductsTable').dataTable({
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

        })
    </script>
@stop
