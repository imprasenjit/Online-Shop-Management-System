<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Order To Supplier</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
                    <link href="<?= base_url('public/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
                    <script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
                    <script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $.extend($.fn.DataTable.ext.classes, {
                                sWrapper: "dataTables_wrapper dt-bootstrap4",
                            });
                            $("#dtbl").DataTable({
                                "columnDefs": [{
                                    className: 'text-right',
                                    orderable: false,
                                    targets: 5
                                }],
                                "columns": [{
                                        "data": "sl_no"
                                    },
                                    {
                                        "data": "customer_id"
                                    },
                                    {
                                        "data": "purchase_order_from_customer_id"
                                    },
                                    {
                                        "data": "supplier_id"
                                    },
                                    {
                                        "data": "invoice_status"
                                    },
                                    {
                                        "data": "purchase_order_supplier_id",
                                        width: 200
                                    }
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/purchase_orders/get_supdtrecords") ?>",
                                    "dataType": "json",
                                    "type": "POST",
                                },
                                language: {
                                    processing: "<div class='loading'></div>",
                                },
                                "order": [
                                    [0, 'DESC']
                                ],
                                "lengthMenu": [
                                    [20, 30, 50, 100, 200],
                                    [20, 30, 50, 100, 200]
                                ]
                            });
                        });
                    </script>
                    <table class="table table-bordered" id="dtbl">
                        <thead>
                            <tr>
                                <th>(#)</th>
                                <th>Customer</th>
                                <th>Customer Purchase order id</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", ".send_to_warehouse", function() {
            var element = $(this);
            var po_id = $(this).attr("data-po-id");
            $(this).empty().append("Processing...");
            $.ajax({
                url: "<?= base_url("admin/warehouse/send_to_warehouse/") ?>",
                method: "POST",
                data: {
                    po_to_supplier_id: po_id
                },
                dataType: "json",
                success: function(jsn) {
                    if (jsn.x == 1) {
                        element.removeClass("btn-warning").addClass("btn-success");
                        element.empty().append('<i class="glyphicon glyphicon-ok"></i>&nbsp;Sent');
                        $.notify({
                            message: 'PO Forwarded to Warehouse'
                        }, {
                            // settings
                            type: 'info',
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                            offset: {
                                x: 20,
                                y: 100
                            }
                        });
                    } else {
                        element.empty().append('<i class="glyphicon glyphicon-warning-sign"></i>&nbsp;Error');
                    }
                }
            });
        });
    });
</script>