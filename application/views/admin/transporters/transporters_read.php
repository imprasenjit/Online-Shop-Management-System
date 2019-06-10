<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Transporter View</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Transporter_id</td>
                            <td><?php echo $transporter_id; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $transporter_name; ?></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td><?php echo $transporter_mobile; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $transporter_address; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $transporter_address; ?></td>
                        </tr>
                        <tr>
                            <td>GST</td>
                            <td><?php echo $transporter_gst; ?></td>
                        </tr>
                    </table>
                </div>
              <div class='card-footer'>
              <a href="<?php echo site_url('admin/transporters') ?>" class="btn btn-sm btn-primary">Close</a>
              </div>                
            </div>
        </div>
    </div>
</div>

