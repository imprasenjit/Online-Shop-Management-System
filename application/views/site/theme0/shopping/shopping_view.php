<div class="col-md-2" style="margin-left:-12px">
	<?php $this->load->view('requires/sidenavbar'); ?>
</div>
<div class="container-fluid">
	<div id='content'>
		<div id='tag'>
			<!--<img src="<?php echo base_url(); ?>images/head_cart.png"/>
			<img src="../images/1.jpg" class="img-fluid" alt="" >-->
		</div>

		<div id="products_e" align="center">
			<h2 id="head" align="center">Products</h2>
			<?php
				$config['per_page'] = 6;
				$start = $this->uri->segment(3, 0);
				$products = $this->billing_model->get_all($config['per_page'], $start);
				//print_r($products);
				// "$products" send from "shopping" controller,its stores all product which available in database. 
				foreach ($products as $product) {
					$id = $product['id'];
					$name = $product['product_name'];
					$description = $product['description'];
					$price = $product['product_price'];
				?>
				<div id='product_div'>  
                    <div id='image_div'>
						<img class="img-fluid" alt="" src="<?php echo base_url() . $product['picture'] ?>"/>
						<!--<img src="../images/1.jpg" class="img-fluid" alt="" >-->
					</div>
                    <div id='info_product'>
						<div id='name'><?php echo $name; ?></div>
						<div id='desc'>  <?php echo $description; ?></div>
						<div id='rs'><b>Price</b>:<big style="color:green">
						Rs.<?php echo $price; ?></big></div>
						<?php
							echo form_open('shopping/add');
							echo form_hidden('id', $id);
							echo form_hidden('name', $name);
							echo form_hidden('price', $price);
						?> </div> 
						<div id='add_button'>
							<?php
								$btn = array(
								'class' => 'fg-button teal',
								'value' => 'Add to Cart',
								'name' => 'action'
								);
								// Submit Button.
								echo form_submit($btn);
								echo form_close();
							?>
						</div>
				</div>
			<?php } ?>
		</div>
		<div class="row" style="margin-top:0px;margin-bottom:40px;margin-left:400px;">
			<div class="col-md-12 text-left">
				<?php echo $pagination ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('requires/footer');	 ?>	
<script type="text/javascript">
	function clear_cart() {
		var result = confirm('Are you sure want to clear cart?');
		if (result) {
			window.location = "<?php echo base_url(); ?>shopping/remove/all";
			} else {
			return false; // cancel button
		}
	}
</script>					