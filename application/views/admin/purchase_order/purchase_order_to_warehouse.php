<div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Purchase Order To Warehouse</h6>
                    </div>
                    <div class="card-body">
					<?php  echo validation_errors()?>
					<form class="form-horizontal" action="<?= base_url("admin/purchase_orders/send_to_warehouse_action/"); ?>" method="post" id="myform">
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
								<div class="form-group">
									<label for="varchar">Billing State</label>
                                    <select class="form-control form-control-sm" name="state" id="state">
										<option value="">Select State<option>
                                        <?php $states = $this->suppliers_model->get_all_states();
                                        foreach ($states as $state_detail) { ?>
                                            <option value="<?= $state_detail->state_name; ?>"><?= $state_detail->state_name; ?></option>
                                        <?php } ?>
                                    </select>
								</div>	
							</div>	
							<div class="col-md-6 text-right">
								<p class="text-right">									
									Date: <?php echo date("d-m-Y"); ?> 
								</p>
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
								<script>
									$(document).ready(function() {		
										$(document).on('keyup', '.price_cal', function() {
											var qty = $(this).parent().parent().children().children('.quantity_cal').val();
											var basic_price = $(this).parent().parent().children().children('.price_cal').val();
											var tax_rate = $(this).parent().parent().children().children('.tax_rate').val();
											var state_gst=parseFloat(tax_rate)/2;											
											var price = parseInt(qty) * basic_price;
											var cgst = Math.ceil(price * (parseFloat(state_gst) / 100));
											var sgst = Math.ceil(price * (parseFloat(state_gst) / 100));
											var igst = Math.ceil(price * (parseInt(tax_rate) / 100));
											var state=$('#state').val().replace(/ /g,'');
											if(state==""){
												alert("Please select state");exit;
											}
				                            
											if(state=="Assam"){
												$(this).parent().parent().children().children('.cgst_cal').val(cgst);
												$(this).parent().parent().children().children('.sgst_cal').val(sgst);
												$(this).parent().parent().children().children('.igst_cal').val(0);
												var exyard=price+cgst+sgst;
											}else{
												$(this).parent().parent().children().children('.igst_cal').val(igst);
												$(this).parent().parent().children().children('.cgst_cal').val(0);
												$(this).parent().parent().children().children('.sgst_cal').val(0);
												var exyard=price+igst;
											}
											
											$(this).parent().parent().children().children('.exyard_cal').val(exyard);
										});
										$(document).on('keyup', '.frieght_cal', function() {
											var frieght = $(this).val(); 
											var exyard=$(this).parent().parent().children().children('.exyard_cal').val();
											var total_price = Math.ceil(parseFloat(exyard) + parseFloat(frieght));											
											total_price = isNaN(total_price) ? 0 : total_price;
											$(this).parent().parent().children().children('.total_price_cal').val(total_price);
										});
									});
								</script>
							</table>
							<div class="col-md-12">
								<a class="btn btn-sm btn-warning add_new_product float-right" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
								<input type="hidden" id="hiddenval" name="hiddenval" value="" />
							</div>
							<div class="clearfix"></div>
							<br/>
							<script>
								$(document).ready(function() {
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
														<input type="text" class="form-control form-control-sm price_cal" name="product_price[]" /><br/>\
														<label>Tax Rate</label>\
														<input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" readonly/></td>\
														<td class="text-left calculation-form"> \
														CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" id="cgst[]" readonly /> \
														<div class="clearfix"></div>SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" id="sgst[]" readonly /> \
														<div class="clearfix"></div>IGST<input type="hidden" name="state" class="state_val" value=""><input type="text" class="form-control form-control-sm igst_cal" name="igst[]" id="igst[]" readonly /> \
														<div class="clearfix"></div>Ex-Yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" id="exyard[]" readonly/> \
														<div class="clearfix"></div>Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" id="frieght[]" /> \
														<div class="clearfix"></div>Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" id="total_price[]" readonly/> \
														</td>\
                                                            </td> <td> <a href = "#!" class = "btn btn-sm btn-danger remove_tr"> <i class = "fa fa-times-circle"> </i> </a> </td> </tr> \
														');
														sl++;
													});
											});
							</script>

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
<link href="<?=base_url('public/jqueryui/jquery-ui.min.css')?>" rel="stylesheet" type="text/css" />
<script src="<?=base_url('public/jqueryui/jquery-ui.min.js')?>"></script>
<script>
	$('#editordata').summernote({
		tabsize: 2,
		height: 200
	});
	$('#editordata2').summernote({
		tabsize: 2,
		height: 350
	});
	$(document).ready(function(){        
        $("#send_to_autocomplete").autocomplete({
            source:"<?=base_url('admin/message/get_custnames')?>", 
            minLength:1,
            select: function(event,ui){ 
                $("#cust_details").html(ui.item.label);
				$('#send_to').val(ui.item.id);
				show_address(ui.item.address);
				console.log(ui.item);
				
            },
			open: function(){
        		setTimeout(function () {
           			 $('.ui-autocomplete').css('z-index', 99999999999999);
        		}, 0);
   			 }
        }); //End of autocomplete #cust_search_box

		function show_address(address){
			$("#adrress_display").empty();
			$(address).each(function(key,value){
				$("#adrress_display").append('<div class="row">\
				<div class="col-md-1"><input type="radio" name="address_selector" value="'+value.address_id+'"></div>\
				<div class="col-md-4">'+value.address_type+':</div>\
				<div class="col-md-7">'+value.address+'</div>\
				</div>');
			});
		    
		}
    });
</script>