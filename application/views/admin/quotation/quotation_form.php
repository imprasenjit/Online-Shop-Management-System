<div class="container-fluid">
	<div class="mb-4">
		<?= $this->breadcrumbs->show(); ?>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Send Quotation to Customer</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<?= validation_errors(); ?>
					<form class="form-horizontal" action="<?= base_url("admin/quotation/create_action/"); ?>" method="post" id="myform">
						<div class="float-right">
							<p class="text-left">
								Quotation Date: <?php echo date("d-m-Y"); ?>
							</p>
						</div>
						<?php
						$result = $this->enquires_model->get_by_id($enquiry_id);
						if ($result) {
							?>
							To ,<br />
							<?= $result->name ?><br>
							<?= $result->contact ?><br>
							<?= $result->email ?><br>
							<?= $result->address ?><br>
							<span>Billing State : <?= ucfirst($result->state); ?></span>
							<div class="col-md-4">
								<input type="hidden" id="state" value="<?=$result->state;?>">
								<input type="hidden" class="form-control" name="enquiry_id" id="enquiry_id" value="<?= $enquiry_id; ?>" />
								<input type="hidden" class="form-control" name="send_to" id="send_to" value="<?php echo $result->customerid; ?>" /></div>
							<br />
						<?php
					}
					?>
						<?php
						$sl = 1;
						if ($result) {
							?>
							<textarea id="editordata" name="editordata">
																		Ref : With reference to Enquiry No.<strong>  <?php echo $result->enq_ref; ?> </strong>placed on  <?php echo date("d-m-Y", strtotime($result->enquiry_placed_date)); ?> .<br />
																		Dear <?= $result->name ?> <br />
																		Thank-you for your enquiry. <br/><br/>
																		We are pleased to quote our lowest rates for your requirement -
																	</textarea>
							<br />
							<table name="objectTable1" id="objectTable1" class="table table-bordered">
								<thead>
									<tr>
										<th width="2%">(#)</th>
										<th width="15%">Product Name</th>
										<th width="15%">Quantity</th>
										<th width="20%">Attributes</th>
										<th width="10%"></th>
										<th width="20%">Other Details</th>
										<th width="3%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$rows = $this->enquires_model->get_enquiry_details_by_enquery_id($enquiry_id);
									foreach ($rows as $products) {
										$id = $products->productid;
										$product_details = $this->products_model->get_by_id($products->productid);
										$quantity = $products->quantity;
										$product_unit = $products->product_unit;
										$attributes = $products->attributes;
										?>
										<tr>
											<td class="text-left"><?= $sl; ?></td>
											<?php $product_id = $this->products_model->get_all(); ?>
											<td class="text-left">
												<select class="form-control form-control-sm product_select_option" name="product_id[]">
													<option value="">Please Select</option>
													<?php foreach ($product_id as $p) { ?>
														<option value="<?= $p->id ?>" <?= ($products->productid == $p->id) ? "selected" : ""; ?>><?= $p->product_name ?></option>
													<?php } ?>
												</select>
											</td>
											<td class="text-left">
												<input type="text" style="float:left;width:40% !important;" class="form-control form-control-sm quantity_cal" name="quantity[]" value="<?= $quantity; ?>">
												<select style="width:50% !important;" class="form-control form-control-sm" name="product_unit[]">
													<option value="MT" <?= ($products->product_unit == "MT") ? "selected" : ""; ?>>MT</option>
													<option value="KG" <?= ($products->product_unit == "KG") ? "selected" : ""; ?>>KG</option>
													<option value="Pcs" <?= ($products->product_unit == "Pcs") ? "selected" : ""; ?>>Pcs</option>
												</select>
											</td>
											<td class="text-left">
												<span class="attribute_place">
													<?php
													if ($attributes != "") {
														$sl_count = 0;
														$attributes_decoded = json_decode($attributes, true);
														foreach ($attributes_decoded["attributes"] as $key => $values) {
															?>
															<?= $values[0];
															$attribute_value = $this->attribute_model->get_attribute_value($products->productid, $key);
															?> :
															<select class="form-control form-control-sm attr_values" name="product_attr[]">
																<option value="">Please Select</option>
																<?php foreach ($attribute_value as $value) { ?>
																	<option value="<?= $value->attr_value; ?>" <?= ($values[1] == $value->attr_value) ? "selected" : ""; ?>><?= $value->attr_value ?>
																	</option>
																<?php
															} ?>
															</select>
															<?php
															$sl_count++;
														} ?>
														<input type="hidden" name="product_attr_count[]" value="<?= $sl_count ?>">
													<?php }
												?>
												</span>
												Others : <input type="text" class="form-control form-control-sm" name="others[]" value="<?= $products->others ?>">
											</td>
											<td class="text-left">
												<label>Basic Price</label>
												<input type="text" class="form-control form-control-sm price_cal" name="product_price[]" />
												<label>Frieght Per Unit</label>
												<input type="text" class="form-control form-control-sm frieght_unit_cal" name="frieght_unit_price[]" />
												<label>Tax Rate</label>
												<input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" value="<?= $product_details->tax_rate; ?>" readonly />
											</td>
											<td class="text-left calculation-form">
												CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" value="" readonly />
												<div class="clearfix"></div>
												SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" value="" readonly />
												<div class="clearfix"></div>
												IGST
												<input type="text" class="form-control form-control-sm igst_cal" name="igst[]" value="" readonly />
												<div class="clearfix"></div>
												Ex-yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" value="" readonly />
												<div class="clearfix"></div>
												Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" value="" readonly/>
												<div class="clearfix"></div>
												Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" value="" readonly />
											</td>
											<td class="text-left"><a href="#!" class="btn btn-sm btn-danger remove_tr"><i class="fa fa-times-circle"></i></a>
											</td>
										</tr>
										<?php $sl++;
									}
									?>
								</tbody>
							</table>
							<div class="col-md-12">
								<a class="btn btn-sm btn-warning add_new_product float-right" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
								<input type="hidden" id="hiddenval" name="hiddenval" value="" />
							</div>
							<div class="clearfix"></div>
							<br />
						<?php } else { ?>
							<h3>No records found!</h3>
						<?php } ?>
						<textarea id="editordata2" name="editordata2">
											<u>Terms &amp; Conditions -</u>
											<br />1) Rates are Ex-Warehouse (Amingaon, Guwahati). Material can be delivered at the desired address with extra transportation charges. Unloading charges not in our account.
											<br />2) Rates are inclusive of GST 18%. Any variation in the same shall be to customer account.
											<br />3) Material shall be supplied as per ordered grade in standard length if the order is not for customized length.
											<br />4) Payment – 100% advance against Proforma Invoice.
											<br />5) Offer Validity – ..................................................
											<br />6) A quantity variation of +/-5% on the ordered quantity is applicable for closing the order.
											<br />7) Weightment recorded at our weigh-bridge may please be treated at final. Variation of 0.5% on total weightment of material to be accepted by the buyer.
											</textarea>
						<br />
						<div class="row" style="margin-right:2px;">
							<div class="col-md-3">
								<label for="varchar"><?php echo form_error('send_from') ?></label>
								<textarea type="text" class="form-control form-control-sm" name="send_from" id="send_from" rows="5"><?php echo "\n\nRegards, \nSupply Origin \nG.S. Road Bhangagarh \nGuwahati "; ?></textarea>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div align="center">
							<a href="<?php echo site_url('admin/quotation') ?>" class="btn btn-sm btn-default">Cancel</a>
							<button type="submit" class="btn btn-sm btn-sm btn-primary">Send Quotation</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>" rel="stylesheet">
<script src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
<script>
	$('#editordata').summernote({
		tabsize: 2,
		height: 200
	});
	$('#editordata2').summernote({
		tabsize: 2,
		height: 350
	});
	$(document).on('keyup', '.price_cal,.frieght_unit_cal', function() {
			var qty = $(this).parent().parent().children().children('.quantity_cal').val();
			var basic_price = $(this).parent().parent().children().children('.price_cal').val();
			var frieght_unit_price = $(this).parent().children('.frieght_unit_cal').val();
			var tax_rate = $(this).parent().parent().children().children('.tax_rate').val();
			var state_gst = parseFloat(tax_rate) / 2;
			var price = parseInt(qty) * basic_price;
			var frieght_total = parseInt(qty) * frieght_unit_price;
			var cgst = Math.ceil(price * (parseFloat(state_gst) / 100));
			var sgst = Math.ceil(price * (parseFloat(state_gst) / 100));
			var igst = Math.ceil(price * (parseInt(tax_rate) / 100));
			var state = $('#state').val().replace(/ /g, '');
			if (state == '') {
				alert("Please select billing state");
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
			$(this).parent().parent().children().children('.frieght_cal').val(frieght_total);
			total_price = exyard + frieght_total;
			total_price = isNaN(total_price) ? 0 : total_price;
			$(this).parent().parent().children().children('.total_price_cal').val(total_price);
		});
var sl = <?= $sl++; ?>;
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
$(document).on("click", ".remove_tr", function() {
	$(this).parent().parent().remove();
});
$(document).on("click", ".add_new_product", function() {
		$('#objectTable1').append('<tr><td>' + sl + '</td>\
					<td><select class="form-control form-control-sm product_select_option" name="product_id[]">\
							<option value="">Please Select</option>\																		<?php foreach ($product_id as $p) {
								echo '<option value="' . $p->id . '">' . $p->product_name . '</option>';
							} ?>
			</td><td class = "text-left">\
			<input type="text" style="float:left;width:40% !important;" class="form-control form-control-sm quantity_cal" name="quantity[]"> \
			<select style="width:50% !important;" class="form-control form-control-sm" name="product_unit[]" id="product_unit[]"> \
			<option value="MT"> MT </option>\
			<option value="KG"> KG </option>\
			<option value="Pcs"> Pcs  </option>\
			 </select> \
			</div> </td> \
			<td ><span class="attribute_place"></span>Others : <input type="text" class="form-control form-control-sm" name="others[]"></td>\
			<td class="text-left">\
			<label>Basic Price</label>\
			<input type="text" class="form-control form-control-sm price_cal" name="product_price[]" />\
			<label>Frieght Per Unit</label>\
			<input type="text" class="form-control form-control-sm frieght_unit_cal" name="frieght_unit_price[]" />\
			<label>Tax Rate</label>\
			<input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" readonly/></td>\
			<td class="text-left calculation-form"> \
			CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" id="cgst[]" readonly /> \
			<div class="clearfix"></div>SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" id="sgst[]" readonly /> \
			<div class="clearfix"></div>IGST<input type="text" class="form-control form-control-sm igst_cal" name="igst[]" id="igst[]" readonly /> \
			<div class="clearfix"></div>Ex-Yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" id="exyard[]" readonly/> \
			<div class="clearfix"></div>Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" id="frieght[]" /> \
			<div class="clearfix"></div>Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" id="total_price[]" readonly/> \
			</td>\
                </td> <td> <a href = "#!" class = "btn btn-sm btn-danger remove_tr"> <i class = "fa fa-times-circle"> </i> </a> </td> </tr> \
			');
			sl++;
		});
</script>