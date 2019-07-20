<html>
    <head>
        <title>My Cart </title>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700' rel='stylesheet' type='text/css'>
		<link href="<?= base_url(); ?>assets/css/cart_style.css" rel='stylesheet' type='text/css' />

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
    </head>
    <body>
	<div class="col-md-2" style="margin-left:-12px">
						<?php $this->load->view('requires/filtersidenavbar'); ?>
					</div>
      <div id='content'>
				<div id='tag'>
                   
                    <!--<img src="<?php echo base_url(); ?>images/head_cart.png"/>
					<img src="../images/1.jpg" class="img-fluid" alt="" >-->
				</div>
        <br><div id="cart" >
            <div id = "heading">
                <h2 align="center">Products on Your Shopping Cart</h2>
            </div>
            <br />
                <div id="text">
					<?php  $cart_check = $this->cart->contents();
					//print_r($cart_check); die();
					// If cart is empty, this will show below message.
					if(empty($cart_check)) {
						echo 'To add products to your shopping cart click on "Add to Cart" Button'; 
					}  ?> 
				</div>
            
                <table id="table" border="0" cellpadding="5px" cellspacing="1px">
                <?php
                  // All values of cart store in "$cart". 
                if ($cart = $this->cart->contents()){ ?>
                    <tr id= "main_heading">
                        <td>Serial</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Qty</td>
                        <td>Amount</td>
                        <td>Cancel Product</td>
                    </tr>
                    <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('shopping/update_cart');
                    $grand_total = 0;
                    $i = 1;
					foreach ($cart as $item){
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                        <tr>
                            <td>
						<?php echo $i++; ?>
                            </td>
                            <td>
						<?php echo $item['name']; ?>
                            </td>
                            <td>
                                Rs. <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                Rs. <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td align="center">
								<!--<i class="fa fa-times" aria-hidden="true">Cancel</i>-->
								<?php 
								// cancle image.
								//$path = "<img src='../images/cart_cross.jpg' width='25px' height='20px'>";
								$path = "Cancel";
								echo anchor('shopping/remove/' . $item['rowid'], $path); ?>
								
                            </td>
					<?php } ?>
                    </tr>
                    <tr>
                        <td><b>Order Total: Rs. <?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        <td colspan="5" align="right"><input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">
                            
                            <?php //submit button. ?>
                            <input type="submit" class ='fg-button teal' value="Update Cart">
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'shopping/billing_view'"></td>
                    </tr>
				<?php } ?>
            </table>
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
			<div class="row" style="margin-top:1150px;margin-bottom:40px;margin-left:400px;">
				<div class="col-md-12 text-left">
					<?php echo $pagination ?>
				</div>
			</div>
      </div>
		<?php $this->load->view('requires/footer');	 ?>	
    </body>
</html>
