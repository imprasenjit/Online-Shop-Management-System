<div class="container-fluid">
    <div class="mb-4">
      <?=$this->breadcrumbs->show();?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Suppliers View</h6>
                </div>
                <div class="card-body">
      <table class="table table-bordered table-striped">
          <tr>
              <td>supplier_id</td>
              <td><?php echo $supplier_id; ?></td>
          </tr>
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
              <td>State</td>
              <td><?php echo $state; ?></td>
          </tr>
      </table>
    </div>
    <div class="card-footer">
    <a href="<?php echo site_url('admin/suppliers') ?>" class="btn btn-info btn-sm">Close</a>
    </div>
  </div>

</div>
</div>
</div>
