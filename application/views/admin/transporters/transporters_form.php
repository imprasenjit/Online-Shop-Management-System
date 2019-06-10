<div class="container-fluid">
    <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Transporters</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php //echo validation_errors(); ?>
                    <?php if ($this->session->flashdata("message")) { ?>
                        <div class="alert alert-<?= $this->session->flashdata("message_type") ?> alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <?= $this->session->flashdata("message") ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <form action="<?php echo $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Name <?php echo form_error('transporter_name') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="transporter_name" id="transporter_name" value="<?php echo $transporter_name; ?>" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="varchar">Mobile <?php echo form_error('transporter_mobile') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="transporter_mobile" id="transporter_mobile" value="<?php echo $transporter_mobile; ?>" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="varchar">Email<?php echo form_error('transporter_email') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="transporter_email" id="transporter_email" value="<?php echo $transporter_email; ?>" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="varchar">Address <?php echo form_error('transporter_address') ?></label>
                                    <textarea name="transporter_address" class="form-control form-control-sm"><?=$transporter_address?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="transporter_gst">GST <?php echo form_error('transporter_gst') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="transporter_gst" id="transporter_address" value="<?php echo $transporter_gst; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Password <?php echo form_error('transporter_pass') ?></label>
                                    <input type="transporter_pass" class="form-control form-control-sm" name="transporter_pass" id="transporter_pass" value="<?php echo $transporter_pass; ?>" />
                                </div>

                                <input type="hidden" name="transporter_id" value="<?php echo $transporter_id; ?>" />
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                <a href="<?php echo site_url('admin/transporters') ?>" class="btn btn-default">Close</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>