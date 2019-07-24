<link href="<?= base_url(); ?>assets/theme2/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />
<link href="<?= base_url(); ?>assets/theme2/css/styles.css" rel="stylesheet" />
<script src="<?= base_url(); ?>assets/theme2/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/theme2/js/gsdk-bootstrap-wizard.js"></script>
<script>
    $(document).ready(function () {
        $('#partnerprograms').addClass('active');
    });
</script>
<div class="agile-banner">
			<div class="text-center container" style="color:white; padding:200px 170px;">
                    <h1 class="header-title-inner-page" style="font-size:4vh; font-weight:900;">Partner Programs</h1>
            </div>
	</div>
	<!-- //banner -->
	<!---728x90--->

	<!-- products -->
	<section style="padding-bottom: 100px; background-color:grey">
			<div class="container">
					<div class="row">
					<div class="col-sm-12">
			
						<!--      Wizard container        -->
						<div class="wizard-container">
							<div class="card wizard-card" data-color="green" id="wizard">
							<form action="" method="">
							<!--        You can switch ' data-color="green" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
			
									<div class="wizard-header">
										<h3>
										   <b>JOIN US</b> <br>
										   <small>Connect to our platform catering a wide range of construction/building materials.</small>
										</h3>
									</div>
									<div class="wizard-navigation">
										<ul>
											<li><a href="#location" data-toggle="tab">Details</a></li>
											<li><a href="#type" data-toggle="tab">Category</a></li>
											<li><a href="#facilities" data-toggle="tab">More</a></li>
											<li><a href="#description" data-toggle="tab">Message</a></li>
										</ul>
									</div>
			
									<div class="tab-content">
										<div class="tab-pane" id="location">
										  <div class="row">
											  <div class="col-sm-12">
												<h4 class="info-text"> Let's start with the basic details</h4>
											  </div>
											  <div class="col-sm-5 col-sm-offset-1">
													<div class="form-group">
														<label>Name</label>
														<div class="input-group">
																<input type="text" class="form-control" placeholder="Please Enter fullname">
																<span class="input-group-addon"></span>
															</div>
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label>Mobile No.</label>
														<div class="input-group">
															<input type="text" class="form-control" placeholder="Enter contact number">
															<span class="input-group-addon"></span>
														</div>
													</div>
												</div>
											  <div class="col-sm-5 col-sm-offset-1">
												  <div class="form-group">
													<label>Email</label>
													<input type="text" class="form-control" id="exampleInputEmail1" placeholder="example@mail.com">
												  </div>
											  </div>
											  <div class="col-sm-5">
												   <div class="form-group">
														<label>State</label><br>
														 <select name="state" class="form-control">
															<option disabled="" selected="">- State -</option>
															<option value="Andaman and Nicobar ">Andaman and Nicobar </option>
															<option value="Andhra Pradesh ">Andhra Pradesh </option>
															<option value="Arunachal Pradesh ">Arunachal Pradesh </option>
															<option value="Assam ">Assam </option>
															<option value="Bihar ">Bihar </option>
															<option value="Chandigarh ">Chandigarh </option>
															<option value="Chhattisgarh ">Chhattisgarh </option>
															<option value="Dadra and Nagar Haveli ">Dadra and Nagar Haveli </option>
															<option value="Daman and Diu ">Daman and Diu </option>
															<option value="Delhi ">Delhi </option>
															<option value="Goa ">Goa </option>
															<option value="Gujarat ">Gujarat </option>
															<option value="Haryana ">Haryana </option>
															<option value="Himachal Pradesh ">Himachal Pradesh </option>
															<option value="Jammu and Kashmir ">Jammu and Kashmir </option>
															<option value="Jharkhand ">Jharkhand </option>
															<option value="Karnataka ">Karnataka </option>
															<option value="Kerala ">Kerala </option>
															<option value="Lakshadweep ">Lakshadweep </option>
															<option value="Madhya Pradesh ">Madhya Pradesh </option>
															<option value="Maharashtra ">Maharashtra </option>
															<option value="Manipur ">Manipur </option>
															<option value="Meghalaya ">Meghalaya </option>
															<option value="Mizoram ">Mizoram </option>
															<option value="Odisha ">Odisha </option>
															<option value="Puducherry ">Puducherry </option>
															<option value="Punjab ">Punjab </option>
															<option value="Rajasthan ">Rajasthan </option>
															<option value="Sikkim ">Sikkim </option>
															<option value="Tamil Nadu ">Tamil Nadu </option>
															<option value="Telangana ">Telangana </option>
															<option value="Tripura ">Tripura </option>
															<option value="Uttar Pradesh ">Uttar Pradesh </option>
															<option value="Uttarakhand ">Uttarakhand </option>
															<option value="West Bengal ">West Bengal </option>
														</select>
													  </div>
											  </div>
											  
										  </div>
										</div>
										<div class="tab-pane" id="type">
											<h4 class="info-text">What type of business do you have? </h4>
											<div class="row">
												<div class="col-sm-12 ">
													<div class="col-sm-4">
														<div class="choice" data-toggle="wizard-radio" >
															<input type="radio" name="type" value="House">
															<div class="icon">
																<i class="fa fa-home"></i>
															</div>
															<h6>SME</h6>
															<br>
															<h7>If you are small medium enterprise,<br> shop owner or individuals looking for<br> quality and cost-effective products. </h7><br>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="choice" data-toggle="wizard-radio">
															<input type="radio" name="type" value="Appartment">
															<div class="icon">
																<i class="fa fa-building"></i>
															</div>
															<h6>Company</h6>
															<br>
															<h7>If you are a company, looking for warehouse<br> and logistics solution in the northeast region. </h7><br>
														</div>
													</div>
													<div class="col-sm-4">
															<div class="choice" data-toggle="wizard-radio">
																<input type="radio" name="type" value="Channel">
																<div class="icon">
																	<i class="fa fa-television"></i>
																</div>
																<h6>Channel Partnership</h6>
																<br>
															<h7>If you are a manufacturer and looking for<br> a channel partner in the northeast region.</h7><br>
															</div>
														</div>
			
												</div>
											</div>
										</div>
										<div class="tab-pane" id="facilities">
											<div class="row">
											  <div class="col-sm-12">
												<h4 class="info-text">Tell us more about you business.</h4>
											  </div>
											  <!--<small class="info-text">You can skip ahead if you are not a retailer/distributor.</small>-->
											  <div class="col-sm-5 col-sm-offset-1">
													<div class="form-group">
														<label>Company Name</label>
														<div class="input-group">
																<input type="text" class="form-control" placeholder="Please Enter fullname">
																<span class="input-group-addon"></span>
															</div>
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label>Products Manufactured</label>
														<div class="input-group">
															<input type="text" class="form-control" placeholder="Enter you product details">
															<span class="input-group-addon"></span>
														</div>
													</div>
												</div>
											  <div class="col-sm-5 col-sm-offset-1">
												  <div class="form-group">
													<label>Registered Office Address</label>
													<input type="text" class="form-control" placeholder="Enter full address.">
												  </div>
											  </div>
											  <div class="col-sm-5">
												  <div class="form-group">
													<label>Factory/Plant Address</label>
													<input type="text" class="form-control" placeholder="Enter full address.">
												  </div>
											  </div>
											  
										  </div>
										</div>
										<div class="tab-pane" id="description">
											<div class="row">
												<h4 class="info-text"> Drop us a message. </h4>
												<div class="col-sm-6 col-sm-offset-1">
													 <div class="form-group">
														<label>Your message</label>
														<textarea class="form-control" placeholder="Your message" rows="9">
			
														</textarea>
													  </div>
												</div>
												<div class="col-sm-4">
													 <div class="form-group">
														<!--<label>Example</label>-->
														<label> </label>
														<p class="description">"Drop us a message to know more about our services."</p>
													  </div>
												</div>
											</div>
										</div>
									</div>
									<div class="wizard-footer">
											<div class="pull-right">
												<input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' value='Next' />
												<input type='button' class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish' value='Finish' />
			
											</div>
											<div class="pull-left">
												<input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
											</div>
											<div class="clearfix"></div>
									</div>
			
								</form>
							</div>
						</div> <!-- wizard container -->
					</div>
					</div> <!-- row -->
				</div>
    </section>
    