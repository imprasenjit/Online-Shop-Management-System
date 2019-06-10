<div class="container-fluid">
    <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">About us</h6>
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
                    <form action="<?=site_url('admin/aboutus/save')?>" method="post">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>About us<span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm" name="aboutus_content" id="aboutus_content"><?=$aboutus_content?></textarea>
                            </div>
                        </div>

                        <div class=" col-md-6 form-group">
                          <label for="varchar">Upload Image <?php echo form_error('picture') ?></label>
                          <?php if($file_path){ ?>
                          <input type="file" name="aboutus_img" id="aboutus_image" data-error="Please upload  image." value="<?php echo $file_path; ?>" />
                          <br/><img src="<?php echo $file_path; ?>" class="img-responsive"  style="width:120px;height:100px;">

                          <?php }else{ ?>
                            <input type="file" name="aboutus_img" id="aboutus_image" data-error="Please upload product image." value="<?php echo $file_path; ?>" />
                          <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12" ></br>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <a href="<?php echo site_url('admin/aboutus') ?>" class="btn btn-info btn-sm">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?= base_url("assets/admin/summernote/summernote-lite.css"); ?>" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>

<script src="<?= base_url("assets/admin/summernote/summernote-lite.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#aboutus_content').summernote({
            placeholder: 'Type your message here',
            tabsize: 2,
            height: 350
        });

        $("#aboutus_image").pekeUpload({
          bootstrap: true,
          url: "<?= base_url(); ?>upload/",
          data: {file: "aboutus_img"},
          limit: 1,
          allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
    });
</script>
