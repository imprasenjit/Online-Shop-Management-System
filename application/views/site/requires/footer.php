<div class="footer">
    <div class="container">
        <div class="agileits_w3layouts_footer_grids">
            <div class="col-md-3 agileits_w3layouts_footer_grid">
                <h3 class="my-footer-h3">Steel</h3>
                <ul class="footer-cat">
                    <li><a href="#!">Construction Steel</a></li>
                    <li><a href="#!">Structural Steel</a></li>
                    <li><a href="#!">Galvanised Iron</a></li>
                </ul>
                <br/>
                <h3 class="my-footer-h3">Lubricants</h3>
                <ul class="footer-cat">
                    <li><a href="#!">Construction Steel </a></li>
                    <li><a href="#!">Structural Steel</a></li>
                    <li><a href="#!">Galvanised Iron</a></li>
                </ul>
            </div>
            <div class="col-md-6 agileits_w3layouts_footer_grid footer-border-left">
                <h3>To Avail our Services</h3>
                <form action="<?=base_url('contactus/save')?>" method="post" class="form-footer">
                    <div class="row">
                        <div class=" col-md-6 form-group">
                            <input  type="text" class="form-control input-sm." name="fullname" placeholder="Full Name" />
                            <?=form_error("fullname")?>
                        </div>
                        <div class="col-md-6 form-group">
                            <input  type="email" class="form-control input-sm." name="email" autocomplete="off" placeholder="Email id" />
                            <?=form_error("email")?>
                        </div>
                    </div>                    <div class="row">
                        <div class=" col-md-6 form-group">
                            <input  type="text" class="form-control input-sm." name="mobile" maxlength="10" placeholder="Mobile No." />
                            <?=form_error("mobile")?>
                        </div>
                        <div class="col-md-6 form-group">
                            <input  type="text" class="form-control input-sm." name="company" placeholder="Company name" />
                            <?=form_error("company")?>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-md-12 form-group">
                            <textarea class="form-control" name="message" rows="2" placeholder="Type your message here.."></textarea>
                            <?=form_error("message")?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg mybtn-footer-form">Send Message</button>
                </form>
            </div>

            <div class="col-md-3 agileits_w3layouts_footer_grid">
                <h3>Address</h3>
                <p>G.S. Road,Guwahati, Assam, India
                    <br/>Phone:+91- 9706189034</i></p>
                <ul>
                    <li><span>Email :</span> <a href="mailto:sales@supplyorigin.com">sales@supplyorigin.com</a></li>
                </ul>                
                <ul>
                    <li><a href="<?=base_url('feedback');?>">Send Feedback</a></li>
                </ul>                
                <ul class="footer-connected">
                    <li>Stay Connected&nbsp;&nbsp;</li>
                    <li><a href="#"><i class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;&nbsp;</li>
                    <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                </ul>
                <br/><br/><br/><br/><br/><br/><br/>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="wthree_copy_right copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8"><p class="text-left">© <?php echo date("Y"); ?> SupplyOrigin. All rights reserved.                
                </p></div>
            <!--<div class="col-md-3 top-middle">
            <ul>
                <li><a class="facebook" href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                <li><a class="facebook" href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
            </ul>
        </div>-->
        </div>
    </div>
</div>
<?php $this->load->view("site/requires/cart_modal.php"); ?>
<?php $this->load->view("site/requires/login_modal.php"); ?>
<?php $this->load->view("site/requires/register_modal.php"); ?>

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
            $('#login_modal').modal("show");
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
</body>
</html>