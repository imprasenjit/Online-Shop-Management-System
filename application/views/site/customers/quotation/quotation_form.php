
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="product-status-wrap">
					<h3 align="center">Quotation</h3>
					<div align="right"><img src="<?= LOGO; ?>" class="img-fluid"></div>
					<form class="form-horizontal" action="<?= base_url(); ?>admin/quotation/create_action/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data" id="myform">
						<div class="row" style="margin-left:2px;">
							<div class="form-group">
								<div class=" col-md-6">
									<?php
									$order_id = $this->uri->segment(4);
									$result = $this->enquires_model->get_by_id($order_id);
									$sl = 1;
									if ($result) {
										$id = $result->customerid;
										$name = $result->name;
										$contact = $result->contact;
										$email = $result->email;
										$address = $result->address;
										?>
										<label for="varchar">Date. <?php echo date("d-m-Y"); ?> </label><br />
										<label for="varchar">To <?php echo form_error('send_to') ?></label><br />
										<?= $name ?><br>
										<?= $contact ?><br>
										<?= $email ?><br>
										<?= $address ?><br>
										<div class="col-md-4">
											<input type="hidden" class="form-control" name="enquiry_id" id="enquiry_id" value="<?php echo $this->uri->segment(4); ?>" readonly />
											<input type="hidden" class="form-control" name="send_to" id="send_to" value="<?php echo $email; ?>" readonly /></div>
										<br />
										<?php
										$sl++;
									}
									?>
								</div>
							</div>
						</div>
						<?php
						$enquiry_id = $this->uri->segment(4);
						$results = $this->enquires_model->get_by_id($enquiry_id);
						$enq_unique_id = $results->unique_id;
						$enquiry_placed_date = $results->enquiry_placed_date;
						$sl = 1;
						if ($results) {
							?>
							<textarea id="editordata" name="editordata">
														Ref : With reference to Enquiry No.<strong>  <?php echo $enq_unique_id; ?> </strong>placed on  <?php echo date("d-m-Y", strtotime($enquiry_placed_date)); ?> .<br />
														Dear  <?php
																if ($name) {
																	echo $name;
																} else {
																	echo $this->customer_registration_model->get_by_id1($this->uri->segment(4))->name;
																}
																?> <br />
														Thank-you for your enquiry. <br/><br/>
														We are pleased to quote our lowest rates for your requirement -
													</textarea>
							<table name="objectTable1" id="objectTable1" class="table table-bordered">
								<thead>
									<tr>
										<th width="2%">Sl No.</th>
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
									$rows = $this->enquires_model->get_enquiry_details2($enquiry_id);
									foreach ($rows as $products) {
										$id = $products->productid;
										$productname = $this->products_model->get_by_id($products->productid)->product_name;
										$quantity = $products->quantity;
										$product_unit = $products->product_unit;
										$attributes = $products->attributes;
										?>
										<tr>
											<td class="text-left"><input type="text" class="form-control" name="slno[]" id="slno[]" value="<?= $sl; ?>" readonly></td>
											<?php $product_id = $this->products_model->get_all(); ?>
											<td class="text-left">
												<select class="form-control product_select_option" name="product_id[]" id="product_id">
													<option value="">Please Select</option>
													<?php foreach ($product_id as $p) { ?>
														<option value="<?= $p->id ?>" <?= ($products->productid == $p->id) ? "selected" : ""; ?>><?= $p->product_name ?></option>
													<?php } ?>
												</select>
											</td>
											<td class="text-left">
												<input type="text" class="col-md-6 padding-zero" name="quantity[]" value="<?= $quantity; ?>">
												<select class="padding-zero" name="product_unit[]">
													<option value="MT" <?= ($products->product_unit == "MT") ? "selected" : ""; ?>>MT</option>
													<option value="KG" <?= ($products->product_unit == "KG") ? "selected" : ""; ?>>KG</option>
													<option value="Pcs" <?= ($products->product_unit == "Pcs") ? "selected" : ""; ?>>Pcs</option>
												</select>
											</td>
											<td class="text-left attribute_place">
												<?php
												if ($attributes != "") {
													$attributes_decoded = json_decode($attributes, true);
													$sl = 1;
													//echo '<pre>';print_r($attributes_decoded["attributes"]);die;
													foreach ($attributes_decoded["attributes"] as $key => $values) {
														?>
														<?= $values[0];
														$attribute_value = $this->attribute_model->get_attribute_value($products->productid, $key);
														?>
														<select class="attr_values" name="product_<?= $products->productid; ?>attr[]">
															<option value="">Please Select</option>
															<?php foreach ($attribute_value as $value) { ?>
																<option value="<?= $value->attr_value; ?>" <?= ($values[1] == $value->attr_value) ? "selected" : ""; ?>><?= $value->attr_value ?>
																</option>
															<?php
														} ?>
														</select>
														<hr />
													<?php
												}
											}
											?>
											</td>
											<td class="text-left">
												<input type="text" class="form-control price_cal" name="product_price[]" placeholder="Enter Product Price (in Rs.)" value="" /></td>
											<td class="text-left">
												<input type="text" class="form-control cgst_cal" name="cgst[]" placeholder="CGST @9%" value="<?php echo $cgst; ?>" readonly="" />
												<input type="text" class="form-control sgst_cal" name="sgst[]" placeholder="SGST @9%" value="<?php echo $sgst; ?>" readonly="" />
												<input type="text" class="form-control igst_cal" name="igst[]" placeholder="IGST @18%" value="<?php echo $igst; ?>" readonly="" />
												<input type="text" class="form-control exyard_cal" name="exyard[]" placeholder="Ex-Yard (in Rs./MT)" value="" />
												<input type="text" class="form-control frieght_cal" name="frieght[]" placeholder="Frieght (Cost/MT)" value="" />
												<input type="text" class="form-control total_price_cal" name="total_price[]" placeholder="Total Price (in Rs.)" value="<?php
																																										?>" />
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
										//alert("d");
										$(document).on('keyup', '.price_cal', function() {
											var price = $(this).val();
											var cgst = Math.ceil(price * (9 / 100));
											var sgst = Math.ceil(price * (9 / 100));
											var igst = Math.ceil(price * (18 / 100));
											//var exyard=$("#exyard").val();
											//var frieght=$("#frieght").val();
											$(this).parent().parent().children().children('.cgst_cal').val(cgst);
											$(this).parent().parent().children().children('.sgst_cal').val(sgst);
											$(this).parent().parent().children().children('.igst_cal').val(igst);
										});
										$(document).on('keyup', '.frieght_cal', function() {
											var frieght = $(this).val(); //alert(frieght);
											var price = $(this).parent().parent().children().children('.price_cal').val();
											var cgst = $(this).parent().parent().children().children('.cgst_cal').val();
											var sgst = $(this).parent().parent().children().children('.sgst_cal').val();
											var igst = $(this).parent().parent().children().children('.igst_cal').val();
											var exyard = $(this).parent().parent().children().children('.frieght_cal').val();
											var total_price = Math.ceil(parseFloat(price) + parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(exyard) + parseFloat(frieght));
											//alert(total_price);
											total_price = isNaN(total_price) ? 0 : total_price;
											$(this).parent().parent().children().children('.total_price_cal').val(total_price);
										});
									});
								</script>
							</table>
							<div align="right">
								<a class="btn btn-warning add_new_product" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
								<input type="hidden" id="hiddenval" name="hiddenval" value="" />
							</div>

							<script>
								$(document).ready(function() {
											var sl = <?= $sl; ?>;
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
														attr.parent().parent().children('.attribute_place').empty().append(htm);
														console.log(htm);
													}
												});
											});
											$(document).on("click", ".remove_tr", function() {
												$(this).parent().parent().remove();
											});
											$(document).on("click", ".add_new_product", function() {
													$('#objectTable1').append('<tr><td>' + sl + '</td>\
													<td><select class="form-control product_select_option" name="product_id[]">\
															<option value="" >Please Select</option>\
															<?php foreach ($product_id as $p) {
																echo '<option value="' . $p->id . '">' . $p->product_name . '</option>';
															} ?> < /
														td > < td class = "text-left" > \ <
														input type = "text"
														class = "col-md-6 padding-zero"
														name = "quantity[]" > \
														<
														select class = "padding-zero"
														name = "product_unit[]"
														id = "product_unit[]" > \
														<
														option value = "MT" > MT < /option>\ <
														option value = "KG" > KG < /option>\ <
														option value = "Pcs" > Pcs < /option>\ < /
														select > \ <
														/div></td > \
														<
														td class = "attribute_place" > < /td>\ <
														td class = "text-left" > \
														<
														input type = "text"
														class = "form-control price_cal"
														name = "product_price[]"
														id = "product_price[]"
														placeholder = "Enter Product Price (in Rs.)"
														value = "" / > < /td>\ <
														td class = "text-left" > \
														<
														input type = "text"
														class = "form-control cgst_cal"
														name = "cgst[]"
														id = "cgst[]"
														placeholder = "CGST @9%"
														value = ""
														readonly = "" / > \
														<
														input type = "text"
														class = "form-control sgst_cal"
														name = "sgst[]"
														id = "sgst[]"
														placeholder = "SGST @9%"
														value = ""
														readonly = "" / > \
														<
														input type = "text"
														class = "form-control igst_cal"
														name = "igst[]"
														id = "igst[]"
														placeholder = "IGST @18%"
														value = ""
														readonly = "" / > \
														<
														input type = "text"
														class = "form-control exyard_cal"
														name = "exyard[]"
														id = "exyard[]"
														placeholder = "Ex-Yard (in Rs./MT)"
														value = "" / > \
														<
														input type = "text"
														class = "form-control frieght_cal"
														name = "frieght[]"
														id = "frieght[]"
														placeholder = "Frieght (Cost/MT)"
														value = "" / > \
														<
														input type = "text"
														class = "form-control total_price_cal"
														name = "total_price[]"
														id = "total_price[]"
														placeholder = "Total Price (in Rs.)"
														value = "" / > \
														<
														/td>\ < /
														td > < td > < a href = "#!"
														class = "btn btn-danger remove_tr" > < i class = "fa fa-times-circle" > < /i > < /a > < /td > < /tr > \
														');
														sl++;
													});
											});
							</script>
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
							<div class="form-group">
								<div class="col-md-9"></div>
								<div class=" col-md-3">
									<label for="varchar">Regards, <?php echo form_error('send_from') ?></label>
									<textarea type="text" class="form-control" name="send_from" id="send_from" placeholder="From : "><?php echo "Supply Origin \nG.S. Road Bhangagarh \nGuwahati "; ?></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div align="center">
							<a href="<?php echo site_url('admin/quotation') ?>" class="btn btn-default">Cancel</a>
							<button type="submit" class="btn btn-primary">Send Quotation</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#editordata').summernote({
		placeholder: 'Type your message here',
		//var a = $('#form-enquiry_id-9102').val();
		tabsize: 2,
		height: 200
	});
	$('#editordata2').summernote({
		placeholder: 'Type your message here',
		tabsize: 2,
		height: 350
	});
</script>