<div class="container-fluid">
    <!-- Page Heading -->
    <div class="mb-4">
<?=$this->breadcrumbs->show();?>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Suppliers</h6>
                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <form action="<?php echo $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Name <?php echo form_error('name') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $name; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Mobile <?php echo form_error('mobile') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" value="<?php echo $mobile; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Address <?php echo form_error('address') ?></label>
                                    <input type="text" class="form-control form-control-sm" name="address" id="address" value="<?php echo $address; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="state">State <?php echo form_error('state') ?></label>
                                    <select class="form-control form-control-sm" name="state" id="state">

                                        <?php $states = $this->suppliers_model->get_all_states();
                                        foreach ($states as $state_detail) { ?>
                                            <option value="<?= $state_detail->state_name; ?>" <?= (trim($state_detail->state_name) == trim($state)) ? "selected" : ""; ?>><?= $state_detail->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php if ($username == "") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Username<?php echo form_error('username') ?></label>
                                        <input type="text" class="form-control form-control-sm" name="username" id="username" value="<?php echo $username; ?>" />
                                    </div>
                                <?php } else { ?>
                                    Username :<?= $username; ?><br />
                                    Username cant be changed.

                                <?php } ?>
                                <div class="form-group">
                                    <label for="varchar">Password <?php echo form_error('password') ?></label>
                                    <input type="password" class="form-control form-control-sm" name="password" id="password" value="<?php echo $password; ?>" />
                                </div>

                                <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
                                <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                                <a href="<?php echo site_url('admin/suppliers') ?>" class="btn btn-info btn-sm">Close</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
