<div class="container-fluid">
    <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Downloads</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?=site_url('admin/downloads/save')?>" method="post">
                        <input name="download_id" value="<?=$download_id?>" type="hidden" />
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Title<span class="text-danger">*</span></label>
                                <input name="download_title" value="<?=$download_title?>" class="form-control" type="text" />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea name="download_description" class="form-control form-control-sm"><?=$download_description?></textarea>
                            </div>
                        </div>

                        <div class=" col-md-6 form-group">
                          <label for="varchar">Upload Image <?php echo form_error('picture') ?></label>
                          <?php if($file_path){ ?>
                          <input type="file" name="download_file" id="downloads_image" data-error="Please upload  image." value="<?php echo $file_path; ?>" />
                          <br/><img src="<?php echo $file_path; ?>" class="img-responsive"  style="width:120px;height:100px;">

                          <?php }else{ ?>
                            <input type="file" name="download_file" id="downloads_image" data-error="Please upload product image." value="<?php echo $file_path; ?>" />
                          <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12" ></br>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <a href="<?php echo site_url('admin/downloads') ?>" class="btn btn-info btn-sm">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Downloads List</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                        </div>
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
                                    targets: 3
                                }],
                                "columns": [
                                    {"data": "download_id"},
                                    {"data": "download_title", width:200},
                                    {"data": "download_description"},
                                    {"data": "download_file"}
                                ],
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "<?= base_url("admin/downloads/get_dtrecords") ?>",
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#downloads_image").pekeUpload({
          bootstrap: true,
          url: "<?= base_url(); ?>upload/",
          data: {file: "download_file"},
          limit: 1,
          allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
    });
</script>
