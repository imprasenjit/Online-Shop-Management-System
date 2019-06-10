
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Enquiries List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
                        <link href="<?= base_url('public/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
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
                                      targets: 5
                                  }],
                                    "columns": [
                                        {"data": "sl_no"},
                                        {"data": "unique_id"},
                                        {"data": "enquiry_placed_date"},
                                        {"data": "name"},
                                        {"data": "email"},
                                        {"data": "enquiry_id", width: 200}
                                    ],
                                    "processing": true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": "<?= base_url("admin/enquires/get_dtrecords") ?>",
                                        "dataType": "json",
                                        "type": "POST",
                                    },
                                    language: {
                                        processing: "<div class='loading'></div>",
                                    },
                                    "order": [[0, 'DESC']],
                                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
                                });
                            });
                        </script>
                        <table class="table table-bordered" id="dtbl">
                            <thead>
                                <tr>
                                    <th>(#)</th>
                                    <th>Enquiry ID</th>
                                    <th>Enquiry Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
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
