<div class="container">
<div class="row">
<div class="col-md-12">
<?php
	$enquiry_id = $this->uri->segment(4);
	$customerid = $this->uri->segment(5);
	$res = $this->enquires_model->get_by_id($enquiry_id);
	if($res){
		?>
		<p align="justify">To, </p>
		<p align="justify"><?= $res->name; ?><br /><?= $res->address; ?><br /><?= $res->contact; ?> | <?= $res->email; ?></p>


		<?php }
?>
<?php
$editordata= $this->quotation_model->get_by_id($qid)->editordata; //$qid passes through controller
 ?>
<p align="justify"><?php echo $editordata ?></p><br />

<div class="table-responsive">
<table class="table table-hover" id="quotation" style="width:100%">
	<thead>
	   <tr>
			<th width="2%">Sl No.</th>
			<th width="10%">Product Name</th>
			<th width="8%">Quantity</th>
			<th width="5%">UOM</th>
			<th width="20%">Attributes</th>
			<th width="15%">Others</th>
			<th width="10%">Price (in Rs.)</th>
			<th width="9%">CGST@9%</th>
			<th width="9%">SGST@9%</th>
			<th width="9%">IGST@18%</th>
			<th width="9%">Ex-Yard(Rs./MT)</th>
			<th width="9%">Frieght (Cost/MT)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$enquiry_id = $this->uri->segment(4);
		$enq_unique_id = $this->enquires_model->get_enquiry_details_by_enquery_id($enquiry_id)->unique_id;
		$results = $this->quotation_model->get_by_price($qid); //$qid passes through controller
		$s = 0;
		if ($results) {
			foreach ($results as $row) {

				$id = $row->id;
				$product_id = $row->productid;
				$quantity = $row->quantity;
				$product_unit = $row->product_unit;
				$attributes = $row->attributes;
				$product_price = $row->product_price;
				$others = $row->others;
				$cgst = $row->cgst;
				$sgst = $row->sgst;
				$igst = $row->igst;
				$exyard = $row->exyard;
				$frieght = $row->frieght;
				$editordata3 = $row->editordata;
				$editordata2 = $row->editordata2;


		?>
		<tr>
			<td class="text-left"><?= $s+1; ?></td>
			<td class="text-left"><?= $enq_unique_id; ?></td>
			<td class="text-left"><?php
												$product_id_decoded=json_decode($product_id,true);
												foreach ($product_id_decoded as $ked=>$product) {
													//print_r($ked);
													$product_name_from_product = $this->products_model->get_by_id($ked)->product_name;
														echo $product_name_from_product;
														echo '<hr/>';
												}

											?>
			</td>
			<td class="text-left">
				<?php
						if($quantity!=""){
							$quantity_decoded=json_decode($quantity,true);
							//print_r($quantity_decoded);
							$sl=1;
							foreach ($quantity_decoded as $key=>$values) {
								if($values!=""){
									echo $values;
									echo "<br/>";
								}
							}
						}
				?>

			</td>
			<td class="text-left">
				<?php
						if($product_unit!=""){
							$product_unit_decoded=json_decode($product_unit,true);
							//print_r($quantity_decoded);
							$sl=1;
							foreach ($product_unit_decoded as $key=>$values) {
								if($values!=""){
									echo $values;
									echo "<br/>";
								}
							}
						}
				?>

			</td>
			<td class="text-left"><?php
												$attributes_decoded=json_decode($attributes,true);
												foreach ($attributes_decoded as $ked=>$attr) {
													foreach($attr as $product_key => $attr){
																$attributes_from_product = $this->products_model->get_by_id($product_key)->attributes;
																$attributes_from_product_decoded=json_decode($attributes_from_product,true);
                                                                foreach($attributes_from_product_decoded["data"] as $keyattr=>$values){
																			echo $values.' : '.$attr[$keyattr].'<br/>';
																}
															}
													echo '<hr/>';
												}

											?>
			</td>
			<td class="text-left">
				<?php
						if($others!=""){
							$others_decoded=json_decode($others,true);
							$sl=1;
							foreach ($others_decoded as $key=>$values) {
								if($values!=""){
									echo $values;
									echo "<br/>";
								}
							}
						}
				?>
			</td>
			<td class="text-left">
				<?php
						if($product_price!=""){
							$product_price_decoded=json_decode($product_price,true);
							//print_r($quantity_decoded);
							$sl=1;
							foreach ($product_price_decoded as $key=>$values) {
								if($values!=""){
									echo $values;
									echo "<br/>";
								}
							}
						}
				?>
			</td>
			<td class="text-left">
				<?php
					if($cgst!=""){
						$cgst_decoded=json_decode($cgst,true);
						//print_r($quantity_decoded);
						$sl=1;
						foreach ($cgst_decoded as $key=>$values) {
							if($values!=""){
								echo $values;
								echo "<br/>";
							}
						}
					}
				?>
			</td>
			<td class="text-left">
				<?php
					if($sgst!=""){
						$sgst_decoded=json_decode($sgst,true);
						//print_r($quantity_decoded);
						$sl=1;
						foreach ($sgst_decoded as $key=>$values) {
							if($values!=""){
								echo $values;
								echo "<br/>";
							}
						}
					}
				?>
			</td>
			<td class="text-left">
				<?php
					if($igst!=""){
						$igst_decoded=json_decode($igst,true);
						//print_r($quantity_decoded);
						$sl=1;
						foreach ($igst_decoded as $key=>$values) {
							if($values!=""){
								echo $values;
								echo "<br/>";
							}
						}
					}
				?>
			</td>
			<td class="text-left">
				<?php
					if($exyard!=""){
						$exyard_decoded=json_decode($exyard,true);
						//print_r($quantity_decoded);
						$sl=1;
						foreach ($exyard_decoded as $key=>$values) {
							if($values!=""){
								echo $values;
								echo "<br/>";
							}
						}
					}
				?>
			</td>
			<td class="text-left">
				<?php
					if($frieght!=""){
						$frieght_decoded=json_decode($frieght,true);
						//print_r($quantity_decoded);
						$sl=1;
						foreach ($frieght_decoded as $key=>$values) {
							if($values!=""){
								echo $values;
								echo "<br/>";
							}
						}
					}
				?>
			</td>
		</tr>
		<?php
			$s++;

			}
		}
       ?>
	</tbody>
</table>
</div>
<p align="justify"><?php echo $editordata2; ?></p><br />
<p align="justify">Regards, <br /> Supply Origin <br />G.S. Road Bhangagarh <br /> Guwahati</p>
</div>
</div>
</div>
