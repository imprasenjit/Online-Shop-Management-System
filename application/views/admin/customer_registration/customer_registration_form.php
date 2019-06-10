<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Customer</h6>
                </div>
                <!-- Card Body -->
                <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                        <div class="row">
                            <div class=" col-md-6 form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="" value="<?php echo $name; ?>" />
                                <?php echo form_error('name') ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address<span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control form-control-sm" name="address" id="address"><?php echo $address; ?></textarea>
                                <?php echo form_error('address') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6 form-group">
                                <label>Contact No.<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="contact" id="contact" placeholder="" value="<?php echo $contact; ?>" maxlength="10" />
                                <?php echo form_error('contact') ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="" <?php if (!empty($email)) { ?>readonly title="Email can't be changed" <?php } ?> value="<?php echo $email; ?>" autocomplete="off" />
                                <?php echo form_error('email') ?>
                            </div>
                        </div>
                        <div class="row">
                                <div class=" col-md-6 form-group">
                                    <label>GST No.</label>
									<input type="text" class="form-control form-control-sm" name="gst_no" id="gst_no" placeholder="" value="<?php echo $gst_no; ?>" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>PAN No.</label>
									<input type="text" class="form-control form-control-sm" name="pan_no" id="pan_no" placeholder="" value="<?php echo $pan_no; ?>" />
                                </div>
                            </div>
                        <div class="row">
                            <div class=" col-md-6 form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="" value="<?php echo $password; ?>" />
                                <?php echo form_error('password') ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-sm" name="cpassword" id="cpassword" placeholder="" value="<?php echo $password; ?>" />
                                <?php echo form_error('cpassword') ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                </div>
                <div class="card-footer">
                <a href="<?php echo site_url('admin/customers') ?>" class="btn btn-info btn-sm">Close</a>
                            <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                </div>
                </form>
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