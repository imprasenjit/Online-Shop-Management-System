<div class="container-fluid">
  <div class="mb-4">
    <?=$this->breadcrumbs->show();?>
  </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Sub category</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
							<form class="form-horizontal" action="<?php echo $action; ?>" method="post">
								<div class="row" style="margin-left:10px; margin-right:10px;">
									<div class="form-group full-width">
										<div class=" col-md-6">											
											<label>Enter Category<span class="text-danger">*</span></label>
											<select class="form-control form-control-sm" name="category" id="category">
												<option value="" >Please Select</option>
												<?php foreach ($category as $p): ?>
													<option value="<?= $p->id ?>" <?=($parent_category==$p->id)?"selected":"";?>><?= $p->category_name ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-6">
											<label>Enter Sub-Category<span class="text-danger">*</span></label>
											<input type="text" class="form-control form-control-sm" name="sub_category" id="sub_category" placeholder="Enter Sub-Category" value="<?php echo $sub_category; ?>" />
										</div>
									</div>
								</div>
								<div class="row" style="margin-left:10px; margin-right:10px;">
									<div class="form-group full-width">
										<div class=" col-md-6">
											<label>Description</label>
											<textarea  type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Enter Category Description"><?php echo $description; ?></textarea>
										</div>
										<div class="col-md-6">
											<label for="varchar"><br/><br/>Upload sub-category Image <?php echo form_error('picture') ?></label>
											<?php if($picture){ ?>
												<input type="file" name="picture" id="picture" data-error="Please upload sub-category image." value="<?php echo $picture; ?>" />
												<img src="<?php echo base_url($picture); ?>" class="img-responsive"  style="width:120px;height:100px;">

											<?php }else{ ?>
												<input type="file" name="picture" id="picture" data-error="Please upload sub-category  image." value="<?php echo $picture; ?>" />
											<?php } ?>
										</div>
                    <div class="col-md-6">
                      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      								<div >
                        <br/>
      								<a href="<?php echo site_url('admin/sub_category') ?>" class="btn btn-sm btn-info">Cancel</a>
      								<button type="submit" class="btn btn-sm btn-primary"><?php echo $button ?></button>
      								</div>
                    </div>
									</div>
								</div>

								<br><br>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
