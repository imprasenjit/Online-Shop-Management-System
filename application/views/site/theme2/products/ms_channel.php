<br/>
<div class="container">	
	<div class="row">
		<div class="col-md-12" >
			<div class="col-md-3">
				<?php $this->load->view('requires/sidenavbar'); ?>
			</div>
			<div class="col-md-9">
				<div class="panel panel-dark">
					<div class="panel-heading panel-primary">
						<i class="fa fa-braille fa-fw"></i> Ms Channel
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-5">									
							<?php foreach ($byproducts_data as $byproducts)
								{	
								?>
								<img src="<?php echo $byproducts->picture ?>" >
							</div>								
							<div class="col-md-7 "><br />
								<form id="addtocart" method="post" action="<?=base_url();?>shopping/add">	
								
									
									<?php
										$product_id= $byproducts->id ;
										//echo $product_id; die();
									    $attribute_list = $this->products_model->get_by_id_ms_channel($product_id);
										$attributes= $byproducts->attributes ;
										if($attribute_list!=NULL){
											$jsonData = stripslashes(html_entity_decode($attributes));
											$jsonDecode = json_decode(''.$jsonData.'',TRUE);
										foreach ($jsonDecode[0] as $attr){ 
										
										?>
										<div class="form-group">
											<label class="col-md-5 pull-left"><?=$attr?> : </label>
											<div class="col-md-7">
												<input value="" id="attributes[]" class="form-control" size="10" name="attributes[]">
											</div><br/>
										</div>
										<?php	} 
										}
									?>
									
									<label class="col-md-5 pull-left form-group">Others : </label>
									<div class="col-md-7 form-group">
										
										<textarea class="form-control" type="text" size="10" name="others<?php echo $byproducts->id ?>" id="others<?php echo $byproducts->id ?>"></textarea>
									</div>
									<label class="col-md-5 pull-left form-group">Quantity : </label>
									<div class="col-md-7 form-group">
										<div class="col-md-7"><input class="form-control" type="text" size="10" name="qty<?php echo $byproducts->id ?>" id="qty<?php echo $byproducts->id ?>"></div>
										<div class="col-md-5">
											<select class="form-control" name="unit" id="unit">
												<?php
													$product_unit = $this->products_model->get_all_by_id($product_id);
													foreach ($product_unit as $unit){ ?>
													<option value="<?= $unit->id ?>" <?php if($unit->id == $unit) echo 'selected="selected"'; ?>><?= $unit->product_unit; ?></option>
												
												<?php } ?>                          
											</select>
										</div>
									</div>
									
									<div  align="right">
										<a id="<?=$byproducts->id?>" href="javascript:void(0)" class="btn btn-warning openmodal"><span class="fa fa-shopping-cart">&nbsp;Add to Cart</a>
									</div>
									<?php } ?>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row" style="margin-bottom:10px;margin-top:20px">
									<h3 style="font-weight:800;">&nbsp;&nbsp;&nbsp;Description</h3>
								</div>
								<div class="row" style="margin-bottom: 20px;margin-left:10px;margin-right:10px">
									<p align="justify"><br/><?php echo $byproducts->description; ?></p>
								</div>
								<div class="row">
									<div class="col-md-6 text-right">
										<?php echo $pagination ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click", ".openmodal", function () { 
			var id = $(this).attr("id");
			var qty = $("#qty"+id+"").val();
			var unit = $("#unit"+id+"").val();
			var others = $("#others"+id+"").val();
			$.ajax({
				method: "POST",
				url: "<?=base_url("shopping/add")?>",
				//dataType: 'json',
				data:{"id": id ,"qty": qty ,"unit": unit ,"others": others},
				success: function (res) {
					$('#cart_modal').modal('show');
					$("#cartdetails").html(res);
				},
				failure: function (res) {
					alert(response);
				}
			});
		});
	});
	function clear_cart() {
		var result = confirm('Are you sure want to clear cart?');
		if (result) {
			window.location = "<?php echo base_url(); ?>index.php/shopping/remove/all";
		} else {
			return false; 
		}
	}
</script>																					