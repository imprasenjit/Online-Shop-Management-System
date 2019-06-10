
          <div class="container-fluid">
            <div class="mb-4">
                <?=$this->breadcrumbs->show();?>
            </div>
              <div class="row">
                  <div class="col-xl-12 col-lg-12">
                      <div class="card shadow mb-4">
                          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">Warehouse Details</h6>
                              <div class="dropdown no-arrow">
                                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <!--<div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#">Something else here</a>
                                      -->
                                  </div>
                              </div>
                          </div>
                          <!-- Card Body -->
                          <div class="card-body">

                                <table class="table table-borderless">
                                    <tr>
                                        <td>name</td>
                                        <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>mobile</td>
                                        <td><?php echo $mobile; ?></td>
                                    </tr>
                                    <tr>
                                        <td>username</td>
                                        <td><?php echo $username; ?></td>
                                    </tr>
                                    <tr>
                                        <td>address</td>
                                        <td><?php echo $address; ?></td>
                                    </tr>
                                    <tr>

                                        <td><a href="<?php echo site_url('admin/warehouse') ?>" class="btn btn-info btn-sm">Close</button></td>  <td></td>
                                    </tr>
                                </table>
                    </div>
      </div>

  </div>
