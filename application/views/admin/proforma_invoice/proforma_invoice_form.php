<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Order Details from customer</h6>
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
                    $this->load->view("admin/products/product_table_format", array("product" => (object) $product));
                    ?>
                    <?php
                    $sl = 1;
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
                    <h6 class="m-0 font-weight-bold text-primary">Proforma Invoice details</h6>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?= base_url("admin/proforma_invoice/create_action/"); ?>" method="post" id="myform">
                        <input name="send_to" value="<?=$customer->email?>" type="text" />
                        <input type="hidden" id="state" value="<?=$purchase_order["billing_state"];?>">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <label for="varchar">Date. <?php echo date("d-m-Y"); ?> </label><br />
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <textarea id="editordata" name="editordata">
												<p><table class="table table-bordered">
														<tbody>
														<tr>
															<td>PROFORMA INVOICE NO.-</td>
														</tr>
														<tr>
															<td>DATE-</td>
														</tr>
														<tr>
															<td>SUPPLIER QUOTATION REF.-</td>
														</tr>
														<tr>
															<td>DATE-</td>
														</tr>
														<tr>
															<td>CONSIGNEE -
														<br/>
                                                <?php
                                                echo $customer->name . "<br/>";
                                                echo $customer->contact . "<br/>";
                                                echo $customer->email . "<br/>";
                                                echo $customer->address . "<br/>";
                                                ?>
														</td>
														<td>BUYERS'S PO NO.-</td>
														</tr>
														<tr>
															<td>DATE-</td>
														</tr>
														<tr>
															<td>DESPATCHED THROUGH- </td>
														</tr>
														<tr>
															<td>DESTINATION-</td>
														</tr>
														<tr>
															<td>BUYER-
															<br/><?= $purchase_order["billing_address"] ?>
															</tr>
															<tr>
														</td>
															<td>TERMS OF DELIVERY-</td>
														</tr>
													</tbody></table>
                            </textarea>
                            <table name="objectTable1" id="objectTable1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="2%">(#)</th>
                                        <th width="10%">Product Name</th>
                                        <th width="15%">Quantity</th>
                                        <th width="20%">Attributes</th>
                                        <th width="10%">Basic Price(in Rs.)</th>
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
                                                    $attr_values = $attributes_decoded[$key][$product];
                                                    $attributes_from_product = $product_details->attributes;
                                                    $sl_count = 0;
                                                    $attributes_from_product_decoded = json_decode($attributes_from_product, true);
                                                    foreach ($attr_values as $key_new => $value_attr) {
                                                        //echo $key_new;
                                                        echo ($attributes_from_product_decoded["data"][$key_new]) ? $attributes_from_product_decoded["data"][$key_new] : "";
                                                        $atr = "attr" . ($key_new + 1);
                                                        $attribute_value = $this->attribute_model->get_attribute_value($product, $atr);
                                                        ?>
                                                        <select class="form-control form-control-sm attr_values" name="product_attr[]">
                                                            <option>Please Select</option>
                                                            <?php foreach ($attribute_value as $value) { ?>
                                                                <option value="<?= $value->attr_value; ?>" <?= ($value_attr == $value->attr_value) ? "selected" : ""; ?>><?= $value->attr_value ?>
                                                                </option>
                                                                <?php }
                                                            ?>
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
                                                <label>Frieght Per Unit</label>
												<input type="text" class="form-control form-control-sm frieght_unit_cal" name="frieght_unit_price[]" />
                                                <label>Tax Rate(%)</label>
                                                <input type="text" class="form-control form-control-sm tax_rate" name="tax_rate[]" value="<?= $product_details->tax_rate; ?>" readonly />
                                            </td>
                                            <td class="text-left calculation-form">
                                                CGST<input type="text" class="form-control form-control-sm cgst_cal" name="cgst[]" value="<?php echo $cgst_decoded[$key]; ?>" readonly />
                                                <div class="clearfix"></div>
                                                SGST<input type="text" class="form-control form-control-sm sgst_cal" name="sgst[]" value="<?php echo $sgst_decoded[$key]; ?>" readonly />
                                                <div class="clearfix"></div>
                                                IGST
                                                <input type="text" class="form-control form-control-sm igst_cal" name="igst[]" value="<?php echo $igst_decoded[$key]; ?>" readonly />
                                                <div class="clearfix"></div>
                                                Ex-yard<input type="text" class="form-control form-control-sm exyard_cal" name="exyard[]" value="<?= $exyard_decoded[$key] ?>" readonly />
                                                <div class="clearfix"></div>
                                                Frieght<input type="text" class="form-control form-control-sm frieght_cal" name="frieght[]" value="<?= $frieght_decoded[$key] ?>" readonly />
                                                <div class="clearfix"></div>
                                                Total<input type="text" class="form-control form-control-sm total_price_cal" name="total_price[]" value="<?= $total_decoded[$key] ?>" readonly />
                                            </td>
                                            <td class="text-left"><a href="#!" class="btn btn-sm btn-danger remove_tr"><i class="fa fa-times-circle"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $slnew++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div align="right">
                                <a class="btn btn-sm btn-warning add_new_product" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                            <textarea id="editordata2" name="editordata2">
												<p><table class="table table-bordered">
														<tbody>
															<tr>
																<td>BANK DETAILS -</td>
																<td>&nbsp;&nbsp;</td>
																</tr>
															<tr>
																<td>THIS IS A COMPUTER GENERATED DOCUMENT, HENCE DOES NOT REQUIRE SIGNATURE</td>
																</tr>
															<tr>
																<td>
																SUBJECT TO GUWAHATI JURISDICTION
														    	</td>
																</tr>
																<tr>
																	<td colspan="2">
																	<u>Terms &amp; Conditions -</u>
												<br /> 1) PAYMENT -100% ADVANCE AGAINST PROFORMA INVOICE
												<br />2) A quantity variation of +/-5% on the ordered quantity is applicable for closing the order.
												<br />3) Material shall be supplied as per ordered grade in standard length if the order is not for customized length.
												<br />4) Payment – 100% advance against Proforma Invoice. <br />
																	</td>
																</tr>
														</tbody>
													</table>
															</p>
                            </textarea>
                            <br />
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Regards, <?php echo form_error('send_from'); ?></label>
                                    <textarea type="text" class="form-control form-control-sm" name="send_from" id="send_from">Supply Origin G.S. Road Bhangagarh Guwahati</textarea>
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
<link rel="stylesheet" href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>">
<script type="text/javascript" src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
<script>
    $(document).ready(function () {
        $(document).on('change', '.product_select_option', function () {
            var attr = $(this);
            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "<?= base_url('admin/attribute/get_attribute_for_order/'); ?>",
                data: {
                    product: id
                },
                dataType: 'html',
                success: function (htm) {
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
                success: function (jsn) {
                    attr.parent().parent().children().children('.tax_rate').val(jsn.tax_rate);
                }
            });
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
        $('#editordata').summernote({
            placeholder: 'Type your message here',
            //var a = $('#form-enquiry_id-9102').val();
            tabsize: 2,
            height: 350
        });
        $('#editordata2').summernote({
            placeholder: 'Type your message here',
            tabsize: 2,
            height: 350
        });
    var slno = 1;
    $(document).on("click", ".remove_tr", function () {
        $(this).parent().parent().remove();
    });
    $(document).on("click", ".add_new_product", function () {
        $('#objectTable1').append('<tr><td>' + slno + '</td>\
            <td><select class="form-control form-control-sm product_select_option" name="product_id[]">\
                            <option  >Please Select</option>\
<?php
foreach ($product_id as $p) {
    echo '<option value="' . $p->id . '">' . $p->product_name . '</option>';
}
?></td><td class = "text-left">\
<input type="text" class="quantity_cal col-md-6 padding-zero" name="quantity[]"> \
<select class="padding-zero" name="product_unit[]" id="product_unit[]"> \
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
        </td > <td> <a href = "#!" class = "btn btn-danger remove_tr"> <i class = "fa fa-times-circle" > </i> </a> </td> </tr> \
');
sl++;
});
});
</script>