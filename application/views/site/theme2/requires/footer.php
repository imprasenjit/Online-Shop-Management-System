<!-- footer -->
	<div class="footer-top">
		<div class="container">
			<div class="col-md-3 w3ls-footer-top">
				<h3><span>Quick Links</span></h3>
					<ul>
							<li><a href="<?= base_url(); ?>home">Home</a></li>
							<li><a href="<?=base_url();?>home/about">About</a></li>
							<li><a href="<?= base_url('home/downloads') ?>">Downloads</a></li>
							<li><a href="<?= base_url('home/partnerprograms') ?>">Partner Programs</a></li>
							<li><a href="<?= base_url("view-all-sub-category"); ?>">Products</a></li>
							<li><a href="<?=base_url();?>home/contact">Contact</a></li>
						</ul>
			</div>
			<div class="col-md-5 agileits_w3layouts_footer_grid" >
					<h3><span>To Avail our Services</span></h3>
					<div style="padding:20px;border-left: 1px solid #fff;border-right: 1px solid #fff;">
					<form action="<?=base_url('contactus/save')?>" method="post" class="form-footer">
						<div class="row">
							<div class=" col-md-6 form-group">
								<input type="text" class="form-control input-sm." name="fullname" placeholder="Full Name">
														</div>
							<div class="col-md-6 form-group">
								<input type="email" class="form-control input-sm." name="email" autocomplete="off" placeholder="Email id">
														</div>
						</div>                    <div class="row">
							<div class=" col-md-6 form-group">
								<input type="text" class="form-control input-sm." name="mobile" maxlength="10" placeholder="Mobile No.">
														</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control input-sm." name="company" placeholder="Company name">
														</div>
						</div>

						<div class="row">
							<div class=" col-md-12 form-group">
								<textarea class="form-control" name="message" rows="2" placeholder="Type your message here.."></textarea>
														</div>
						</div>
						<button type="submit" class="btn btn-success btn-lg mybtn-footer-form">Send Message</button>
					</form>
				</div>
				</div>

			<div class="col-md-4 wthree-footer-top text-left">
				<h3><span>Address</span></h3>
					<ul>
					<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span>G.S. Road,Guwahati, Assam, India</li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:sales@supplyorigin.com">sales@supplyorigin.com</a></li>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><a href="tel:+919706122341">+919706122341</a></li>
					<li>Stay connected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://supplyorigin.com/#"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://supplyorigin.com/#"><i class="fa fa-linkedin"></i></a>
					</li>
				</ul>
			</div>


				<div class="clearfix"></div>
			<div class="footer-w3layouts">
				<div class="agile-copy">
					<p>© 2019 SupplyOrigin. All rights reserved</p>
				</div>
			</div>
		</div>
	</div>

<!-- //footer -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url() ?>assets/theme2/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url() ?>assets/theme2/js/numscroller-1.0.js"></script>
<!-- main slider-banner -->
<script src="<?=base_url() ?>assets/theme2/js/skdslider.min.js"></script>
<link href="<?=base_url() ?>assets/theme2/css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});

		});
</script>

<?php $this->load->view("site/theme2/requires/cart_modal"); ?>
<?php $this->load->view("site/theme2/requires/login_modal"); ?>
<?php $this->load->view("site/theme2/requires/register_modal"); ?>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/move-top.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/easing.js"></script>

<script type="text/javascript">
//console.log("d sj");
    $(document).ready(function () {
        //alert("jj");
        $(document).on("click", ".cart_modal", function () {

            $('#cart_modal').modal("show");
        });
        $(document).on("click", ".login_modal", function () {
            $('#loginModal').modal("show");
        });
        $(document).on("click", ".register_modal", function () {
            $('#register_modal').modal("show");
        });
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
        var password = document.getElementById("password");
        var cpassword = document.getElementById("cpassword");
        function validatePassword() {
            if (password.value != cpassword.value) {
                cpassword.setCustomValidity("Passwords Don't Match");
            } else {
                cpassword.setCustomValidity('');
            }
        }
        password.onchange = validatePassword;
        cpassword.onkeyup = validatePassword;
    });

    function clear_cart() {
        var result = confirm('Are you sure want to clear cart?');
        if (result) {
            window.location = "<?php echo base_url(); ?>/shopping/remove/all";
        } else {
            return false; // cancel button
        }
    }
</script>
<!-- //main slider-banner -->
</body>

<!-- Mirrored from demo.w3layouts.com/demos_new/28-03-2017/solar_panel-demo_Free/1233997259/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Jul 2019 07:00:08 GMT -->
</html>
