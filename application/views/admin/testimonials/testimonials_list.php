<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Testimonials List</h6>
                </div>
                <div class="card-body">
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
                                    {"data": "sl_no"},
                                    {"data": "name"},
                                    {"data": "email"},
                                    {"data": "contact"},
                                    {"data": "id"}
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/testimonials/get_dtrecords") ?>",
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
                                <th>(#)</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", ".activate", function() {
            var element = $(this);
            var feedback_id = $(this).attr("data-id");
            var feedback_status = parseInt($(this).attr("data-status"));
            $(this).empty().append("Processing...");
            $.ajax({
                url: "<?= base_url("admin/testimonials/activate/") ?>",
                method: "POST",
                data: {
                    feedback_id: feedback_id,
                    feedback_status:feedback_status
                },
                dataType: "json",
                success: function(jsn) {
                    if (jsn.x == 1) {
                        element.removeClass("btn-danger").addClass("btn-success");
                        if(feedback_status==1){
                            element.empty().append('<i class="glyphicon glyphicon-ok"></i>&nbsp;Activated');
                        }else{
                            element.empty().append('<i class="glyphicon glyphicon-ok"></i>&nbsp;Deactivated');
                        }
                        
                        $.notify({
                            message: 'Testimonials Activated Successfully'
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