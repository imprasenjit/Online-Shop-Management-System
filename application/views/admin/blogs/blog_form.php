
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>

                    </div>
                    <!-- Card Body its me don-->
                    <div class="card-body">

                      <form action="<?php echo $action; ?>" method="post">
                          <div class="row">
                              <div class="col-md-12 form-group">
                                  <label>Title<span class="text-danger">*</span></label>
                                  <textarea type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Enter Brand description."><?php echo $description; ?></textarea>
                              </div>
                              <div class="col-md-12 form-group">
                                  <label>Display Order<span class="text-danger">*</span></label>
                                  <input name="display_order" value="<?=$display_order?>" type="text" class="form-control form-control-sm" />
                              </div>
                          </div>

                          <div class="row">
                              <div class=" col-md-12 form-group">
                                  <label for="varchar">Upload Image <?php echo form_error('picture') ?></label>
                                  <?php if ($file_path) { ?>
                                      <input type="file" name="picture" id="picture" data-error="Please upload  image." value="<?php echo $file_path; ?>" />
                                      <br/><img src="<?php echo $file_path; ?>" class="img-responsive"  style="width:120px;height:100px;">

                                  <?php } else { ?>
                                      <input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $file_path; ?>" />
                                  <?php } ?>
                              </div>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $slider_id; ?>" />
                          <div class="row">
                              <div class="col-md-12" ></br>
                                  <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                                  <a href="<?php echo site_url('admin/home_page_slider') ?>" class="btn btn-info btn-sm">Cancel</a>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
              <script type="text/javascript">
                  $(document).ready(function ($) {
                      $("#picture").pekeUpload({
                          bootstrap: true,
                          url: "<?= base_url(); ?>upload/",
                          data: {file: "picture"},
                          limit: 1,
                          allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
                      });

                  });
              </script>
