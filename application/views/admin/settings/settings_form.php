
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

            <form action="<?php echo $action; ?>" method="post">
              <div class="row">
                  <div class=" col-md-12 form-group">
                      <label for="varchar">Header Image </label>
                      <?php if ($sett_pdf_header) { ?>
                          <input type="file" name="header_image" id="header_image" data-error="Please upload  image." value="<?php echo $sett_pdf_header['values']; ?>" />
                          <br/><img src="<?php echo base_url($sett_pdf_header['values']); ?>" class="img-responsive"  style="width:120px;height:100px;">
                            <input type="hidden" name="header_setting_id" value="<?=$sett_pdf_header['settings_id'];?>" />
                      <?php } else { ?>
                          <input type="file" name="header_image" id="header_image" data-error="Please upload product image." />

                      <?php } ?>
                  </div>
              </div>
              <div class="row">
                  <div class=" col-md-12 form-group">
                      <label for="varchar">Footer Image <?php echo form_error('picture') ?></label>
                      <?php if ($sett_pdf_footer) {?>
                          <input type="file" name="footer_image" id="footer_image" data-error="Please upload  image." value="<?php echo $sett_pdf_footer['values']; ?>" />
                          <br/><img src="<?php echo base_url($sett_pdf_footer['values']); ?>" class="img-responsive"  style="width:120px;height:100px;">
                          <input type="hidden" name="footer_setting_id" value="<?=$sett_pdf_footer['settings_id'];?>" />

                      <?php } else { ?>
                          <input type="file" name="footer_image" id="footer_image" data-error="Please upload product image."  />
                      <?php } ?>
                  </div>
              </div>
                <div class="row">
                    <div class="col-md-6 form-group ">
                        <label>Color</label>
                          <?php if ($sett_color) { ?>
                            <select class="form-control form-control-sm" name="color_code">
                              <option <?php if($sett_color['values']=="color1"){echo "selected";}?> value="color1">Color 1</option>
                              <option <?php if($sett_color['values']=="color2"){echo "selected";}?> value="color2">Color 2</option>
                              <option <?php if($sett_color['values']=="color3"){echo "selected";}?> value="color3">Color 3</option>
                            </select>
                            <input type="hidden" name="color_setting_id" value="<?=$sett_color['settings_id'];?>" />
                          <?php  }else { ?>
                            <select class="form-control form-control-sm" name="color_code">
                              <option value="color1">Color 1</option>
                              <option value="color2">Color 2</option>
                              <option value="color3">Color 3</option>
                            </select>
                          <?php }?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" ></br>
                        <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                        <a href="<?php echo site_url('admin/settings') ?>" class="btn btn-info btn-sm">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- </div>
                  </div>
              </div> -->
        </div>
    </div>

</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script type="text/javascript">
    $(document).ready(function ($) {
        $("#header_image").pekeUpload({
            bootstrap: true,
            url: "<?= base_url(); ?>upload/",
            data: {file: "header_image"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
        $("#footer_image").pekeUpload({
            bootstrap: true,
            url: "<?= base_url(); ?>upload/",
            data: {file: "footer_image"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });

    });
</script>
