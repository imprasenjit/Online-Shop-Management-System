	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="profile-content" style="margin-top:10px;" id="print_html">
				Ref : With reference to purchase order No. <?= $purchase_order_id; ?>
				<div class="table-responsive" width="100%">
					<?= validation_errors(); ?>
					<table class="table table-bordered" id="proforma_table">
						<tbody>
							<tr>
								<td colspan="11" class="text-left">
									<?= $editordata ?>
								</td>
							</tr>
							<tr>
								<td>

									<?php
									$product_details = array(
										"productid" => $products,
										"others" => $others,
										"quantity" => $quantity,
										"product_unit" => $product_unit,
										"tax_rate" => $tax_rate,
										"attributes" => $attributes,
										"product_price" => $product_price,
										"cgst" => $cgst,
										"sgst" => $sgst,
										"igst" => $igst,
										"exyard" => $exyard,
										"frieght" => $frieght,
										"total" => $total,
									);
									$this->load->view("admin/products/product_table_format", array("product" => (object) $product_details));
									?>

								</td>
							</tr>
							<tr>
								<td>
									<?= $editordata2; ?>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
				<div style="margin-bottom:10px;" align="center">
					<a class="btn btn-sm btn-info" href="<?= base_url("customers/proforma_invoice"); ?>">Close</a>
					<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
				</div>

				</form>
			</div>

		</div>
	</div>
	<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(document).on("click", "#print_content", function() {
				//Print ele4 with custom options
				$("#print_html").print({
					//Use Global styles
					globalStyles: true,
					//Add link with attrbute media=print
					mediaPrint: true,
					//Custom stylesheet
					stylesheet: "<?= base_url("
					assets / admin / css / print.css "); ?>",
					//Print in a hidden iframe
					iframe: false,
					//Don't print this
					noPrintSelector: ".btn",
					//Add this at top
					prepend: "Purchase Order To Supplier",
					//Add this on bottom
					append: "<span><br/></span>",
					//Log to console when printing is done via a deffered callback
					deferred: $.Deferred().done(function() {
						console.log('Printing done', arguments);
					})

				});
			});
		});
	</script>