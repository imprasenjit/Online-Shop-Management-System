<div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sub Category View</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered">
						<tr><td>Category</td><td><?php echo $this->category_model->get_by_id($category)->category_name?></td></tr>
						<tr><td>Sub-Category</td><td><?php echo $sub_category; ?></td></tr>
						<tr><td>Description</td><td><?php echo $description; ?></td></tr>
						<tr><td>Picture</td><td><img src="<?php echo base_url($picture); ?>" style="width:80px;height:50px;"></td></tr>
					</table>
				
            </div>
            <div class="card-footer">
            <a href="<?php echo site_url('admin/sub_category') ?>" class="btn btn-sm btn-primary">Close</a>
            </div>
        </div>
    </div>
</div>
</div>
						
    