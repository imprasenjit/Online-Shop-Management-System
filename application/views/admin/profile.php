
<div class="container-fluid">
  <div class="mb-4">
  </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
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
          <div class="row">
            <div class="col-md-4">
              <div class=" col-md-12 text-center">
                 <img src="<?=base_url()?>assets/images/img_avatar.png" class="rounded-circle" alt="Cinque Terre" width="236" height="236">
              </div>
            </div>
            <div class="col-md-8">
              <div class=" col-md-12 ">
                  <label><h3><?php if(isset($logged_data->username)) echo $logged_data->username; ?></h3></label>

              </div>
              <div class="col-md-12">
                <label><?php if(isset($logged_data->name)) echo "Name: ".$logged_data->name; ?></label>
              </div>
              <div class="col-md-12">
              <label><?php if(isset($logged_data->address)) echo "Address: ".$logged_data->address; ?></label>
              </div>
              <div class="col-md-12">
              <label><?php if(isset($logged_data->state)) echo "State: ".$logged_data->state; ?></label>
              </div>
              <div class=" col-md-12 ">
                  <a href="<?php echo base_url()?>admin/login/change_password" class="btn btn-primary btn-sm">Change Password</a>
              </div>
            </div>


  			</div>
  		</div>
    </div>
   </div>
	</div>
