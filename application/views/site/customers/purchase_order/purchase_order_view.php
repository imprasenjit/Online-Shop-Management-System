	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
		<?php echo $this->breadcrumbs->show(); ?>
			<div class="panel-group">
				<div class="panel panel-default">
				<div class="panel-heading">
						Purchase Order
						<span class="pull-right">Purchase Order Ref: <?=$potoadmin_ref?></span>
				</div>
					<div class="panel-body" id="print_html">
						<table class="table table-bordered">
											<br />
											To,<br />
											Hitech Industries<br />
											Guwahati<br />
											Subject: Purchase Order<br />
											Format for product selection &amp; tax calculation as per Quotation and PI given previously.<br />
											Terms &amp; Conditions valid as per quotation received.<br /><br/>
											Ref : With reference to Quotation No. <?=$quotation_ref?> 
										
                                                    <?php
													$product_id_s = json_decode($product, true);
													$quantity_decoded = json_decode($quantity, true);
													$product_unit_decoded = json_decode($unit, true);
													$attributes_decoded = json_decode($attributes, true);
													$product_price_decoded = json_decode($price, true);
													$cgst_decoded = json_decode($cgst, true);
													$sgst_decoded = json_decode($sgst, true);
													$igst_decoded = json_decode($igst, true);
													$exyard_decoded = json_decode($exyard, true);
													$frieght_decoded = json_decode($frieght, true);
													$total_decoded = json_decode($total, true);
													$product_details = array(
														"productid" => $product,
														"others" => $others,
														"quantity" => $quantity,
														"product_unit" => $unit,
														"tax_rate" => $tax_rate,
														"attributes" => $attributes,
														"product_price" => $price,
														"cgst" => $cgst,
														"sgst" => $sgst,
														"igst" => $igst,
														"exyard" => $exyard,
														"frieght" => $frieght,
														"total" => $total,
													);
													$this->load->view("admin/products/product_table_format", array("product" => (object)$product_details));
													?>

					</div>
					<div class="panel-footer">
					<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
						<a href="<?= base_url("customers/purchase_order/");?>" class="btn btn-sm btn-primary">Close</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>

	<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
	<script type="text/javascript">
	$(document).ready(function(){
			$(document).on("click","#print_content",function(){
											//Print ele4 with custom options
											$("#print_html").print({
													//Use Global styles
													globalStyles : true,
													//Add link with attrbute media=print
													mediaPrint : true,
													//Custom stylesheet
													stylesheet : "<?=base_url("assets/admin/css/print.css");?>",
													//Print in a hidden iframe
													iframe : false,
													//Don't print this
													noPrintSelector : ".btn",
													//Add this at top
													prepend : "Purchase Order To Supplier",
													//Add this on bottom
													append : "<span><br/></span>",
													//Log to console when printing is done via a deffered callback
													deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })

											});
									});
									});

	</script>
