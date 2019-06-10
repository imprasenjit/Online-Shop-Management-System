<!-- contact -->
<script>
	$(document).ready(function() {
		$('#contact').addClass('active');
	});
</script>
<style>
	#products-carousel div .item img {
		height: 150px !important;
		border-radius: 8px;
	}

	.header-title {
		font-size: 3em;
		text-align: center;
		margin-bottom: 1.3em;
		position: relative;
	}
</style>
<section class="contact-w3ls">
	<div class="container main-contact-body">
		<div class="wthree-heading">
			<h2 class="header-title ">Contact Us</h2>
			<!--<p class="quia">You can directly Contact Us</p>-->
		</div>
		<div class="con-top">
			<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
				<div class="contact-agileits">
					<h4>Get In Touch</h4>
					<form action="#" method="post">
						<div class="control-group form-group">
							<div class="controls">
								<label class="contact-p1">Full Name:</label>
								<input type="text" class="form-control" name="name" id="name" Placeholder=" " required="">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="contact-p1">Phone Number:</label>
								<input type="tel" class="form-control" name="phone" id="phone" Placeholder=" " required="">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="contact-p1">Email Address:</label>
								<input type="email" class="form-control" name="email" id="email" Placeholder=" " required="">
								<p class="help-block"></p>
							</div>
						</div>

						<div class="control-group form-group">
							<div class="controls">
								<label class="contact-p1">Message:</label>
								<textarea type="text" class="form-control" name="comments" id="comments" Placeholder="Enter your Comments here" rows="5" required=""></textarea>
								<p class="help-block"></p>
							</div>
						</div>
						<div id="success"></div>
						<!-- For success/fail messages -->
						<button type="submit" class="btn btn-primary add_to_cart">Send</button>
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
				<img src="<?= base_url(); ?>assets/images/supply_logo.png" width="250px">
				<p class="contact-agile1"><strong>Phone :</strong> +91 9706122341</p>
				<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:name@supplyorigin.com">info@supplyorigin.com</a></p>
				<p class="contact-agile1"><strong>Address :</strong> G.S. Road, Bhangagarh, Guwahati, Assam
					<br>
					<ul class="agileits_social_list">
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					</ul>
				</p>


				<hr />
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3581.449362924448!2d91.78361241449409!3d26.149490983462186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a59115cff362d%3A0x19261d66b7aa8d83!2sGS+Rd%2C+Guwahati%2C+Assam!5e0!3m2!1sen!2sin!4v1555066043105!5m2!1sen!2sin" width="100%" height="220" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>