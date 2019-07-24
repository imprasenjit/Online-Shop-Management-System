
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-status-wrap">
                        <h4 align="center">New Enqiry Entry</h4>
                            <form action="<?= base_url(); ?>admin/orders/save_order" method="post" id="myform">
								
								<!--<div class="row">
									<label class="col-md-4 text-left">Select Customer</label>
									<div class=" col-md-4 form-group">
										<select class="form-control" name="sel_customer" id="sel_customer">
										
										   <?php
												$customers = $this->orders_model->get_customer();
												//print_r($customers); die();
												foreach ($customers as $customer) {
													?>                                   
													<option value="<?= $customer->id; ?>" <?php if ($customer->id == $sel_customer) echo 'selected="selected"'; ?>><?= $customer->name; ?></option>
												<?php } ?> 
			 
										</select>
									</div>
									
								</div>-->
								
								<br/>
								
								<div class="control-group">
									<tr>
										<td colspan="4">Enter details of the Product :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
													<tr>
														<th width="10%">Sl No.</th>
														<th width="45%">Product Name</th>
														<th width="45%">Qty.</th>
														
													</tr>
												</thead> 
													<tr>
														<td><input value="1" id="slno" readonly="readonly" size="10" class="form-control text-uppercase" name="slno"></td>
														<td>
															<!--<input id="name[]" size="10" validate="letters" class="form-control text-uppercase" name="name[]">-->
															<select class="form-control" name="name[]" id="name[]">
																<?php
																	$products = $this->products_model->get_all();
																	foreach ($products as $product) {
																		?>                                   
																		<option value="<?= $product->id; ?>" <?php //if ($product->id == $product_name) echo 'selected="selected"'; ?>><?= $product->product_name; ?></option>
																	<?php } ?> 
							 
															</select>
														</td>
														
														<td><input id="quantity[]" size="10" validate="" class="form-control" name="quantity[]"></td>
														
													</tr>
											</table>
											
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-success" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-danger" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php // echo $hiddenval; ?>"/></div>
											
										</td>
									</tr>
									
								</div>
								
								<div class="control-group">
									<div align="center" style="margin-left:20px;margin-right:20px;">
											<h2 align="center">Customer Info</h2><br /><br />
											<table class="table table-responsive text-center">
												<tr><td>Your Name: </td><td><input class="form-control" type="text" name="name" required=""/></td></tr>
												<tr><td>Phone: </td><td><input class="form-control" type="text" name="contact"  required="" maxlength="10"/></td></tr>
												<tr><td>Email: </td><td><input class="form-control" type="text" name="email" required="" /></td></tr>
												<tr><td>Address: </td><td><textarea class="form-control" type="text" name="address" required=""></textarea></td></tr>
												<tr><td>
											</table>
									</div>
								</div>
								<br />
								
								
								<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
								<div align="center">
								<a href="<?php echo site_url('admin/orders') ?>" class="btn btn-default">Cancel</a>
								<a href="<?php echo site_url('admin/orders') ?>" class="btn btn-primary">Submit</a>
								<!--<button type="submit" class="btn btn-primary"><?php echo $button ?></button> -->
								</div>
							</form>
							
							
						</div>
                    </div>
                </div>
            </div>
    </div>
        
		
    <script>
		$(document).ready(function () {
			$('#myform').submit(function(e){
				if($('#customer').val()==""){
					e.preventDefault();  
					alert("Please Select customer");
				}
			});
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
		t1.size="20";	
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
        t2.id = "name"+index;
		t2.name = "name[]";
		t2.className = "form-control text-uppercase";
		t2.style="";
		t2.size="20";	
        cell2.appendChild(t2);
		
		var cell3=row.insertCell(2);
	    var t3=document.createElement("input");
		t3.id = "quantity"+index;
		t3.name = "quantity[]";
		t3.className = "form-control";
		t3.style="";
		t3.size="20";	
        cell3.appendChild(t3);
		
		/*var cell4=row.insertCell(3);
	    var t4=document.createElement("input");
		t4.id = "quantity"+index;
		t4.name = "quantity[]";
		t4.className = "form-control";
		t4.style="";
		t4.size="20";	
        cell4.appendChild(t4);
		
		var cell5=row.insertCell(4);
	    var t5=document.createElement("input");
		t5.id = "amount"+index;
		t5.name = "amount[]";
		t5.className = "form-control add_this_value";
		t5.style="";
		t5.size="20";	
        cell5.appendChild(t5);*/
      	index++;
		document.getElementById("hiddenval").value=index;
        
        $('.add_this_value').on('keyup', function(){
			var value;
			var price = $('#price');
			$('.add_this_value').each(function(){
				if(!isNaN(parseInt($(this).val()))){
					
					value = $(this).val();
					pro = 2 * parseFloat(value);
				}
				
			});
			amount.val(pro.toFixed(2));
		});
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
	
</script>
	