<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form @submit.prevent="createProduct()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Crear Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="createProductName">Nombre: *</label>
                            <input type="text" id="createProductName" class="form-control" placeholder="Ingrese el nombre" required
                                   v-model="newProduct.name" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="createProductStock">Cantidad: *</label>
                            <input type="number" min="1" id="createProductStock" class="form-control" placeholder="Ingrese la cantidad" required
                                   v-model="newProduct.stock">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="createProductButton" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
