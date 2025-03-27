<div class="modal fade" id="deleteClientModal">
    <div class="modal-dialog" role="document">
        <form @submit.prevent="deleteClient()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteClientModal">Eliminar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12 text-center m-0">
                            <h3>¿Desea eliminar el cliente?</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="deleteButton" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
