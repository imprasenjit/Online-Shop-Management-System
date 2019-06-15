
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
      <!-- <link href="<?=base_url()?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">
      <script src="<?=base_url()?>assets/js/bootstrap-toggle.min.js"></script> -->
        <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>
                        <div class="dropdown no-arrow">
                          <a class="btn btn-outline-primary btn-sm" href="<?=base_url();?>admin/blogs/create" role="button">
                              <i class="fas fa-plus fa-sm"></i> Add new blog
                          </a>
                        </div>
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
                                      targets: 2
                                  }],
                                    "columns": [
                                        {"data": "blogs_id"},
                                        {"data": "blog_title"},
                                        {"data": "is_published"},
                                        {"data": "action"}
                                    ],
                                    "processing": true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": "<?= base_url("admin/blogs/get_records") ?>",
                                        "dataType": "json",
                                        "type": "POST"
                                    },
                                    "fnDrawCallback": function() {
                                      //  jQuery('#dtbl #is_published_toggle').bootstrapToggle();
                                      },
                                    language: {
                                        processing: "<div class='loading'></div>",
                                    },
                                    "order": [[0, 'asc']],
                                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
                                });

                                $("#dtbl").on("change","#is_published_toggle",function(){
                                  var is_published='';
                                  var blogs_id=$(this).attr("data-blogs_id");
                                  if($(this,"#is_published_toggle").prop("checked") == true){
                                    is_published='1';
                                  }else {
                                    is_published='0';
                                  }

                                  $.ajax({
                                         type: "post",
                                         url: "<?=base_url();?>admin/blogs/publish",
                                         data: {
                                             is_published: is_published,
                                             blogs_id: blogs_id,
                                         },
                                         success: function(data) {
                                           var myTable = $('#dtbl').DataTable();
                                           myTable.ajax.reload( null, false );
                                         }
                                     });


                                });
                            });
                        </script>
                        <table class="table table-bordered" id="dtbl">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Publish</th>
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
