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
				<div class="card-body">
					<?php echo validation_errors() ?>
					<form class="form-horizontal" action="<?= base_url("admin/quotation/create_action_for_customer/"); ?>" method="post" id="myform">
						<div class="row">
							<div class="col-md-6">
							<div class="form-group">
									<label for="varchar">Select Customer</label>
									<input type="text" class="form-control form-control-sm" name="send_to_autocomplete" id="send_to_autocomplete" placeholder="Type Customer Name" />
									<input type="hidden" name="send_to" id="send_to" value="">
									<span id="cust_details"></span>
								</div>
								<div class="form-group">
									<label for="varchar">Billing State</label>
									<select class="form-control form-control-sm" name="state" id="state">
										<option value="">Select State
										<option>
											<?php $states = $this->suppliers_model->get_all_states();
											foreach ($states as $state_detail) { ?>
											<option value="<?= $state_detail->state_name; ?>"><?= $state_detail->state_name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 text-right">
								<p class="text-right">
									Quotation Date: <?php echo date("d-m-Y"); ?>
								</p>
							</div>
						</div>
						<textarea id="editordata" name="editordata">
																	Dear
																	<span id="customer_name">Type Customer Name Here</span> ,
																	<br/>
																	We are pleased to quote our lowest rates for your requirement - <br/>
																</textarea>
						<br />
						<table class="table table-bordered">
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
							<tbody id="objectTable1">

							</tbody>

						</table>
						<div class="col-md-12">
							<a class="btn btn-sm btn-warning add_new_product float-right" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
							<input type="hidden" id="hiddenval" name="hiddenval" value="" />
						</div>
						<div class="clearfix"></div>
						<br />
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
				</div>
				<div class="card-footer">
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
<script type="text/javascript" src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
<link href="<?= base_url('public/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url('public/jqueryui/jquery-ui.min.js') ?>"></script>
<script>
	$('#editordata').summernote({
		tabsize: 2,
		height: 200
	});
	$('#editordata2').summernote({
		tabsize: 2,
		height: 350
	});
	$(document).ready(function() {
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
		var sl = 1;
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
			<?php $product_id = $this->products_model->get_all(); ?>
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
			<div class="clearfix"></div>Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" id="frieght[]" readonly/> \
			<div class="clearfix"></div>Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" id="total_price[]" readonly/> \
			</td>\
                </td> <td> <a href = "#!" class = "btn btn-sm btn-danger remove_tr"> <i class = "fa fa-times-circle"> </i> </a> </td> </tr> \
			');
			sl++;
													});
			$("#send_to_autocomplete").autocomplete({
				source: "<?= base_url('admin/message/get_custnames') ?>",
				minLength: 1,
				select: function(event, ui) {
					$("#cust_details").html(ui.item.label);
					$('#send_to').val(ui.item.id);
					// $("#customer_name").empty().html(ui.item.name);
				},
				open: function() {
					setTimeout(function() {
						$('.ui-autocomplete').css('z-index', 99999999999999);
					}, 0);
				}
			}); //End of autocomplete #cust_search_box
		});
</script>
