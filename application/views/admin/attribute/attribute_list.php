<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Attribute List</h6>
                    <div class="dropdown no-arrow">
                        <a class="btn btn-sm btn-outline-primary" href="<?= base_url("admin/attribute/create") ?>" role="button">
                            <i class="fas fa-plus fa-sm fa-fw"></i> Add Attribute
                        </a>
                        <a class="btn btn-sm btn-outline-warning" href="<?= base_url("admin/attribute/sort") ?>" role="button">
                            <i class="fas fa-list fa-sm fa-fw"></i> Sort Attribute
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
                    <script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
                    <script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(document).on("change", "#product_id", function() {
                                dttable.ajax.reload();
                            });
                            $.extend($.fn.DataTable.ext.classes, {
                                sWrapper: "dataTables_wrapper dt-bootstrap4",
                            });
                            var dttable = $("#dtbl").DataTable({
                                "columnDefs": [{
                                    className: 'text-right',
                                    orderable: false,
                                    targets: 4
                                }],
                                "columns": [{
                                        "data": "slno"
                                    },
                                    {
                                        "data": "product_id",
                                    },
                                    {
                                        "data": "attr1"
                                    },
                                    {
                                        "data": "attr2"
                                    },
                                    {
                                        "data": "id"
                                    }
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/attribute/get_dtrecords") ?>",
                                    "dataType": "json",
                                    "type": "POST",
                                    "data": function(d) {
                                        //console.log($('#product_id').val());
                                        d.product = ($("#product_id").val()=="") ? "" : parseInt($("#product_id").val());
                                    }
                                },
                                "destroy": true,
                                language: {
                                    processing: "Loading...<div class='loading'></div>",
                                },
                                "order": [
                                    [0, 'asc']
                                ],
                                "lengthMenu": [
                                    [20, 30, 50, 100, 200],
                                    [20, 30, 50, 100, 200]
                                ]
                            });

                        });
                    </script>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Select Product  :  <label>
                            <select id="product_id" class="form-control form-control-sm">
                                <option value="">Select a product</option>
                                <?php foreach ($this->products_model->get_all() as $prows) { ?>
                                    <option value="<?= $prows->id ?>"><?= $prows->product_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <table class="table table-bordered" id="dtbl">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Product Name</th>
                                <th>Attribute 1</th>
                                <th>Attribute 2</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>