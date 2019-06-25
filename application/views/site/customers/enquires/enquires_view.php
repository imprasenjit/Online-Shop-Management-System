    <div class="row profile">
    	<div class="col-md-2">
    		<?php $this->load->view("site/customers/dashboard/profile"); ?>
    	</div>
    	<div class="col-md-10" style="margin-top:10px;">
    		<?php echo $this->breadcrumbs->show(); ?>
    		<div class="panel panel-default" style="margin-top:10px;">
    			<div class="panel-heading">
    				<?php
					$enquiry_id = base64_decode(urldecode($this->uri->segment(4)));
					$enquiry_details = $this->enquires_model->get_by_id($enquiry_id);
					?>
    				<h5><strong>Enquiry Information </strong></h5>
    			</div>
    			<div class="panel-body">
            <h5>Enquiry No : <?php echo $enquiry_details->unique_id; ?></h5>
            <br/>
            <h5>Enquiry Date:<?php echo date("d-m-Y h:i A",strtotime($enquiry_details->enquiry_placed_date)); ?></h5>
            <br/>
    				<h5>Billing Address: <?= $enquiry_details->state; ?></h5>
    				<br />
    				<div class="table-responsive">
    					<?php
						$order_detail_id = base64_decode(urldecode($this->uri->segment(4)));
						$results = $this->enquires_model->get_product_details($order_detail_id);
						$s = 1;
						if ($results) {
							?>
    						<table class="table table-striped table-bordered table-hover">
    							<thead>
    								<tr>
    									<th>Sl No.</th>
    									<th>Product Name</th>
    									<th>Quantity</th>
    									<th>Attributes</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
									foreach ($results as $products) {
										$product_id = $products->productid;
										$productname = $this->products_model->get_by_id($products->productid)->product_name;
										//$productid = $products->productid;
										$quantity = $products->quantity;
										$attributes = $products->attributes;
										?>
    									<tr>
    										<td class="text-left"><?= $s; ?></td>
    										<td class="text-left"><?= $productname; ?></td>
    										<td class="text-left"><?= $quantity; ?></td>
    										<td class="text-left">
    											<?php
												if ($attributes != "") {
													$attributes_decoded = json_decode($attributes, true);
													$sl = 1;
													foreach ($attributes_decoded["attributes"] as $key => $values) {
														if ($values[0] != "") {
															echo $values[0];
															echo " : ";
															echo $values[1];
															echo "<br/>";
														}
													}
												}
												?>
    										</td>
    									</tr>
    									<?php
										$s++;
									}
									?>
    							</tbody>
    						</table>
    					<?php } else {   ?>
    						<h3>No records found! Try again.</h3>
    					<?php }   ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
