<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    <div class="dropdown no-arrow">
                    <a class="btn btn-sm btn-outline-primary" href="<?=base_url("admin/category/create")?>" role="button" >
                          <i class="fas fa-plus fa-sm fa-fw"></i> Add category
                      </a>
                    </div>
                </div>
                <div class="card-body">
                    <link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
                    <link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
                    <script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
                    <script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $.extend($.fn.DataTable.ext.classes, {
                                sWrapper: "dataTables_wrapper dt-bootstrap4",
                            });
                            $("#dtbl").DataTable({
                                "columnDefs": [{
                                        className: 'text-right',
                                        orderable: false,
                                        targets: 4
                                    }],
                                "columns": [
                                    {"data": "slno"},
                                    {"data": "category_name", width: 200},
                                    {"data": "description"},
                                    {"data": "picture"},
                                    {"data": "id"}
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/category/get_dtrecords") ?>",
                                    "dataType": "json",
                                    "type": "POST",
                                },
                                language: {
                                    processing: "<div class='loading'></div>",
                                },
                                "order": [[0, 'asc']],
                                "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
                            });
                        });
                    </script>
                    <table class="table table-bordered" id="dtbl">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Picture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
