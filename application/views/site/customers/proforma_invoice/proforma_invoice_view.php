	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="profile-content" style="margin-top:10px;" id="print_html">

					<div class="table-responsive" width="100%" >
						<?=validation_errors();?>
						<table class="table table-bordered" id="proforma_table">
							<tbody>
									<tr>
										<td colspan="11" class="text-left">
											<?=$editordata?>
										</td>
									</tr>
									<tr>
										<td>
											<table name="objectTable1" id="objectTable1" class="table table-bordered">
												<thead>
													<tr>
														<th width="2%">Sl No.</th>
														<th width="10%">Product Name</th>
														<th width="10%">Quantity</th>
														<th width="20%">Attributes</th>
														<th width="10%">Basic Price(in Rs.)</th>
														<th width="20%">Required Details</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php
                                                    $sl = 1;
                                                    $product_id_s = json_decode($products, true);
                                                    $temp=array();
                                                    foreach ($product_id_s as $key => $product) {
                                                        array_push($temp,$key);
                                                    }
                                                    $product_ids=$temp;
													$quantity_decoded = json_decode($quantity, true);
													$product_unit_decoded = json_decode($product_unit, true);
													$attributes_decoded = json_decode($attributes, true);
													$product_price_decoded = json_decode($product_price, true);
													$cgst_decoded = json_decode($cgst, true);
													$sgst_decoded = json_decode($sgst, true);
													$igst_decoded = json_decode($igst, true);
													$exyard_decoded = json_decode($exyard, true);
													$frieght_decoded = json_decode($frieght, true);
													$total_decoded = json_decode($total, true);
													foreach ($product_ids as $key => $product) {

														$productname = $this->products_model->get_by_id($product);
														$productname=!empty($productname)?$productname->product_name : "";
														?>
														<tr>
															<td class="text-left"><?= $sl; ?></td>
															<td class="text-left">
																<?= $productname; ?>
															</td>
															<td class="text-left">
																<?=$quantity_decoded[$key]; ?>
																<?= $product_unit_decoded[$key]; ?>
															</td>
															<td class="text-left attribute_place">
																<?php
																foreach ($attributes_decoded[$key] as $product_key => $attr) {
																	$attributes_from_product = $this->products_model->get_by_id($product_key)->attributes;
																	$attributes_from_product_decoded = json_decode($attributes_from_product, true);
																	foreach ($attributes_from_product_decoded["data"] as $keyattr => $values) {
																		echo $values . ' : ' . $attr[$keyattr] . '<br/>';
																	}
																}
																?>
															</td>
															<td class="text-left">
																<?= $product_price_decoded[$key] ?>
															<td class="text-left">
																CGST : <?php echo $cgst_decoded[$key]; ?><br/>
																SGST : <?php echo $sgst_decoded[$key]; ?><br/>
																IGST : <?php echo $igst_decoded[$key]; ?><br/>
																Ex-yard : <?= $exyard_decoded[$key] ?><br/>
																Frieght : <?= $frieght_decoded[$key] ?><br/>
																<?php $total = (int)$cgst_decoded[$key] + (int)$sgst_decoded[$key] + (int)$igst_decoded[$key] + (int)$exyard_decoded[$key] + (int)$frieght_decoded[$key]; ?>
																Total : <?= $total ?>
															</td>
														</tr>
														<?php
														$sl++;
													}
													?>
												</tbody>
											</table>
										</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?=$editordata2;?>
                                        </td>
                                    </tr>
							</tbody>
						</table>

					</div>
					<div style="margin-bottom:10px;" align="center">
						<a class="btn btn-sm btn-info" href="<?=base_url("customers/proforma_invoice");?>">Close</a>
						<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
					</div>

				</form>
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
