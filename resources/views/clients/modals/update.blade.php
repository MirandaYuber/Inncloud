<div class="modal fade" id="updateClientModal">
    <div class="modal-dialog" role="document">
        <form @submit.prevent="updateClient()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateClientModal">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="updateClientName">Nombre: *</label>
                            <input type="text" id="updateClientName" class="form-control" placeholder="Ingrese el nombre" required
                                   v-model="modifyClient.name" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="updateClientEmail">Email</label>
                            <input type="email" id="updateClientEmail" class="form-control" placeholder="Ingrese el email" required
                                   v-model="modifyClient.email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="updateClientProducts">Productos:</label>
                            <select name="updateClientProducts" id="updateClientProducts" class="form-control" multiple="multiple" required>
                                <option disabled>Seleccione los productos asociados al cliente:</option>
                                <option :value="product.id" v-for="product in products">
                                    @{{ product.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="updateButton" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
