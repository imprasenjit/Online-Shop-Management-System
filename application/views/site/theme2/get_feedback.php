<div class="container">
    <div class="row">
      <div class="col-md-2"></div>
		<div class="col-md-8 ">
			<div class="profile-content" style="margin-top:10px;">
				<h4 align="center">Send Us Your Feedback</h4>
									<div style="margin-top: 8px" id="message" align="center">
										<font color="green"><strong><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></strong></font><br />
									</div>
						<div class="panel panel-info">
							<!--<div class="panel-heading" style="font-weight:800;">Tell us your Preferences</div>-->
							<div class="panel-body">
								<form action="<?= base_url(); ?>home/save_feedback_form" method="post"><br />

									<div class="row">
										<div class=" col-md-6 form-group">
											<input style="height:50px" type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="" />
                      <?php echo form_error('name')?>
										</div>
										<div class="col-md-6 form-group">
											<input style="height:50px" type="email" class="form-control" name="email" id="email" placeholder="Email" value="" autocomplete="off" />
                        <?php echo form_error('email')?>
										</div>
									</div>
									<div class="row">
										<div class=" col-md-6 form-group">
											<input style="height:50px" type="text" class="form-control" name="contact" id="contact" placeholder="Contact No." value="" maxlength="10"/>
                        <?php echo form_error('contact')?>
										</div>
										<div class="col-md-6 form-group">
											<!--<label>Address<span class="text-danger">*</span></label>-->
											<textarea type="text" class="form-control" name="address" id="address" placeholder="Address"></textarea>
                        <?php echo form_error('address')?>
										</div>
									</div>

									<div class="row">
										<div class=" col-md-12 form-group">
											<textarea type="text" class="form-control" name="message" id="message" rows="4" placeholder="Type your message here.."></textarea>
                        <?php echo form_error('message')?>
										</div>
									</div>

									<div align="center">
										<button type="submit" class="btn btn-primary btn-lg add_to_cart">Send Feedback</button>
									</div>

								</form>
							</div>

					</div>
				</div>
      </div>
		</div>
    <div class="col-md-2"></div>
	</div>
