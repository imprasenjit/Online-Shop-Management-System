<?php $rights_array=array('add','delete','edit');
?>
<div class="container-fluid">
  <div class="mb-4">
    <?=$this->breadcrumbs->show();?>
  </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-12">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Admin role</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
							<form class="form-horizontal" action="<?php echo $action; ?>" method="post">
							<div class="col-md-6 ">
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Name<span class="text-danger">*</span></label></div>
										<div class="col-md-12">
											<input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Enter Name" value="<?php echo $name; ?>" />
                      <?php echo form_error('name') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Rights<span class="text-danger">*</span></label></div>
										<div class="col-md-12">
                      <select class="form-control form-control-sm mark_to "  multiple name="rights[]" id="rights">
                        
                        <?php if($all_rights){
                          foreach ($all_rights as $key => $right) {
                            if (in_array($right->rights_id,$rights)){ ?>
                                <option value="<?php echo $right->rights_id;?> " selected><?php echo $right->display_name;?></option>
                            <?php }else { ?>
                                <option value="<?php echo $right->rights_id;?>"><?php echo $right->display_name;?></option>
                            <?php }

                           }
                        }?>
                      </select>

                      <?php echo form_error('rights[]') ?>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<div class="row">
									<div class="col-md-12" ></br>
										<button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
										<a href="<?php echo site_url('admin/roles') ?>" class="btn btn-info btn-sm">Cancel</a>
									</div>
								</div>
							</div>

							</form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="<?=base_url('assets/admin/css/jquery.multiselect.css')?>" />
        <script src="<?=base_url('assets/admin/js/jquery.multiselect.js')?>" type="text/javascript"></script>
        <script type="text/javascript">
           $(document).ready(function () {
               $(".mark_to").multiselect({
                   columns: 1,
                   placeholder: "Select Right(s)",
                   search: true,
                   selectAll: true
               });


           });
       </script>
