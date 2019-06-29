<!-- services -->
	<div class="services">
		<div class="container">
			<div class="w3-agileits-heading">
				<h2 class="w3l-titles">Our Products</h2> 
			</div>
			
			<div class="wthree-services-grids">
				<div class="col-sm-12 wthree-services">
					<div class="wthree-services-grid">
						<?php
								$sl = 1;
									foreach ($products_data as $products)
									{	
										?>
										<div class="col-md-3 text-center" style="margin-bottom:10px;margin-top:20px">
											<div class="price-inner card box-shadow">
												<div class="card-body">
													<h4 class="text-uppercase mb-3"></h4>
													<ul class="list-unstyled mt-3 mb-4">
														<a href="<?= base_url() ?>home/const_steel_details">
															<img src="<?= base_url(); ?>assets/images/rod.jpg" class="img-fluid" alt="" height="100" width="100">
														</a>
														<li><?php echo $products->product_name ?></li>
														<li>Product Description : Size. <?php echo $products->product_len ?> Ton<br />
															<?php // echo $products->product_price ?></li>
													</ul>
													<div class="col-md-5" style="font-size:16px;font-weight:500">Enter Qty:</div>
													<div class="col-md-7"><input class="form-control" type="text" name="qty<?php echo $products->id ?>" id="qty<?php echo $products->id ?>" size="10" placeholder=""></div>
														<?php
															echo form_open('shopping/add');
															echo form_hidden('id', $products->id);
															echo form_hidden('name', $products->product_name);
														?> 
												</div> 
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
					<br /><br />
					<div class="row">
						<div class="col-md-6 text-right" style="align:center">
							<?php echo $pagination ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- //services -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

