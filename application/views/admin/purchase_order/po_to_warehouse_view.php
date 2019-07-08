<div class="container-fluid">
	<div class="mb-4">
		<?= $this->breadcrumbs->show(); ?>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Purchase Order To Warehouse</h6>
				</div>
				<div class="card-body">
					<?php echo validation_errors() ?>
					<form class="form-horizontal" action="<?= base_url("admin/purchase_orders/send_po_to_warehouse_action/$send_id"); ?>" method="post" id="myform">


						<input type="hidden" name="send_id" value="<?= $send_id; ?>">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Company Name</label>
									<input type="text" class="form-control form-control-sm" name="company_name">
								</div>
							</div>
							<div class="col-md-6 text-right">
								<p class="text-right">
									Date: <?php echo date("d-m-Y"); ?>
								</p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Invoice Number</label>
									<input type="text" class="form-control form-control-sm" name="invoice_no">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Invoice Date</label>
									<input type="date" class="form-control form-control-sm" name="invoice_date">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Vehicle Number</label>
									<input type="text" class="form-control form-control-sm" name="lorry_no">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar"> Date</label>
									<input type="date" class="form-control form-control-sm" name="lorry_date">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Driver Name</label>
									<input type="text" class="form-control form-control-sm" name="driver_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar"> Driver Contact</label>
									<input type="text" class="form-control form-control-sm" name="driver_contact">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="lorry_no" class="text-right control-label">Upload Invoice <?php echo form_error('invoice') ?></label>
									<input type="file" name="invoice" id="invoice" data-error="Please upload Invoice." />
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Select Customer</label>
									<input type="text" class="form-control form-control-sm" name="send_to_autocomplete" id="send_to_autocomplete" placeholder="Type Customer Name" />
									<input type="hidden" name="send_to" id="send_to" value="">
									<span id="cust_details"></span>
								</div>
								<div class="form-group" id="adrress_display">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="varchar">Billing State</label>
									<select class="form-control form-control-sm" name="state" id="state">
										<option value="">Select State
										<option>
											<?php $states = $this->suppliers_model->get_all_states();
											foreach ($states as $state_detail) { ?>
											<option value="<?= trim($state_detail->state_name); ?>"><?= $state_detail->state_name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

						</div>
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
							<a class="btn btn-sm btn-warning add_new_product btn-circle float-right" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
							<input type="hidden" id="hiddenval" name="hiddenval" value="" />
						</div>
						<div class="clearfix"></div>
						<br />
						<br />
				</div>
				<div class="card-footer">
					<a href="<?php echo site_url('admin/purchase_orders/purchase_order_to_warehouse_list') ?>" class="btn btn-sm btn-default">Cancel</a>
					<button type="submit" class="btn btn-sm btn-sm btn-primary">Send Purchase Order To Warehouse</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<link href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>" rel="stylesheet">
<script src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
<link href="<?= base_url('public/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css" />
<script src="<?= base_url('public/jqueryui/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
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
		$("#invoice").pekeUpload({
			bootstrap: true,
			btnText: "Upload Invoice",
			url: "<?= base_url(); ?>upload/",
			data: {
				file: "invoice"
			},
			limit: 1,
			allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
		});
		$("#send_to_autocomplete").autocomplete({
			source: "<?= base_url('admin/message/get_custnames') ?>",
			minLength: 1,
			select: function(event, ui) {
				$("#cust_details").html(ui.item.label);
				$('#send_to').val(ui.item.id);
				show_address(ui.item.address);
				console.log(ui.item);
			},
			open: function() {
				setTimeout(function() {
					$('.ui-autocomplete').css('z-index', 99999999999999);
				}, 0);
			}
		}); //End of autocomplete #cust_search_box
		function show_address(address) {
			$("#adrress_display").empty();
			$(address).each(function(key, value) {
				$("#adrress_display").append('<div class="row">\
		<div class="col-md-1"><input type="radio" name="address_selector" value="' + value.address_id + '"></div>\
		<div class="col-md-4">' + value.address_type + ':</div>\
		<div class="col-md-7">' + value.address + '</div>\
		</div>');
			});
		}
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
		$(document).on('keyup', '.frieght_cal', function() {
			var frieght = $(this).val();
			var exyard = $(this).parent().parent().children().children('.exyard_cal').val();
			var total_price = Math.ceil(parseFloat(exyard) + parseFloat(frieght));
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
			<
			? php $product_id = $this - > products_model - > get_all(); ? >
			$('#objectTable1').append('<tr><td>' + sl + '</td>\
					<td><select class="form-control form-control-sm product_select_option" name="product_id[]">\
							<option value="">Please Select</option>\																		<?php foreach ($product_id as $p) {
																																				echo '<option value="' . $p - > i d.
																																					'"> ' .$p - > product_na me.
																																					'</option>';
																																			}
																																			? >
																																			<
																																				/ t d ><td class = "text-le f t">\<
																																				input type = "text"
																																				style = "float:left;width:40% !important;"
																																			class = "form-control form-control-sm quantity_cal"
																																				name = "quantity[]" > \<
																																				select style = "width:50% !important;"
																																			class = "form-control form-control-sm"
																																				name = "product_unit[]"
																																				id = "product_unit[]" > \<
																																				option value =  "MT" >   MT < /option>\<
																																				option value =  "KG" >   KG < /option>\<
																																				option value = "P cs" >  P cs < /opt ion> 
																																				/sele ct> \
																																				/div> </td > \<
																																				td > < span class = "attribu te_p l ace" > < / span>Others  : <input t y pe="text" class="form-control form- c ontrol-sm"   n a me="others[]"></td > \<
																																				td class = "text-left" > \<
																																				label  > Ba s ic Price < /label>\<
																																				input type = "text"
																																			class = "form-control form-control-sm price_cal"
																																				name = "product_price[]" / > \<
																																				label  > Fr i eght Per Unit < /label>\<
																																				input type = "text"
																																			class = "form-control form-control-sm frieght_unit_cal"
																																				name = "frieght_unit_price[]" / > \	
																																						label > Tax Rate < /label>\<
																																				input type = "text"
																																			class = "form-control form-control-sm tax_rate"
																																				name =  " t ax_rate
																																				readonly / > < /td>\<
																																				td class = "text-left calculation-form" > \CGST < input type = "text"
																																			class = "form-control form-control-sm cgst_cal"
																																				name = "cgst[]"
																																				id = "cgst[]"
																																				readonly /  > 	
																																				div c l ass = "clea r fix" > < /div>SGST<input type="text" class=" f orm-control   form-control-sm sgst_cal" name="sgst[]" id="sgst[]" readonly  /  >	
																																				di v  class = "c l earfix" > < /div>IGST<input type="text" clas s ="form-cont r ol form-control-sm igst_cal" name="igst[]" id="igst[]" reado nly   / 	
																																				di v  class = "c l earfix" > < /div>Ex-Yard<input type="text" cla s s="form-contr o l form-control-sm e xyard_cal" name="exyard[]" id="exyard[]" r ead o nly/ <
																																					 div class =   "clearfix" > < /div>Frieght<input type="text" c l ass="form-cont r ol form-control-sm frieght_cal" name="frieght[]" id="frieght[]"  re a donly    
																																				div cl a ss = "clearfix" > < /div>Total<input type="text" cl a ss="form-control f o rm-control-sm total_pric e_cal" name="tota l_ p rice[]" i d= "to tal_pri c e[]" reado<
																																				/td>\<
																																				/td> <td class="text-center"> <a href =  "# !" class = "btn btn-s m b t n-dange r  bt n -circle  re move_tr"> <i class = "fa fa-times"> </i > < /a> </td > < /tr> \');
			sl++;
		});
	});
</script>
