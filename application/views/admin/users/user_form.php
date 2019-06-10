<div class="container-fluid">
  <div class="mb-4">
    <?=$this->breadcrumbs->show();?>
  </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-12">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Admin User</h6>
                        <div class="dropdown no-arrow">
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
                        </div>
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
										<div class="col-md-12"><label>Role<span class="text-danger">*</span></label></div>
										<div class="col-md-12">
                      <select name="role_id" class="form-control form-control-sm" >
                        <option value="">Select a role</option>
                        <?php foreach ($role_list as $key => $value) { ?>
                          <option <?php if($role_id == $value->role_id){echo "selected";}?> value="<?php echo $value->role_id;?>"><?php echo $value->name;?></option>
                        <?php } ?>
                      </select>

                      <?php echo form_error('role_id') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Username<span class="text-danger">*</span></label></div>
										<div class="col-md-12">
                      <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Enter username" value="<?php echo $username; ?>" />
                      <?php echo form_error('username') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Mobile</label></div>
										<div class="col-md-12">
                      <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="Enter mobile number" value="<?php echo $mobile; ?>" />
                      <?php echo form_error('mobile') ?>
										</div>
									</div>
								</div>
                <div class="row">
									<div class="form-group full-width">
										<div class="col-md-12"><label>Password<span class="text-danger">*</span></label></div>
										<div class="col-md-12">
                      <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                      <?php echo form_error('password') ?>
										</div>
									</div>
								</div>


								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<div class="row">
									<div class="col-md-12" ></br>
										<button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
										<a href="<?php echo site_url('admin/users') ?>" class="btn btn-info btn-sm">Cancel</a>
									</div>
								</div>
							</div>

							</form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
