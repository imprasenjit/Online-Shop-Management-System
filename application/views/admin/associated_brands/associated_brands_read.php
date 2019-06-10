
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Associated Brands</h6>
                        <div class="dropdown no-arrow">
                            <a class="btn btn-outline-primary btn-sm" href="<?=base_url();?>admin/associated_brands/create" role="button">
                                <i class="fas fa-plus fa-sm"></i> Add New Associated Brands
                            </a>
                            <!--
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
								<div class="dropdown-header">Dropdown Header:</div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                                
                            </div>-->
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
          <table class="table table-borderless">
          <tr><td>name</td><td><?php echo $name; ?></td></tr>
          <tr><td>description</td><td><?php echo $description; ?></td></tr>
          <tr><td>Picture</td><td><img src="<?php echo base_url($picture); ?>" style="width:80px;height:50px;"></td></tr>
          <tr><td><a href="<?php echo site_url('admin/associated_brands') ?>" class="btn btn-info btn-sm">Cancel</button></td><td></td></tr>
        </table>
        </div>
      </div>

    </div>
