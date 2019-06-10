<div class="container-fluid">
  <div class="mb-4">
    <?=$this->breadcrumbs->show();?>
  </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-12">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Category</h6>
                        <!--<div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>-->
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
							<form class="form-horizontal" action="<?php echo $action; ?>" method="post">
							<div class="col-md-6 ">
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Category<?php echo form_error('category_name') ?><span class="text-danger">*</span></label></div>
										<div class="col-md-12">
											<input type="text" class="form-control form-control-sm" name="category_name" id="category_name" placeholder="Enter Category Name" value="<?php echo $category_name; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Description<?php echo form_error('description') ?> <span class="text-danger">*</span></label></div>
										<div class="col-md-12">
											<textarea  type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Enter Category Description"><?php echo $description; ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group full-width"></div>
									<div class=" col-md-12">
										<label for="varchar">Upload Product Image <?php echo form_error('picture') ?></label>
										<?php if($picture){ ?>
										<input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $picture; ?>" />
										<img src="<?php echo base_url($picture); ?>" class="img-responsive"  style="width:120px;height:100px;">

										<?php }else{ ?>
											<input type="file" name="picture" id="picture" data-error="Please Upload Category Image." value="<?php echo $picture; ?>" />
										<?php } ?>
									</div>
								</div>

								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<div class="row">
									<div class="col-md-12" ></br>
										<button type="submit" class="btn btn-sm btn-primary"><?php echo $button ?></button>
										<a href="<?php echo site_url('admin/category') ?>" class="btn btn-sm btn-info">Cancel</a>
									</div>
								</div>
							</div>

							</form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
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
