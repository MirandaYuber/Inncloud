<div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form @submit.prevent="createOrder()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOrderModalLabel">Crear orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="createOrderClientId">Cliente: *</label>
                            <select aria-label="" class="form-control custom-select rounded-0" id="createOrderClientId" required>
                                <option value="" selected disabled>Seleccione un cliente</option>
                                <option :value="client.id" v-for="client in clients"> @{{ client.name }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-boxes"></i>
                                        Inventario
                                    </h3>
                                </div>
                                <div class="card-body pad table-responsive">
                                    <ul class="nav nav-pills flex-column mt-2">
                                        <li class="nav-item" v-for="product in products">
                                            <a @click="addProductToOrder(product.id)" class="nav-link product-inventory" title="Agregar producto" style="cursor: cell;">
                                                <span>
                                                    <label><i class="fas fa-inbox"></i> Nombre:</label> @{{ product.name }}
                                                    <br>
                                                    <label><i class="fas fa-list-ol"></i> Cantidad disponible: </label> @{{ product.stock }} </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-shopping-cart"></i>
                                        Productos añadidos
                                    </h3>
                                </div>
                                <div class="card-body pad table-responsive">
                                    <ul class="nav nav-pills flex-column mt-2">
                                        <li class="nav-item" v-for="product in productsSelected">
                                            <a @click="removeProductToOrder(product.id)" class="nav-link product-inventory" title="Remover producto" style="cursor: grab;">
                                                <span>
                                                    <label><i class="fas fa-inbox"></i> Nombre:</label> @{{ product.name }}
                                                    <br>
                                                    <label><i class="fas fa-list-ol"></i> Cantidad disponible: </label> @{{ product.stock }}
                                                    <br>
                                                    <label><i class="fas fa-archive"></i> Cantidad a ordenar: </label>
                                                </span>
                                            </a>
                                            <input type="number" :max="product.stock" min="1" class="form-control" v-model="product.quantity" required>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="createOrderButton" class="btn btn-primary" :disabled="productsSelected.length === 0">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
