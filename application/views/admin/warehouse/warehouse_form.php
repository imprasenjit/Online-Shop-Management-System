<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Warehouse user</h6>
                </div>
                <form action="<?php echo $action; ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group">
                                    <label for="varchar">Name <?php echo form_error('name') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="" value="<?php echo $name; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Mobile <?php echo form_error('mobile') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="" value="<?php echo $mobile; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Address <?php echo form_error('address') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="address" id="address" placeholder="" value="<?php echo $address; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Username<?php echo form_error('username') ?></label>
                                    <?php if (empty($username)) { ?>
                                        <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="" value="<?php echo $username; ?>" />
                                    <?php } else { ?>
                                        :<?= $username; ?><br />
                                        Username cant be changed.
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Password<?php echo form_error('password') ?></label>
                                    <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="" value="<?php echo $password; ?>" />
                                </div>
                                <input type="hidden" name="warehouse_user_id" value="<?php echo $warehouse_user_id; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class='card-footer'>
                        <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                        <a href="<?php echo site_url('admin/warehouse') ?>" class="btn btn-info btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>