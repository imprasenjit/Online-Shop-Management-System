
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
<?php $this->load->view("site/theme2/requires/cart_modal.php"); ?>
<?php $this->load->view("site/theme2/requires/login_modal.php"); ?>
<?php $this->load->view("site/theme2/requires/register_modal.php"); ?>
<script defer type="text/javascript" src="<?=base_url(); ?>assets/js/move-top.js"></script>
<script defer type="text/javascript" src="<?=base_url(); ?>assets/js/easing.js"></script>
<script type="text/javascript">
//console.log("d sj");
$(document).ready(function() {
    //alert("jj");
    $(document).on("click",".cart_modal",function(){

        $('#cart_modal').modal("show");
    });
    $(document).on("click",".login_modal",function(){
        $('#login_modal').modal("show");
    });
    $(document).on("click",".register_modal",function(){
        $('#register_modal').modal("show");
    });
    $(".scroll").click(function(event) {
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
