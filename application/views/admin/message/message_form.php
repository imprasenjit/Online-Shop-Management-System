
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Compose Message</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
								<!--<div class="dropdown-header">Dropdown Header:</div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
							<div class="row">
	                <div class="col-md-12">
	                    <div class="product-status-wrap">

								<form action="<?php echo $action; ?>" method="post">
									<!--<div class="form-group">
											<label for="varchar">From <?php echo form_error('send_from') ?></label>
											<input type="text" class="form-control form-control-sm" name="send_from" id="send_from" placeholder="From :" value="<?php echo $send_from; ?>" />
									</div>-->
									<div class="form-group">
											<label for="varchar">To <?php echo form_error('send_to') ?></label>
											<input type="text" class="form-control form-control-sm" name="send_to" id="send_to" placeholder="To : " value="<?php echo $send_to; ?>" />
									</div>
									<div class="form-group">
											<label for="varchar">Subject <?php echo form_error('subject') ?></label>
											<input type="text" class="form-control form-control-sm" name="subject" id="subject" placeholder="Subject :" value="<?php echo $subject; ?>" />
									</div>
									<?php $msgFooter="Regards, \nSupply Origin \nGuwahati Assam"; ?>
									<div class="form-group">
											<label for="varchar">Message <?php echo form_error('message') ?></label>
											<textarea type="text" class="form-control form-control-sm" rows="10" name="message" id="message" placeholder="Enter Your Message Here : "><?php echo $message; ?><?php echo $msgFooter; ?></textarea>
									</div>
									<input type="hidden" name="id" value="<?php echo $id; ?>" />
									<button type="submit" class="btn btn-sm btn-primary">Submit</button>
									<a href="<?php echo site_url('admin/message') ?>" class="btn btn-default">Cancel</a>
								</form>
							</div>
	                    </div>
	                </div>
						</div>
					</div>

            </div>
        </div>
        </div>
