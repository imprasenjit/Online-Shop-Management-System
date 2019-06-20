
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h5>Home page slider</h5>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
          <tr><td>Description</td><td><?php echo $description; ?></td></tr>
          <tr><td>Image</td><td><img src="<?php echo base_url($picture) ?>" style="width:200px;height:170px;"></td></tr>
          <tr><td><a href="<?php echo site_url('admin/home_page_slider') ?>" class="btn btn-info btn-sm">Cancel</button></td><td></td></tr>
        </table>
        </div>
      </div>

    </div>
