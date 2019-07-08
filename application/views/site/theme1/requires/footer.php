

<div class="footer-wrap footer-v3" id="footer">
           <footer>
               <div class="container">
                   <div class="row">
                       <div class="col-sm-6">
                           <section class="widget">
                             <div class="widget-heading">
                                 <h4>To Avail our Services</h4>
                             </div>
                                 <form action="<?=base_url('contactus/save')?>" method="post" class="form-footer">
                                     <div class="row">
                                         <div class=" col-md-6 form-group">
                                             <input  type="text" class="form-control input-sm." name="fullname" placeholder="Full Name" />
                                             <?=form_error("fullname")?>
                                         </div>
                                         <div class="col-md-6 form-group">
                                             <input  type="text" class="form-control input-sm." name="email" autocomplete="off" placeholder="Email id" />
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
                           </section>
                       </div>

                       <div class="col-sm-3">
                           <section class="widget v-recent-entry-widget">
                               <div class="widget-heading">
                                   <h4>Recent Posts</h4>
                               </div>
                               <?php
                               $recent_blogs=$this->blogs_model->get_recent_blogs();
                               if($recent_blogs){ ?>
                                 <ul>
                                   <?php foreach ($recent_blogs as $key => $recent): ?>
                                     <li>
                                         <a href="<?=base_url()?>blogs/<?=url_title(trim($recent->blog_title), '-', TRUE)?>/<?=$recent->blogs_id;?>"><?=$recent->blog_title?></a>
                                         <span class="post-date"><?php $blogdate=date_create($recent->created_at); echo date_format($blogdate,"M d,Y H:i");?></span>
                                     </li>
                                   <?php endforeach; ?>


                                 </ul>
                               <?php }?>

                           </section>
                       </div>
                       <div class="col-sm-3">
                           <section class="widget">
                               <div class="widget-heading">
                                   <h4>Contact Us</h4>
                               </div>
                               <div class="footer-contact-info">
                                   <ul>
                                       <li>
                                           <p><i class="fa fa-building"></i>Supply Origin </p>
                                       </li>
                                       <li>
                                           <p><i class="fa fa-map-marker"></i>G.S. Road,Guwahati, Assam, India </p>
                                       </li>
                                       <li>
                                           <p><i class="fa fa-envelope"></i><strong>Email:</strong> <a href="mailto:sales@supplyorigin.com">sales@supplyorigin.com</a></p>
                                       </li>
                                       <li>
                                           <p><i class="fa fa-phone"></i><strong>Phone:</strong> +91- 9706189034</p>
                                       </li>
                                       <li>
                                           <p><a href="<?=base_url('home/feedback');?>">Send Feedback</a></p>
                                       </li>
                                   </ul>
                                   <br />

                                   <div class="clearfix pt-2">
                                       <a href="#" class="social-icon si-dark si-facebook" title="Facebook">
                                           <i class="si-icon-facebook"></i>
                                           <i class="si-icon-facebook"></i>
                                       </a>
                                       <a href="#" class="social-icon si-dark si-linkedin" title="linkedin">
                                       <i class="si-icon-linkedin"></i>
                                              <i class="si-icon-linkedin"></i>
                                       </a>
 
                                   </div>
                               </div>
                           </section>
                       </div>
                   </div>
               </div>
           </footer>

           <div class="copyright">
               <div class="container">
                   <p>© <?php echo date("Y"); ?> Supply Origin. All rights reserved.</p>
                   <nav class="footer-menu std-menu">
                       <ul class="menu">
                           <li><a href="<?=base_url();?>home/about">About Us</a></li>
                           <li><a href="<?=base_url();?>blogs">Blog</a></li>
                           <li><a href="<?=base_url();?>home/contact">Contact</a></li>
                       </ul>
                   </nav>
               </div>
           </div>
       </div>
       <!--End Footer-Wrap-->
   </div>

   <div class="fw-slider-spacer"></div>

   <!-- Libs -->

   <script src="<?= base_url(); ?>assets/template/js/popper.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/bootstrap.min.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.flexslider-min.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.easing.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.fitvids.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.carouFredSel.min.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.validate.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/theme-plugins.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/jquery.isotope.min.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/imagesloaded.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/view.min9df2.js?auto"></script>
   <script src="<?= base_url(); ?>assets/template/plugins/aos/aos.js"></script>

   <script src="<?= base_url(); ?>assets/template/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
   <script src="<?= base_url(); ?>assets/template/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

   <script src="<?= base_url(); ?>assets/template/js/theme-core.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/theme.js"></script>
   <script src="<?= base_url(); ?>assets/template/js/theme.init.js"></script>
</body>

<!-- Mirrored from bootstraptemplates.net/vertex/index-11.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:30:54 GMT -->
</html>

<?php $this->view("site/theme1/requires/cart_modal"); ?>
<?php $this->view("site/theme1/requires/login_modal"); ?>
<?php $this->view("site/theme1/requires/register_modal"); ?>

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
