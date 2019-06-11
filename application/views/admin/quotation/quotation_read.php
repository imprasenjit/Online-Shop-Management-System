            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-status-wrap">
                            <h4 align="center" style="margin-bottom:50px;">Quotation Details</h4>
						<?php
							$email=$send_to;
							$quotation_id=$this->uri->segment(4);
							$quotation_details=$this->quotation_model->get_by_id($quotation_id);
							$order_detail = $this->orders_model->get_by_id($quotation_details->enquiry_id);
						?>
							<table class="table">
								<tr><td>Customer Name</td><td><?php echo $order_detail->name; ?></td></tr>
								<tr><td>To</td><td><?php echo $quotation_details->send_to; ?></td></tr>
								<?php $enq_unique_id = $this->orders_model->get_enquiry_details2($enquiry_id)->unique_id; ?>
								<tr><td>Enquiry No.</td><td><?php echo $enq_unique_id; ?></td></tr>
							</table>
							<div class="table-responsive">
								<table class="table table-hover" id="quotation" style="width:100%">
									<thead>
										<tr>
											<th width="10%">Sl No.</th>
											<th width="20%">Product Name</th>
											<th width="20%">Quantity</th>
											<th width="30%">Attributes</th>
											<th width="20%">Quoted Price of <br />the Product (in Rs.)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$quotation_id = $this->uri->segment(4);
										$results= $this->quotation_model->get_by_price($id);
										$sl = 0;
										if ($results) {
											foreach ($results as $row) {
												$id = $row->id;
												$product_id = $row->productid;
												$productname = $this->products_model->get_by_id($product_id)->product_name;
												$quantity = $row->quantity;
												$attributes = $row->attributes;
												$product_price = $row->product_price;
										?>
										<tr>
											<td class="text-left"><?= $sl+1; ?></td>
											<td class="text-left"><?= $productname; ?></td>
											<td class="text-left"><?= $quantity; ?></td>
											<td class="text-left"><?php
												if($attributes!=""){
													$attributes_decoded=json_decode($attributes,true);
													$sl=1;
														foreach ($attributes_decoded["attributes"] as $key=>$values) {
															if($values[0]!=""){
																echo $values[0];
																echo " : ";
																echo $values[1];
																echo "<br/>";
															}
														}
												}
											?>
											</td>
											<td class="text-left"><?= $product_price; ?></td>
										</tr>
										<?php
											$sl++;
											}
										}
									   ?>
									</tbody>
								</table>
							</div>
							<div align="center">
							<a href="<?= base_url();?>admin/quotation"><input type="button" class="btn btn-danger" value="Cancel"></a>
							</div>
						</div>
                    </div>
                </div>
            </div>
    </div>
