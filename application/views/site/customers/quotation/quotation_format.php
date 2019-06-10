<div class="product-status">
					<h3 align="center">Quotation</h3>
					<div align="right"><img src="<?= LOGO; ?>" class="img-fluid" style="width:200px;"></div>					
									<?php
									$qid = $this->uri->segment(4);
									$rowq = $this->quotation_model->get_by_id($qid);
									if ($rowq) {
										?>
										<label for="varchar">Quotation Date. <?php echo date('d-m-Y', strtotime($rowq->quotation_date)); ?></label><br />
										<label for="varchar">Quotation No. <?php echo $this->uri->segment(4); ?></label><br /><br />
										<label for="varchar">To <?php echo form_error('send_to') ?></label><br />
										<?php
										$enquiry_id = $rowq->enquiry_id;
										$cust_result = $this->enquires_model->get_by_id($enquiry_id);
										//print_r($result); die();
										$sl = 1;
										if ($cust_result) {
											$id = $cust_result->customerid;
											$name = $cust_result->name;
											$contact = $cust_result->contact;
											$email = $cust_result->email;
											$address = $cust_result->address;
											?>
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
									<?php } ?>
								
						<?php
						//print_r($cust_result);
						$results_product = $this->enquires_model->get_product_details($rowq->enquiry_id);
						$enq_unique_id = $cust_result->unique_id;
						$enquiry_placed_date = $cust_result->enquiry_placed_date;
						$sl = 1;
						if ($results_product) {
							?>
							<table class="table table-bordered" width="80%">
								<tbody>
									<tr>
										<td>
											<?php
											if ($rowq) {
												?>
												<p><?php echo $rowq->editordata; ?></p>
											<?php } ?>
											<!--<textarea id="editordata" name="editordata">
													Ref : With reference to Enquiry No.<strong>  <?php echo $enq_unique_id; ?> </strong>placed on  <?php echo date("d-m-Y", strtotime($enquiry_placed_date)); ?> .<br />
													Dear  <?php
															if ($name) {
																echo $name;
															} else {
																echo $this->customer_registration_model->get_by_id1($this->uri->segment(4))->name;
															}
															?> <br />
													We have pleasure in submitting our quotation as required.Please contact us if you have any queries. 
												</textarea>-->
										</td>
									</tr>
									<tr>
										<td>
											
												<table class="table table-hover" id="quotation" width="80%">
													<thead>
														<tr>
															<th>Sl No.</th>
															<th>Product Name</th>
															<th>Quantity</th>
															<th>Attributes</th>
															<th>Basic Price</th>
															<th>CGST@9%</th>
															<th>SGST@9%</th>
															<th>IGST@18%</th>
															<th>Ex-Yard(Rs./MT)</th>
															<th>Frieght (Cost/MT)</th>
														</tr>
													</thead>
													<?php
									$slno = 1;
									$quotation_id = $rowq->quotation_id;
									$enquiry_id = $rowq->enquiry_id;
									$productid = $rowq->productid;
									$quantity = $rowq->quantity;
									$attributes = $rowq->attributes;
									$product_price = $rowq->product_price;
									$cgst = $rowq->cgst;
									$sgst = $rowq->sgst;
									$igst = $rowq->igst;
									$exyard = $rowq->exyard;
									$frieght = $rowq->frieght;
									$email = $rowq->email;
									$editordata = $rowq->editordata;
									$editordata2 = $rowq->editordata2;
									$product_id_s = json_decode($productid, true);
									$quantity_decoded = json_decode($quantity, true);
									$attributes_decoded = json_decode($attributes, true);
									$product_price_decoded= json_decode($product_price, true);
									$product_id_decoded=array();
									foreach($product_id_s as $key=>$value){
										//print_r($key);die;
										array_push($product_id_decoded,$key);
									}
									$cgst_decoded = json_decode($cgst, true);
									$sgst_decoded = json_decode($sgst, true);
									$igst_decoded = json_decode($igst, true);
									$exyard_decoded = json_decode($exyard, true);
									$frieght_decoded = json_decode($frieght, true);
									foreach ($product_id_decoded as $key => $product) {
										?>
										<tr>
											<td class="text-left"><?= $slno; ?></td>
											<td class="text-left">
												<?php
												//print_r($product_id_decoded);
												$product_name_from_product = $this->products_model->get_by_id($product)->product_name;
												echo $product_name_from_product;
												?>
											</td>
											<td class="text-left">
												<?php
												print_r($key);
 															echo $quantity_decoded[$key];
												?>
											</td>
											<td class="text-left">
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
												<?php
													echo $product_price_decoded[$key];
												?>
											</td>
											<td class="text-left">
												<?php
												echo $cgst_decoded[$key];
												?>
											</td>
											<td class="text-left">
												<?php
											echo $sgst_decoded[$key];
												?>
											</td>
											<td class="text-left">
												<?php
												echo $igst_decoded[$key];
												?>
											</td>
											<td class="text-left">
												<?php
												echo $exyard_decoded[$key]
												?>
											</td>
											<td class="text-left">
												<?php
													echo $frieght_decoded[$key];
												?>
											</td>
										</tr>
										<?php
										$slno++;
									}} ?>
											</table>
										
									</td>
								</tr>
								<tr>
									<td>
										<?php
										if ($rowq) {
											?>
											<p><?php echo $rowq->editordata2; ?></p>
										<?php } ?>
									</td>
								</tr>
							</tbody>
						</table>
						<br />
						<div class="row">
							<div class="form-group">
								<div class="col-md-8"></div>
								<div class=" col-md-4">
									<label for="varchar">Regards, <?php echo form_error('send_from') ?></label>
									<textarea type="text" readonly><?php echo "Supply Origin \nG.S. Road Bhangagarh \nGuwahati "; ?></textarea>
								</div>
							</div>
						</div>
						<div align="center">
							<a href="<?= base_url(); ?>admin/quotation" class="btn btn-primary">Close</a>
						</div>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#editordata').summernote('disable');
	$('#editordata2').summernote('disable');
	$('#editordata').summernote({
		placeholder: 'Type your message here',
		//var a = $('#form-enquiry_id-9102').val();
		tabsize: 2,
		height: 200
	});
	$('#editordata2').summernote({
		placeholder: 'Type your message here',
		tabsize: 2,
		height: 150
	});
</script>