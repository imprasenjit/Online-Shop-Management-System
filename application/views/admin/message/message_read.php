	
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-status-wrap">
                        <h4 align="center">Message Details</h4>
						<table class="table">
							<tr><td>To</td><td><?php echo $send_to; ?></td></tr>
							<tr><td>Subject</td><td><?php echo $subject; ?></td></tr>
							<tr><td>Message</td><td><?php echo $message; ?></td></tr>
							<tr><td></td><td><a href="<?php echo site_url('admin/message') ?>" class="btn btn-default">Cancel</button></td></tr>
						</table>
					</div>
				</div>
            </div>
        </div>
    </div>
       