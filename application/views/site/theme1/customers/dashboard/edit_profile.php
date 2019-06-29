    <div class="row profile">
		<div class="col-md-2">
		<?php $this->load->view("site/theme1/customers/dashboard/profile");?>
		</div>
		<div class="col-md-10">
			<div class="profile-content" style="margin-top:10px;">
				<div class="col-md-12">
						<div class="card">
							<div class="card-header " style="font-weight:800;">
                <div class="row">
                  <div class="col-md-2">
                    <a href="<?php echo site_url('customers/dashboard') ?>" class="" ><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                  </div>
                  <div align="center" class="col-md-8">Edit Profile</div>
                </div>
							</div>
							<div class="panel-body">
                <?php if ($this->session->flashdata("message")) { ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> <?= $this->session->flashdata("message") ?>
                  </div>
                <?php } ?>
								<form action="<?php echo $action; ?>" method="post">
									<div class="row">
										<div class=" col-md-6 form-group">
											<label>Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $name; ?>" />
										</div>
										<div class="col-md-6 form-group">
											<label>Address<span class="text-danger">*</span></label>
											<textarea type="text" class="form-control" name="address" id="address"><?php echo $address; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class=" col-md-6 form-group">
											<label>Contact No.<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="contact" id="contact" placeholder="" value="<?php echo $contact; ?>" maxlength="10"/>
										</div>
										<div class="col-md-6 form-group">
											<label>Email<span class="text-danger">*</span></label>
											<input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $email; ?>" autocomplete="off" />
										</div>
									</div>

									<div class="row">
										<div class=" col-md-6 form-group">
											<label>Password<span class="text-danger">*</span></label>
											<input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" placeholder="Enter New Password" value="" />
										</div>
										<div class="col-md-6 form-group">
											<label>Confirm Password<span class="text-danger">*</span></label>
											<input type="password" class="form-control" name="cpassword"  id="cpassword" value="<?php echo $cpassword; ?>" placeholder="Confirm New Password" value="" />
										</div>
									</div>

									<input type="hidden" name="id" value="<?php echo $id; ?>" />
									<div align="center">
										<!--<a href="<?php echo site_url('dashboard/customer_dashboard') ?>" class="btn btn-danger">Cancel</a>-->
										<button type="submit" class="btn btn-primary "><?php echo $button ?></button>

									</div>

								</form>
							</div>

					</div>
				</div>
            </div>
		</div>
</div>
<script>
        window.onload = function() {
            document.getElementById("password").onchange = validatePassword;
            document.getElementById("cpassword").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("cpassword").value;
            var pass1 = document.getElementById("password").value;
            if (pass1 != pass2)
                document.getElementById("cpassword").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("cpassword").setCustomValidity('');
        }
</script>
<br>
<br>
