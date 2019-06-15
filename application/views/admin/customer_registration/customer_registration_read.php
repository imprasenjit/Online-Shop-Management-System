<div class="container-fluid">
	<div class="mb-4">
		<?= $this->breadcrumbs->show(); ?>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
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
						<div class="col-md-12">
							<div class="product-status-wrap">

								<table class="table table-striped table-bordered">
									<tr>
										<td>Name</td>
										<td><?php echo $name; ?></td>
									</tr>
									<tr>
										<td>Address</td>
										<td><?php echo nl2br($address); ?></td>
									</tr>
									<tr>
										<td>Contact</td>
										<td><?php echo $contact; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php echo $email; ?></td>
									</tr>
									<tr>
										<td>GSTIN</td>
										<td><?php echo $gst_no; ?></td>
									</tr>
									<tr>
										<td>PAN</td>
										<td><?php echo $pan_no; ?></td>
									</tr>
									<tr>
										<td>Registration Date</td>
										<td><?php echo date("d-m-Y h:i A", strtotime($reg_date)); ?></td>
									</tr>
									<?php if($additional_address){
										foreach ($additional_address as $key => $value) { ?>
											<tr>
												<td><?php if($value->address_type=="delivery_address"){
														echo "Delivery Address";
												}elseif ($value->address_type=="billing_address") {
												 		echo "Billing Address";	
												}?></td>
												<td><?=$value->address;?></td>
											</tr>
										<?php }
										}?>
								</table>

							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php echo site_url('admin/customers/update/'.$id) ?>" class="btn btn-sm btn-warning">Edit</a>
					<a href="<?php echo site_url('admin/customers') ?>" class="btn btn-sm btn-info">Close</a>
				</div>
			</div>

		</div>
	</div>
