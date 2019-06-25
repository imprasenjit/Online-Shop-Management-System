<?php //echo '<pre>';print_r($product->attributes);die;
if ($product) {
							?>
							<table class="table table-hover table-bordered" id="quotation">
								<thead>
									<tr class="text-center">
										<th>(#)</th>
										<th>Product Name</th>
										<th>HSN/SAC</th>
										<th>Quantity</th>
										<th>Basic Price</th>
										<th>Basic Total</th>
										<th>Tax(%)</th>
										<th>CGST</th>
										<th>SGST</th>
										<th>IGST</th>
										<th>Ex-Yard (Per Unit)</th>
										<th>Frieght</th>
										<th>Total</th>
									</tr>
								</thead>
								<?php
								$slno = 1;
								$product_id_s = json_decode($product->productid, true);
								$others_decoded = json_decode($product->others, true);
								$quantity_decoded = json_decode($product->quantity, true);
								$product_unit_decoded = json_decode($product->product_unit, true);
								$tax_rate_decoded = json_decode($product->tax_rate, true);
								$attributes_decoded = json_decode($product->attributes, true);
								$product_price_decoded = json_decode($product->product_price, true);
								$cgst_decoded = json_decode($product->cgst, true);
								$sgst_decoded = json_decode($product->sgst, true);
								$igst_decoded = json_decode($product->igst, true);
								$exyard_decoded = json_decode($product->exyard, true);
								$frieght_decoded = json_decode($product->frieght, true);
								$total_decoded = json_decode($product->total, true);
								foreach ($product_id_s as $key => $product) {
                                    $product_details = $this->products_model->get_by_id($product);
									?>
									<tr>
										<td class="text-left"><?= $slno; ?></td>
										<td class="text-left">
											<?php
											echo $product_details->product_name;
											echo '<br/><small>';
											foreach ($attributes_decoded[$key] as $product_key => $attr) {
												$attributes_from_product = $product_details->attributes;
												$attributes_from_product_decoded = json_decode($attributes_from_product, true);
												foreach ($attributes_from_product_decoded["data"] as $keyattr => $values) {
													if(!empty($attr[$keyattr])){
														echo $values . ' : ' . $attr[$keyattr] . '<br/>';
													}

												}
											}
											?>
											<?php
											echo 'Others : '.$others_decoded[$key];
											?>
											</small>
										</td>
										<td class="text-left">
											<?=	$product_details->hsn_code?>

										</td>
										<td class="text-left">
											<?php

											echo $quantity_decoded[$key] . ' ';
											echo $product_unit_decoded[$key];
											?>
										</td>

										<td class="text-left">
											<?php
											echo '&#8377;' . $product_price_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . ($quantity_decoded[$key]*$product_price_decoded[$key]);
											?>
										</td>
										<td class="text-left">
											<?php
											echo $tax_rate_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $cgst_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $sgst_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $igst_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $exyard_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $frieght_decoded[$key];
											?>
										</td>
										<td class="text-left">
											<?php
											echo '&#8377;' . $total_decoded[$key];
											?>
										</td>
									</tr>
									<?php
									$slno++;
								}
							} ?>
						</table>
