<div class="container-fluid">
  <div class="mb-4">
    <?= $this->breadcrumbs->show(); ?>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?= $button ?> Associated Brands</h6>
          <div class="dropdown no-arrow">
            <a class="btn btn-outline-primary btn-sm" href="<?= base_url(); ?>admin/associated_brands/create" role="button">
              <i class="fas fa-plus fa-sm"></i> Add Associated Brands
            </a>
            <!--
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
								<div class="dropdown-header">Dropdown Header:</div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>-->
          </div>
        </div>
        <!-- Card Body -->
        <form action="<?php echo $action; ?>" method="post">
        <div class="card-body">          
            <div class="row"> <br />
              <div class=" col-md-6 form-group">
                <label>Brand Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Enter brand name." value="<?php echo $name; ?>" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Description<span class="text-danger">*</span></label>
                <textarea type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Enter Brand description."><?php echo $description; ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class=" col-md-6 form-group">
                <label for="varchar">Upload Product Image <?php echo form_error('picture') ?></label>
                <?php if ($picture) { ?>
                  <input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $picture; ?>" />
                  <img src="<?php echo base_url($picture); ?>" class="img-responsive" style="width:120px;height:100px;">
                <?php } else { ?>
                  <input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $picture; ?>" />
                <?php } ?>
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
          
        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                <a href="<?php echo site_url('admin/associated_brands') ?>" class="btn btn-info btn-sm">Close</a>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
  <script>
    $(document).ready(function($) {
      $("#picture").pekeUpload({
        bootstrap: true,
        url: "<?= base_url(); ?>upload/",
        data: {
          file: "picture"
        },
        limit: 1,
        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
      });
    });
  </script>