
            <div class="container-fluid">
              <div class="card">
        				<div class="card-header">
        					<h5>Attribute Details</h5>
        				</div>
        				<div class="card-body">
                  <table class="table table-borderless">
    							<?php

    								$productname = $this->products_model->get_by_id($product_id)->product_name;
    							?>
    								<!--<tr><td>Sl No</td><td><?php echo $id; ?></td></tr>-->
    								<tr><td>Product </td><td><?php echo $productname; ?></td></tr>
    								<tr><td>Attribute 1</td><td><?php echo $attr1; ?></td></tr>
    								<tr><td>Attribute 2</td><td><?php echo $attr2; ?></td></tr>
    								<tr><td>Attribute 3</td><td><?php echo $attr3; ?></td></tr>
    								<tr><td>Attribute 4</td><td><?php echo $attr4; ?></td></tr>
    								<tr><td>Attribute 5</td><td><?php echo $attr5; ?></td></tr>
    								<tr><td>Attribute 6</td><td><?php echo $attr6; ?></td></tr>
    								<tr><td>Attribute 7</td><td><?php echo $attr7; ?></td></tr>

    								<tr><td><a href="<?php echo site_url('admin/attribute') ?>" class="btn btn-info">Cancel</button></td><td></td></tr>
    							</table>
                </div>
              </div>

        </div>
