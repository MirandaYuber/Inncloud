<div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form @submit.prevent="updateProduct()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModal">Editar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="updateProductName">Nombre: *</label>
                            <input type="text" id="updateProductName" class="form-control" placeholder="Ingrese el nombre" required
                                   v-model="modifyProduct.name" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="updateProductStock">Cantidad: *</label>
                            <input type="number" min="0" id="updateProductStock" class="form-control" placeholder="Ingrese la cantidad" required
                                   v-model="modifyProduct.stock">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="updateProductButton" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
