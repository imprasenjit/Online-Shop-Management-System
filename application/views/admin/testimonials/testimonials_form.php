<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Suppliers</h6>
                </div>
                <form action="<?php echo $action; ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group">
                                    <label for="varchar">Name <?php echo form_error('name') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $name; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Email <?php echo form_error('email') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="email" id="email" value="<?php echo $email; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Contact <?php echo form_error('contact') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="contact" id="contact" value="<?php echo $contact; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Address <?php echo form_error('address') ?></label>
                                    <textarea type="text" class="form-control form-control-sm" name="address" id="address"><?php echo nl2br($address); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Message <?php echo form_error('message') ?></label>
                                    <textarea type="text" class="form-control form-control-sm" name="message" id="message" ><?php echo nl2br($message); ?></textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>" />
                        <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                        <a href="<?php echo site_url('admin/testimonials') ?>" class="btn btn-info btn-sm">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>