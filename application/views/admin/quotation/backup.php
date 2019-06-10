
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="product-status-wrap">
				<h3 align="center">Quotation</h3>
				<div align="right"><img src="<?=LOGO;?>" class="img-fluid"></div>
					<form class="form-horizontal" action="<?=base_url();?>quotation/create_action/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" id="myform">
						<div class="row" style="margin-left:2px;">
							<div class="form-group">
								<div class=" col-md-6">
								<?php
								$order_id=$this->uri->segment(3);
								$result = $this->orders_model->get_by_id($order_id);
								$sl = 1;
								if ($result) {									    									
									    $id = $result->customerid;
										$name = $result->name;
										$contact = $result->contact;
										$email = $result->email;
										$address = $result->address;
									?>
									<label for="varchar">Date. <?php  echo date("d-m-Y"); ?> </label><br/>
									<label for="varchar">Quotation No.  </label><br/>
									<label for="varchar">To <?php echo form_error('send_to') ?></label><br/>
									<!--<input type="text" class="form-control" name="send_to" id="send_to" placeholder="To :" value="<?php echo $send_to; ?>" />-->
									<?= $name?><br>
									<?= $contact?><br>
									<?= $email?><br>
									<?= $address?><br>
									<div class="col-md-4">
									<input type="hidden" class="form-control" name="enquiry_id" id="enquiry_id" value="<?php echo $this->uri->segment(3); ?>" readonly/>
									<input type="hidden" class="form-control" name="send_to" id="send_to" value="<?php echo $email; ?>" readonly/></div>
									<br/>
										<?php
                                            $sl++;
                                        }
                                        ?>							
								</div>
							</div>
						</div>
							<?php
								$order_detail_id=$this->uri->segment(3);
								//echo $order_detail_id;
								$results = $this->orders_model->get_product_details($order_detail_id);
								$enq_unique_id = $this->orders_model->get_enquiry_details2($order_detail_id)->unique_id;
								$enquiry_placed_date = $this->orders_model->get_enquiry_details2($order_detail_id)->order_placed_date;
								$sl = 1;
								if ($results) {
							?>
							<table class="table table-bordered" >
								<thead>
									<tr>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<textarea id="editordata" name="editordata">
												Ref : With reference to Enquiry No.<strong>  <?php echo $enq_unique_id; ?> </strong>placed on  <?php echo date("d-m-Y", strtotime($enquiry_placed_date)); ?> .<br />
												Dear  <?php
												if($name){
													echo $name; 
												}else{ 
													echo $this->customer_registration_model->get_by_id1($this->uri->segment(3))->name;
												}	
												?> <br />
												Thank-you for your enquiry. <br/><br/>
												We are pleased to quote our lowest rates for your requirement -
											</textarea>
										</td>
									</tr>
									<tr>
										<td>
										<div class="col-md-12">
										<table name="objectTable1" id="objectTable1" class="table table-bordered">
										<thead>
											<tr>
												<th width="2%">Sl No.</th>
												<th width="10%">Product Name</th>
												<th width="10%">Quantity</th>
												<th width="20%">Attributes</th>
												<!--<th width="10%">Price(in Rs.)</th>
												<th width="8%">CGST@9%</th>
												<th width="8%">SGST@9%</th>
												<th width="8%">IGST@18%</th>
												<th width="8%">Ex-Yard(Rs./MT)</th>
												<th width="8%">Frieght (Cost/MT)</th>-->
												<th width="8%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										foreach ($results as $products) {
											$id = $products->id;
											$productname = $this->products_model->get_by_id($products->productid)->product_name;
											$quantity = $products->quantity;
											$attributes = $products->attributes;
										?>
											<tr>
												<td class="text-left"><input type="text" class="form-control" name="slno[]" id="slno[]" value="<?= $sl; ?>" readonly></td>
												<?php  $product_id=$this->products_model->get_all();?>
												<td class="text-left"><select class="form-control" name="product_id" id="product_id">
													<option value="" >Please Select</option>
													<?php foreach ($product_id as $p){ ?>
														<option value="<?= $p->id ?>"><?= $p->product_name ?></option>
													<?php } ?>                          
												</select>
												</td>
												<!--<td class="text-left"><input type="text" class="form-control" name="productname[]" id="productname[]" value="<?= $productname;?>" ><input type="hidden" name="productid" id="productid" value="<?= $products->productid;?>"></td>-->
												<td class="text-left"><input type="text" class="form-control" name="quantity[]" id="quantity[]" value="<?= $quantity; ?> " ></td>
												<td class="text-left"><?php /*
												$attributes_arr = json_decode($attributes);
												foreach ($attributes_arr as $key=>$attr_value){
													echo "$key : $attr_value\n";
												} 
												*/
												?>
												<?php 
												if($attributes!=""){
													$attributes_decoded=json_decode($attributes,true);
													$sl=1;
													foreach ($attributes_decoded["attributes"] as $key=>$values) {
														if($values[0]!=""){
															//echo $values[0];
															//echo " : ";
															//echo $values[1];
															//echo "<br/>";
														}
														?>
														<input type="text" class="form-control" name="attributes[]" id="attributes[]" value="<?php  echo $values[0];
															echo " : ";
															echo $values[1];?> " >
												<?php	
													}
												}
												?>
												<div id="attributes"> </div>
												</td>
												<td class="text-left"><input type="text" class="form-control" name="product_price[]" id="product_price[]" placeholder="Enter Product Price (in Rs.)" value="" /></td>
												<!--td class="text-left"><input type="text" class="form-control" name="cgst[]" id="cgst[]" placeholder="@9%" value="" /></td>
												<td class="text-left"><input type="text" class="form-control" name="sgst[]" id="sgst[]" placeholder="@9%" value="" /></td>
												<td class="text-left"><input type="text" class="form-control" name="igst[]" id="igst[]" placeholder="@18%" value="" /></td>
												<td class="text-left"><input type="text" class="form-control" name="exyard[]" id="exyard[]" placeholder="(in Rs./MT)" value="" /></td>
												<td class="text-left"><input type="text" class="form-control" name="frieght[]" id="frieght[]" placeholder="(Cost/MT)" value="" /></td>
												--><td class="text-left"><a href="<?=base_url();?>orders/delete/<?= $id ?>"]><button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger"  onclick="<?=base_url();?>orders/delete/<?= $id ?>"><i class="fa fa-times-circle"></i></button></a> 
												</td>
											</tr>
											<?php
												$sl++;
											}
											?>
										</tbody>
									</table>
									<div align="right">
											<button type="button" class="btn btn-warning" onclick="addMore1()" value=""><i class="fa fa-plus" aria-hidden="true"></i></button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-danger" value=""><i class="fa fa-minus" aria-hidden="true"></i></button>
											<input type="hidden" id="hiddenval" name="hiddenval" value=""/>
									</div>
									</div>
							<?php } else {   ?>
									<h3>No records found!</h3>
							<?php }   ?>
										</td>
									</tr>
									<tr>
										<td>
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
										</td>
									</tr>
								</tbody>
							</table>
						<br />		
						<div class="row" style="margin-right:2px;">
							<div class="form-group">
								<div class="col-md-9"></div>
								<div class=" col-md-3">
									<label for="varchar">Regards, <?php echo form_error('send_from') ?></label>
									<textarea type="text" class="form-control" name="send_from" id="send_from" placeholder="From : "><?php echo "Supply Origin \nG.S. Road Bhangagarh \nGuwahati "; ?></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
						<div align="center">
							<a href="<?php echo site_url('quotation') ?>" class="btn btn-default">Cancel</a>
							<button type="submit" class="btn btn-primary">Send Quotation</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('#editordata').summernote({
        placeholder: 'Type your message here',
		//var a = $('#form-enquiry_id-9102').val();
        tabsize: 2,
        height: 200
      });
$('#editordata2').summernote({
        placeholder: 'Type your message here',
        tabsize: 2,
        height: 350
      });
</script>
<?php
if(isset($id)){
	//$part1="SELECT id FROM orders WHERE id='$id'";
	//$num = $part1->num_rows;
	$num=0;
}else{
	$num=0;
}
if($num>0){
	$hiddenval=$num+1;
	$num=$num+1;
}else{
	$hiddenval=2;
	$num=2;
}
?>
<script type="text/javascript">
	var index=<?php echo $num;?>;
	function addMore1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);
        var cell1=row.insertCell(0);
        var t1=document.createElement("input");
        t1.id = "slno"+index;
		t1.name = "slno"+index;
		t1.className = "form-control text-uppercase";
		t1.style="";
		t1.size="5";	
		t1.readOnly=true;
		t1.value=index;
		cell1.appendChild(t1);
		/*var cell2=row.insertCell(1);		
		var array1 = document.createElement("option");
		//Create and append select list
		var t2 = document.createElement("select");
		t2.setAttribute("name", "name"+index);
		t2.className = "form-control text-uppercase";
		cell3.appendChild(t2);
		//Create and append the options
		for (var i = 0; i < array1.length; i++) {
			var option = document.createElement("option");
			option.setAttribute("value");
			option.text = array1[i];
			t2.appendChild(option);
		}*/
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "productname"+index;
		t2.name = "productname[]";
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="30";	
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "quantity"+index;
		t3.name = "quantity[]";
		t3.type = "number";
		t3.className = "form-control";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "attributes"+index;
		t4.name = "attributes[]";
		t4.className = "form-control";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "product_price"+index;
		t5.name = "product_price[]";
		t5.className = "form-control add_this_value";
		t5.style="";
		t5.size="25";	
        cell5.appendChild(t5);
		var cell6=row.insertCell(5);
	    var t6=document.createElement("input");
		t6.id = "cgst"+index;
		t6.name = "cgst[]";
		t6.className = "form-control add_this_value";
		t6.style="";
		t6.size="25";	
        cell6.appendChild(t6);
		var cell7=row.insertCell(6);
	    var t7=document.createElement("input");
		t7.id = "sgst"+index;
		t7.name = "sgst[]";
		t7.className = "form-control add_this_value";
		t7.style="";
		t7.size="25";	
        cell7.appendChild(t7);
		var cell8=row.insertCell(7);
	    var t8=document.createElement("input");
		t8.id = "igst"+index;
		t8.name = "igst[]";
		t8.className = "form-control add_this_value";
		t8.style="";
		t8.size="25";	
        cell8.appendChild(t8);
		var cell9=row.insertCell(8);
	    var t9=document.createElement("input");
		t9.id = "exyard"+index;
		t9.name = "exyard[]";
		t9.className = "form-control add_this_value";
		t9.style="";
		t9.size="25";	
        cell9.appendChild(t9);
		var cell10=row.insertCell(9);
	    var t10=document.createElement("input");
		t10.id = "frieght"+index;
		t10.name = "frieght[]";
		t10.className = "form-control add_this_value";
		t10.style="";
		t10.size="25";	
        cell10.appendChild(t10);
      	index++;
		document.getElementById("hiddenval").value=index;
	}
	function mydelfunction1(){
		if(index>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index--;
			document.getElementById("hiddenval").value=index;
		}
	}
	/* Amount total */
	$("#product_id").change(function () {
            var id = $(this).val();//alert(id);die();
			var divid = "#pid"+id;
			$(".hideall").hide();
			$(divid).show();
                $.ajax({
                    type: "post",
                    url: "<?= base_url('attribute/getAttributesDetails/"+id+"') ?>",
					dataType:'json',
                    success: function (res) {
						$('#attributes').empty();
						var data=jQuery.parseJSON( res ) ;	
						$(data.data).each(function(key,value){
							$('#attributes').append('<div class="form-group"> <label class="col-md-5">'+value+': </label> <div class="col-md-7"> <input value="" id="attributes'+(key+1)+'" class="form-control attr_values" size="10" name="attributes'+(key+1)+'"> </div> </div>');
						});					
                       console.log(data.data);
                    }
                });
    });
</script>
