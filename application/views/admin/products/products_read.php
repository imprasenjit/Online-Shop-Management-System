
                  <div class="container-fluid">
                      <div class="mb-4">
                          <?= $this->breadcrumbs->show(); ?>
                      </div>
                      <div class="row">

              <div class="col-xl-12 col-lg-12">
                  <div class="card shadow mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                          <div class="dropdown no-arrow">
                              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">

                              </div>
                          </div>
                      </div>
                      <!-- Card Body -->
              <div class="card-body">
            
                  <table class="table table-borderless">
                    <tr><td width="30%">Product Name</td><td width="60%"><?php echo $product_name; ?></td></tr>
                    <tr><td>Product Category</td><td><?php echo $product_category; ?></td></tr>
                    <tr><td>Product Sub-Category</td><td><?php echo $product_sub_category; ?></td></tr>
                    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
                    <tr><td>Specification</td><td><?php echo $specification; ?></td></tr>
                    <tr><td>Attributes</td><td><?php  echo $attributes; ?></td></tr>
                    <tr><td>Tax Rate</td><td><?php  echo $tax_rate; ?></td></tr>
                    <tr><td>HSN Code</td><td><?php  echo $hsn_code; ?></td></tr>
                    <tr><td>Weight Chart</td><td><?php  echo $weight_chart; ?></td></tr>
                    <tr><td>Picture</td><td><img src="<?php echo $picture ?>" width="50px"></td></tr>
                    <tr><td><a href="<?php echo site_url('admin/products') ?>" class="btn btn-info btn-sm">Cancel</button></td><td></td></tr>

                  </table>
                </div>
              </div>

            </div>
