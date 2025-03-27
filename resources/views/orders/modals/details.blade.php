<div class="modal fade" id="orderDetailModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetail">Detalles de la orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="" class="table table-bordered table-striped dtr-inline">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in orderDetail">
                                <td>@{{ order.productId }}</td>
                                <td>@{{ order.productName }}</td>
                                <td>@{{ order.quantity }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
