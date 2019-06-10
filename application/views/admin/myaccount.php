
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="product-status-wrap">
                <h4 align="center" >Update My Account</h4>
				  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="myform">
					
						<div class="row">
							
								<div class=" col-md-12">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" />
								</div>
							</div>
						</div>
						<div class="row">
							
								<div class="col-md-12">
								<div class="form-group">
									<label>New Password</label>
									<input type="text" class="form-control" name="password" id="password" value="" placeholder="Enter new password:"  required="required"/>
								</div>
							</div>
						</div>
						
						
						<br>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div align="center">
							<a href="<?php echo site_url('admin/dashboard') ?>" class="btn btn-default">Cancel</a>
							<button type="submit" class="btn btn-primary">Update</button> 
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
						