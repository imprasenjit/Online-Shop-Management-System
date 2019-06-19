<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Purchse Order Details from customer</h6>
				</div>
				<div class="card-body">
					From:<br />
					<?php
					$customer = $this->customers_model->get_by_id($purchase_order["customer_id"]);
					echo $customer->name . "<br/>";
					echo $customer->contact . "<br/>";
					echo $customer->email . "<br/>";
					echo $customer->address . "<br/>";

					$product = array(
						"productid" => $purchase_order["product"],
						"others" => $purchase_order["others"],
						"quantity" => $purchase_order["quantity"],
						"product_unit" => $purchase_order["unit"],
						"tax_rate" => $purchase_order["tax_rate"],
						"attributes" => $purchase_order["attributes"],
						"product_price" => $purchase_order["price"],
						"cgst" => $purchase_order["cgst"],
						"sgst" => $purchase_order["sgst"],
						"igst" => $purchase_order["igst"],
						"exyard" => $purchase_order["exyard"],
						"frieght" => $purchase_order["frieght"],
						"total" => $purchase_order["total"],
					);
					$this->load->view("admin/products/product_table_format", array("product" => (object)$product));
					$product_id_s = json_decode($purchase_order["product"], true);
					$quantity_decoded = json_decode($purchase_order["quantity"], true);
					$product_unit_decoded = json_decode($purchase_order["unit"], true);
					$attributes_decoded = json_decode($purchase_order["attributes"], true);
					$others_decoded = json_decode($purchase_order["others"], true);
					$product_price_decoded = json_decode($purchase_order["price"], true);
					$tax_rate_decoded = json_decode($purchase_order["tax_rate"], true);
					$cgst_decoded = json_decode($purchase_order["cgst"], true);
					$sgst_decoded = json_decode($purchase_order["sgst"], true);
					$igst_decoded = json_decode($purchase_order["igst"], true);
					$exyard_decoded = json_decode($purchase_order["exyard"], true);
					$frieght_decoded = json_decode($purchase_order["frieght"], true);
					$total_decoded = json_decode($purchase_order["total"], true);
					?>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Purchse Order to supplier details</h6>
				</div>
				<div class="card-body">
					<form class="form-horizontal" action="<?= base_url("admin/purchase_orders/purchase_order_to_supplier_action/"); ?>" method="post" id="myform">
						<div class="row">
							<div class="col-md-12 text-right">
								<label for="varchar">Date. <?php echo date("d-m-Y"); ?> </label><br />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Select Supplier</label>
									<input type="text" class="form-control form-control-sm" name="send_to_autocomplete" id="send_to_autocomplete" placeholder="Type Supplier Name" />
									<input type="hidden" name="supplier_id" id="supplier_id" value="">
									<span id="supplier_details"></span>
								</div>
							</div>
						</div>

						<table name="objectTable1" id="objectTable1" class="table table-bordered">
							<thead>
								<tr>
									<th width="2%">(#)</th>
									<th width="10%">Product Name</th>
									<th width="15%">Quantity</th>
									<th width="20%">Attributes</th>
									<th width="10%">Basic Price</th>
									<th width="20%">Required Details</th>
									<th width="5%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$slnew = 1;
								foreach ($product_id_s as $key => $product) {
									$id = $product;
									$product_details = $this->products_model->get_by_id($product);
									?>
									<tr>
										<td class="text-left">
											<?= $slnew; ?>
										</td>
										<?php $product_id = $this->products_model->get_all(); ?>
										<td class="text-left">
											<select class="form-control form-control-sm product_select_option" name="product_id[]">
												<option>Please Select</option>
												<?php foreach ($product_id as $p) { ?>
													<option value="<?= $p->id ?>" <?= ($p->id == $product) ? "selected" : ""; ?>><?= $p->product_name ?></option>
												<?php } ?>
											</select>
										</td>
										<td class="text-left">
											<input type="text" style="float:left;width:40% !important;" class="form-control form-control-sm quantity_cal" name="quantity[]" value="<?= $quantity_decoded[$key]; ?>">
											<select style="width:50% !important;" class="form-control form-control-sm" name="product_unit[]">
												<option value="MT" <?= ($product_unit_decoded[$key] == "MT") ? "selected" : ""; ?>>MT</option>
												<option value="KG" <?= ($product_unit_decoded[$key] == "KG") ? "selected" : ""; ?>>KG</option>
												<option value="Pcs" <?= ($product_unit_decoded[$key] == "Pcs") ? "selected" : ""; ?>>Pcs</option>
											</select>
										</td>
										<td class="text-left">
											<span class="attribute_place">
												<?php
												$i = 1;
												?>
												<?php
												//echo '<pre>';
												$attr_values = $attributes_decoded[$key][$product];
												$attributes_from_product = $product_details->attributes;
												//print_r($attributes_from_product);
												$attributes_from_product_decoded = json_decode($attributes_from_product, true);
												$sl_count = 0;
												foreach ($attr_values as $key_new => $value_attr) {
													$atr = "attr" . ($key_new + 1);
													$attribute_value = $this->attribute_model->get_attribute_value($product, $atr);
													echo $attributes_from_product_decoded["data"][$key_new];
													?>
													<select class="form-control form-control-sm attr_values" name="product_attr[]">
														<option>Please Select</option>
														<?php foreach ($attribute_value as $value) { ?>
															<option value="<?= $value->attr_value; ?>" <?= ($value_attr == $value->attr_value) ? "selected" : ""; ?>><?= $value->attr_value ?>
															</option>
														<?php
													} ?>
													</select>
													<?php
													$sl_count++;
												}
												?>
												<input type="hidden" name="product_attr_count[]" value="<?= $sl_count ?>">
											</span>
											Others : <input type="text" name="others[]" class="form-control form-control-sm" value="<?= $others_decoded[$key] ?>">
										</td>
										<td class="text-left">
											<label>Basic Price</label>
											<input type="text" class="form-control form-control-sm price_cal" name="product_price[]" value="<?= $product_price_decoded[$key] ?>" />
											<label>Tax Rate(%)</label>
											<input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" value="<?= $product_details->tax_rate; ?>" readonly />
										</td>
										<td class="text-left calculation-form">
											CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" value="<?php echo $cgst_decoded[$key]; ?>" readonly />
											<div class="clearfix"></div>
											SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" value="<?php echo $sgst_decoded[$key]; ?>" readonly />
											<div class="clearfix"></div>
											IGST<input type="hidden" name="state" class="state_val" value="<?= $purchase_order["billing_state"]; ?>">
											<input type="text" class="form-control form-control-sm igst_cal" name="igst[]" value="<?php echo $igst_decoded[$key]; ?>" readonly />
											<div class="clearfix"></div>
											Ex-yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" value="<?= $exyard_decoded[$key] ?>" readonly />
											<div class="clearfix"></div>
											Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" value="<?= $frieght_decoded[$key] ?>" />
											<div class="clearfix"></div>
											Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" value="<?= $total_decoded[$key] ?>" readonly />
										</td>
										<td class="text-left"><a href="#!" class="btn btn-sm btn-danger remove_tr"><i class="fa fa-times-circle"></i></a>
										</td>
									</tr>
									<?php $slnew++;
								}
								?>
								<script>
									$(document).ready(function() {
										var slno = 1;
										$(document).on("click", ".remove_tr", function() {
											$(this).parent().parent().remove();
										});
										$(document).on("click", ".add_new_product", function() {
											$('#objectTable1').append('<tr><td>' + slno + '</td>\
											<td><select class="form-control form-control-sm product_select_option" name="product_id[]">\
													<option  >Please Select</option>\
													<?php foreach ($product_id as $p) {
														echo '<option value="' . $p->id . '">' . $p->product_name . '</option>';
													} ?></td><td class = "text-left">\
													<input type="text" class="quantity_cal col-md-6 padding-zero" name="quantity[]"> \
													<select class="padding-zero" name="product_unit[]" id="product_unit[]"> \
													<option value="MT"> MT </option>\
													   <option value="KG"> KG </option>\
													<option value="Pcs"> Pcs  </option>\
														</select> \
													</div> </td> \
													<td ><span class="attribute_place"></span>Others : <input type="text" name="others[]"></td>\
														<td class="text-left">\
														<label>Basic Price</label>\
														<input type="text" class="form-control form-control-sm price_cal" name="product_price[]" /><br/>\
														<label>Tax Rate</label>\
														<input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" readonly/></td>\
														<td class="text-left calculation-form"> \
														CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" id="cgst[]"  readonly /> \
														<div class="clearfix"></div>SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" id="sgst[]" readonly /> \
														<div class="clearfix"></div>IGST<input type="hidden" name="state" class="state_val" value="<?= $purchase_order["billing_state"]; ?>"><input type="text" class="form-control form-control-sm igst_cal" name="igst[]" id="igst[]" readonly /> \
														<div class="clearfix"></div>Ex-Yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" id="exyard[]"  readonly/> \
														<div class="clearfix"></div>Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" id="frieght[]"  /> \
														<div class="clearfix"></div>Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" id="total_price[]" readonly/> \
														</td>\
														</td > <td> <a href = "#!" class = "btn btn-sm btn-danger remove_tr"> <i class = "fa fa-times-circle" > </i> </a> </td> </tr> \
													');
											sl++;
										});
									});
								</script>
							</tbody>
						</table>
						<div align="right">
							<a class="btn btn-sm btn-warning add_new_product" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>

						</div>
						<div class="row">
							<div class="col-md-5">
								<label for="varchar">Regards, <?php echo form_error('send_from'); ?></label>
								<textarea type="text" class="form-control form-control-sm" name="send_from" id="send_from" placeholder="From : "><?php echo "Supply Origin \nG.S. Road Bhangagarh \nGuwahati "; ?></textarea>
							</div>

						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<input type="hidden" name="potoadmin_id" value="<?php echo $purchase_order["potoadmin_id"]; ?>" />
						<input type="hidden" name="customer_id" value="<?php echo $purchase_order["customer_id"]; ?>" />
						<div align="center">
							<a href="<?php echo site_url('admin/proforma_invoice'); ?>" class="btn btn-sm btn-default">Cancel</a>
							<button type="submit" class="btn btn-sm btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>
</div>
<link href="<?= base_url('public/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css" />
<script src="<?= base_url('public/jqueryui/jquery-ui.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$(document).on('change', '.product_select_option', function() {
			var attr = $(this);
			var id = $(this).val();
			$.ajax({
				type: "post",
				url: "<?= base_url('admin/attribute/get_attribute_for_order/'); ?>",
				data: {
					product: id
				},
				dataType: 'html',
				success: function(htm) {
					attr.parent().parent().children().children('.attribute_place').empty().append(htm);
				}
			});
			//get product tax_rate
			$.ajax({
				type: "post",
				url: "<?= base_url('admin/products/get_product_tax_rate/'); ?>",
				data: {
					product: id
				},
				dataType: 'json',
				success: function(jsn) {
					attr.parent().parent().children().children('.tax_rate').val(jsn.tax_rate);
				}
			});
		});
		var state = "";
		$("#supplier").change(function() {
			var element = $(this).find('option:selected');
			var state_final = element.attr("state");
			state = state_final;
			console.log(state);
		});
		$(document).on('keyup', '.price_cal,.quantity_cal', function() {
			var qty = $(this).parent().parent().children().children('.quantity_cal').val();
			var basic_price = $(this).parent().parent().children().children('.price_cal').val();
			var tax_rate = $(this).parent().parent().children().children('.tax_rate').val();

			var state_gst = parseFloat(tax_rate) / 2;
			var price = parseInt(qty) * basic_price;
			var cgst = Math.ceil(price * (parseFloat(state_gst) / 100));
			var sgst = Math.ceil(price * (parseFloat(state_gst) / 100));
			var igst = Math.ceil(price * (parseInt(tax_rate) / 100));
			console.log("tax" + tax_rate);
			console.log("price" + price);
			if (state == "") {
				alert("Please select supplier!");
				exit;
			}
			if (state == "Assam") {
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

		});
		$(document).on('keyup', '.frieght_cal', function() {
			var frieght = $(this).val();
			var exyard = $(this).parent().parent().children().children('.exyard_cal').val();
			var total_price = Math.ceil(parseFloat(exyard) + parseFloat(frieght));
			total_price = isNaN(total_price) ? 0 : total_price;
			$(this).parent().parent().children().children('.total_price_cal').val(total_price);
		});
	});
</script>
<script>
	// $('#editordata').summernote({
	//     placeholder: 'Type your message here',
	//     //var a = $('#form-enquiry_id-9102').val();
	//     tabsize: 2,
	//     height: 350
	// });
	// $('#editordata2').summernote({
	//     placeholder: 'Type your message here',
	//     tabsize: 2,
	//     height: 350
	// });
	$(document).ready(function() {
		$("#send_to_autocomplete").autocomplete({
			source: "<?= base_url('admin/purchase_orders/get_suppliernames') ?>",
			minLength: 1,
			select: function(event, ui) {
				//$("#supplier_details").html(ui.item.label);
				$('#supplier_id').val(ui.item.id);
			},
			open: function() {
				setTimeout(function() {
					$('.ui-autocomplete').css('z-index', 99999999999999);
				}, 0);
			}
		}); //End of autocomplete #cust_search_box
	});
</script>