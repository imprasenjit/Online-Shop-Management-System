<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Proforma Invoice List</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
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
                                        "data": "proforma_invoice_ref"
                                    },
                                    {
                                        "data": "customer"
                                    },
                                    {
                                        "data": "purchase_order_id"
                                    },
                                    {
                                        "data": "created_at"
                                    },
                                    {
                                        "data": "status",
                                        width: 200
                                    }
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/proforma_invoice/get_dtrecords") ?>",
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
                                <th>Proforma Invoice Ref</th>
                                <th>Customer</th>
                                <th>Purchase Order</th>
                                <th>Proforma Invoice Date</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="upload_invoice_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Upload Invoice</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="invoice_form">
                <input type="file" name="proforma_invoice" id="proforma_invoice" data-error="Please upload Invoice." />
                <input type="hidden" name="proforma_invoice_id" id="proforma_invoice_id" value="">
            </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="btn btn-primary btn-sm" id="save_invoice">Save</a>
                <a href="#!" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.upload-invoice', function() {
            var id = parseInt($(this).attr("data-id"));
            $('#proforma_invoice_id').val(id);
            $('#upload_invoice_modal').modal("show");
        });
        $("#proforma_invoice").pekeUpload({
            bootstrap: true,
            btnText: "Upload Invoice",
            url: "<?= base_url(); ?>upload/",
            data: {
                file: "proforma_invoice"
            },
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
        $(document).on("click", "#save_invoice", function() {
            var element = $(this);
            $(this).empty().append("Processing...");
            $("#info_panel").fadeIn();
            var data=$('#invoice_form').serializeArray();
            $.ajax({
                url: "<?= base_url("admin/proforma_invoice/upload_proforma_invoice/") ?>",
                method: "POST",
                data:data,
                dataType: "json",
                success: function(jsn) {
                    $("#info_panel").hide();
                    if (jsn.x == 1) {
                        $('#upload_invoice_modal').modal("hide");
                        element.empty().append('Save');
                        $.notify({
                            message: 'Invoice Uploaded Successfully'
                        }, {
                            // settings
                            type: 'success',
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