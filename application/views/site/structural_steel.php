<section class="pricing py-md-5 py-4">
	<div class="container-fluid">
		<div class="inner-sec-w3layouts py-md-5 py-3">
			<!--/row-one-->
			<div class="row" style="margin-left:-30px;">
				<div class="col-lg-2 price-left">
					<?php $this->load->view('requires/filtersidenavbar'); ?>
				</div>
				<br><br>
				<div class="col-lg-10 price-right">
					<div class="tabs" style="margin-left:30px">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="menu-grids mt-4">
									<div class="row t-in" >
										<?php
											$sl = 1;
											foreach ($products_data as $products)
											{	
											?>
											<div class="col-md-3 price-main-info text-center" style="margin-bottom:10px">
												
												<div class="price-inner card box-shadow">
													<div class="card-body">
														<h4 class="text-uppercase mb-3"></h4>
														<ul class="list-unstyled mt-3 mb-4">
															<a href="<?= base_url() ?>home/const_steel_details">
																<img src="../images/1.jpg" class="img-fluid" alt="" >
															</a>
															<li><?php echo $products->product_name ?></li>
															<li>Product Description : Size. <?php echo $products->product_len ?> Ton<br />
															<?php // echo $products->product_price ?></li>
															<!--<input type="text" class="form-control" name="t1" placeholder="Enter Ton" size="5">
															<input type="text" class="form-control" name="p1" placeholder="Enter Piece" size="5">-->
														</ul>
														<div class="col-md-5" style="font-size:16px;font-weight:500">Enter Qty:</div>
														<div class="col-md-7"><input class="form-control" type="text" name="qty<?php echo $products->id ?>" id="qty<?php echo $products->id ?>" size="10" placeholder=""></div>
														
														<!--<input type="hidden" id="id" value="<?php echo $products->id ?>">
															<input type="hidden" id="name" value="<?php echo $products->product_name ?>">
														<input type="hidden" id="price" value="<?php echo $products->product_price ?>">-->
														<?php
															echo form_open('shopping/add');
															echo form_hidden('id', $products->id);
															echo form_hidden('name', $products->product_name);
														?> </div> 
														<!--<div id='add_button'>
															<?php
																$btn = array(
																'class' => 'btn btn-warning',
																'value' => 'Add to Cart',
																'name' => 'action',
																);
																// Submit Button.
																echo form_submit($btn);
																echo form_close();
															?>
														</div>-->
														<div class="log-in">
															<a id="<?=$products->id?>" href="javascript:void(0)" class="btn btn-warning openmodal"><span class="fa fa-shopping-cart">&nbsp;
															Add to Cart</a>
															</div>
															<div style="margin-bottom:20px;"></div>
															
															
														</div>
												</div>
												<?php
													$sl++;
												}
											?>
										</div>
									</div>
								</div>
								<br /><br />
								
								<div class="row">
									<div class="col-md-6 text-right">
										<?php echo $pagination ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--//row-one-->
			</div>
		</div>
	</section>
	
	
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("click", ".openmodal", function () { 
				var id = $(this).attr("id");
				var qty = $("#qty"+id+"").val();
				
				//$('#cart_modal').modal('show'); alert("pid : "+qry);
				$.ajax({
					method: "POST",
					url: "<?=base_url("shopping/add")?>",
					//dataType: 'json',
					data:{"id": id ,"qty": qty},
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
				return false; // cancel button
			}
		}
	</script>						
