<div class="">
	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="panel-group" style="margin-top:50px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						Send Purchase order <span class="pull-right"> Quotation ID : <?= $quotation_id ?></span>
					</div>
					<div class="panel-body">
						<form method="post" id="send_purchase_order_form" action="<?= base_url("customers/dashboard/send_po") ?>">
							<?= validation_errors(); ?>
							<?php
							$row = $this->quotation_model->get_by_id($quotation_id);
							$result = $this->enquires_model->get_by_id($row->enquiry_id);
							if ($row) {
								$i = 1;
								?>
								<input type="hidden" name="quotation_id" value="<?= $quotation_id ?>">
								<br />
								To,<br />
								Hitech Industries<br />
								Guwahati<br />
								Subject: Purchase Order<br />
								Terms &amp; Conditions valid as per quotation received.<br /><br />
								<h5>Billing State : <?= $result->state; ?></h5>
								<input type="hidden" name="billing_state" value="<?= $result->state;?>">
								<br />
								<table name="objectTable1" id="objectTable1" class="table table-bordered">
									<thead>
										<tr>
											<th width="2%">(#)</th>
											<th width="10%">Product Name</th>
											<th width="10%">Quantity</th>
											<th width="20%">Attributes</th>
											<th width="10%">Basic Price(in Rs.)</th>
											<th width="20%">Required Details</th>
											<th width="3%">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sl = 1;
										$quotation_id = $row->quotation_id;
										$enquiry_id = $row->enquiry_id;
										$productid = $row->productid;
										$quantity = $row->quantity;
										$attributes = $row->attributes;
										$product_price = $row->product_price;
										$cgst = $row->cgst;
										$sgst = $row->sgst;
										$igst = $row->igst;
										$exyard = $row->exyard;
										$frieght = $row->frieght;
										$email = $row->email;
										$editordata = $row->editordata;
										$editordata2 = $row->editordata2;
										$product_id_decoded = json_decode($productid, true);
										$quantity_decoded = json_decode($quantity, true);
										$product_unit_decoded = json_decode($row->product_unit, true);
										$attributes_decoded = json_decode($attributes, true);
										$product_price_decoded = json_decode($product_price, true);
										$cgst_decoded = json_decode($cgst, true);
										$sgst_decoded = json_decode($sgst, true);
										$igst_decoded = json_decode($igst, true);
										$exyard_decoded = json_decode($exyard, true);
										$frieght_decoded = json_decode($frieght, true);
										$others = json_decode($row->others, true);
										$tax_rate = json_decode($row->tax_rate, true);
										$total = json_decode($row->total, true);
										foreach ($product_id_decoded as $key => $product) {
											$productname = $this->products_model->get_by_id($product)->product_name;
											?>
											<tr>
												<td class="text-left"><?= $sl; ?></td>
												<td class="text-left">
													<?= $productname; ?>
													<input type="hidden" name="product_id[]" value="<?= $product ?>">
												</td>
												<td class="text-left">
													<input type="text" class="col-md-6 padding-zero quantity_cal" name="quantity[]" value="<?= $quantity_decoded[$key]; ?>">
													<input type="text" class="col-md-6 padding-zero" name="product_unit[]" value="<?= $product_unit_decoded[$key]; ?>" readonly>
												</td>
												<td class="text-left attribute_place">
													<?php
													foreach ($attributes_decoded[$key] as $product_key => $attr) {
														$attr_values="";
														$attributes_from_product = $this->products_model->get_by_id($product_key)->attributes;
														$attributes_from_product_decoded = json_decode($attributes_from_product, true);
														foreach ($attributes_from_product_decoded["data"] as $keyattr => $values) {
															echo $values . ' : ' . $attr[$keyattr] . '<br/>';
															$attr_values.=htmlspecialchars($attr[$keyattr],ENT_QUOTES).",";
														}
														echo '<input type="hidden" name="product_attr[]" value="'.$attr_values.'">';
													}
													?>
													Others: <input type="text" class="others" name="others[]" value="<?= $others[$key] ?>" readonly />
												</td>
												<td class="text-left">
													<label>Basic Price</label>
													<input type="text" class="form-control price_cal" name="product_price[]" value="<?= $product_price_decoded[$key] ?>" readonly /><br />
													<label>Tax Rate</label>
													<input type="text" class="form-control tax_rate" name="tax_rate[]" value="<?= $tax_rate[$key]; ?>" readonly />
												</td>
												<td class="text-left">
													CGST:
													<input type="text" class="my-form cgst_cal" name="cgst[]" placeholder="CGST @9%" value="<?php echo $cgst_decoded[$key]; ?>" readonly />
													<hr />
													SGST<input type="text" class="my-form sgst_cal" name="sgst[]" placeholder="SGST @9%" value="<?php echo $sgst_decoded[$key]; ?>" readonly />
													<hr />
													<input type="hidden" name="state" class="state_val" value="<?= $result->state ?>">
													IGST<input type="text" class="my-form igst_cal" name="igst[]" placeholder="IGST @18%" value="<?php echo $igst_decoded[$key]; ?>" readonly />
													<hr />
													Ex-yard<input type="text" class="my-form  exyard_cal" name="exyard[]" placeholder="Ex-Yard (in Rs./MT)" value="<?= $exyard_decoded[$key] ?>" readonly />
													<hr />
													Frieght<input type="text" class="my-form frieght_cal" name="frieght[]" placeholder="Frieght (Cost/MT)" value="<?= $frieght_decoded[$key] ?>" readonly />
													<hr />
													Total<input type="text" class="my-form  total_price_cal" name="total_price[]" placeholder="Total Price (in Rs.)" value="<?= $total[$key] ?>" readonly />
												</td>
												<td class="text-left"><a href="#!" class="btn btn-danger remove_tr"><i class="fa fa-times-circle"></i></a>
												</td>
											</tr>
											<?php
											$sl++;
										}
										?>
									</tbody>
									<script>
										$(document).ready(function() {
											$(document).on("click", ".remove_tr", function() {
												$(this).parent().parent().remove();
											});
											//alert("d");
											$(document).on('keyup', '.quantity_cal', function() {
												var qty = $(this).parent().parent().children().children('.quantity_cal').val();
												var basic_price = $(this).parent().parent().children().children('.price_cal').val();
												var tax_rate = $(this).parent().parent().children().children('.tax_rate').val();
												var state_gst = parseFloat(tax_rate) / 2;
												var price = parseInt(qty) * basic_price;
												console.log("qty" + qty);
												console.log("basic_price" + basic_price);
												console.log("tax_rate" + tax_rate);
												console.log("state_gst" + state_gst);
												console.log("price" + price);

												var cgst = Math.ceil(price * (parseFloat(state_gst) / 100));
												var sgst = Math.ceil(price * (parseFloat(state_gst) / 100));
												var igst = Math.ceil(price * (parseInt(tax_rate) / 100));
												var state=$(this).parent().parent().children().children('.state_val').val();
												if (state == "assam") {
													$(this).parent().parent().children().children('.cgst_cal').val(cgst);
													$(this).parent().parent().children().children('.sgst_cal').val(sgst);
													$(this).parent().parent().children().children('.igst_cal').val(0);
													var exyard = price + cgst + sgst;
												} else {
													$(this).parent().parent().children().children('.igst_cal').val(igst);
													$(this).parent().parent().children().children('.cgst_cal').val(0);
													$(this).parent().parent().children().children('.sgst_cal').val(0);
													var exyard = price + igst;
												}
												$(this).parent().parent().children().children('.exyard_cal').val(exyard);
												var frieght = $(this).parent().parent().children().children('.frieght_cal').val();
												var total_price = Math.ceil(parseFloat(exyard) + parseFloat(frieght));
												total_price = isNaN(total_price) ? 0 : total_price;
												$(this).parent().parent().children().children('.total_price_cal').val(total_price);
											});
										});
									</script>
								</table>
								<?php
								$i++;
							}
							?>
							<div class="form-group" id="adrress_display">


							</div>
							<div class="form-group col-md-6">
								<label for="billing_address">Select A Billing Address</label>
								<?php if($customer_address){
									foreach ($customer_address as $key => $address) { ?>
										<div class="row">
										<div class="col-md-1"><input type="radio" name="billing_address_selector" data-billing_address="<?=$address->address;?>" value="<?=$address->address_id;?>"></div>
										<div class="col-md-11"><?=$address->address;?></div>
										<!-- <div class="col-md-3"></div> -->
										</div>
									<?php }
								} ?>
							</div>
							<div class="form-group col-md-6">
								<label for="billing_address">Select A Delivery Address</label>
								<?php if($customer_address){
									foreach ($customer_address as $key => $address) { ?>
										<div class="row">
										<div class="col-md-1"><input type="radio" name="delivery_address_selector" data-delivery_address="<?=$address->address;?>" value="<?=$address->address_id;?>"></div>
										<div class="col-md-11"><?=$address->address;?></div>
										<!-- <div class="col-md-3"></div> -->
										</div>
									<?php }
								} ?>
							</div>
							<div class="form-group col-md-6">
								<label for="billing_address">Billing Address</label>
								<textarea name="billing_address" class="form-control " id="textarea_billing_address" row="4"></textarea>
							</div>
							<div class="form-group col-md-6">
								<label for="delivery_address">Delivery Address</label>
								<textarea name="delivery_address" class="form-control " id="textarea_delivery_address" row="4"></textarea>
							</div>
							<div class="form-group col-md-6">
								<label for="contact_person_name">Contact Person Name</label>
								<input type="text" name="contact_person_name" class="form-control " >
							</div>
							<div class="form-group col-md-6">
								<label for="contact_person_mobile">Mobile</label>
								<input type="text" name="contact_person_mobile" class="form-control " >
							</div>
							<div class="form-group col-md-12">
								<a href="#!" class="btn btn-warning" id="submitBtn">Send Purchase order</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Confirm Submit
			</div>
			<div class="modal-body">
				Are you sure you want to send the purchase order?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a href="#" id="submit" class="btn btn-success success">Submit</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#submitBtn').click(function() {
			$("#confirm-submit").modal("show");
		});
		$('#submit').click(function() {
			console.log("submitting");
			$('#send_purchase_order_form').submit();
		});
		$("input[name='billing_address_selector']").click(function(){
			$("#textarea_billing_address").val($(this).data('billing_address'));
		});
		$("input[name='delivery_address_selector']").click(function(){
			$("#textarea_delivery_address").val($(this).data('delivery_address'));
		});
	});
</script>
