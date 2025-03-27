<div class="modal fade" id="createClientModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form @submit.prevent="createClient()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createClientModalLabel">Crear cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="createClientName">Nombre: *</label>
                            <input type="text" id="createClientName" class="form-control" placeholder="Ingrese el nombre" required
                                   v-model="newClient.name" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="createClientEmail">Email</label>
                            <input type="email" id="createClientEmail" class="form-control" placeholder="Ingrese el email" required
                                   v-model="newClient.email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="createClientProducts">Productos:</label>
                            <select name="createClientProducts[]" id="createClientProducts" class="form-control" multiple="multiple" required>
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
                    <button type="submit" id="createButton" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
