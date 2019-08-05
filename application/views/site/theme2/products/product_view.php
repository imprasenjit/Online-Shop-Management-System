<script>
    $(document).ready(function() {
        $('#products').addClass('active');
    });
</script>


	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="<?= base_url(); ?>assets/theme2/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>assets/theme2/css/styles.css" rel="stylesheet" />
  <script src="<?= base_url(); ?>assets/theme2/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/theme2/js/gsdk-bootstrap-wizard.js"></script>

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	<div class="agile-banner">
		<div class="text-center container" style="color:white; padding:200px 170px;">
			<h1 class="header-title-inner-page" style="font-size:4vh; font-weight:900;">Products</h1>
		</div>
	</div>

  <!-- products -->
	<section style="padding-top:20px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-3 sidebar" style="padding-top:32px;">
					<div class="mini-submenu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>
					<div class="list-group">
					<span href="#" class="list-group-item " style="font-size:20px;font-weight: 900;">
						Categories
					</span>
					<?php
					$i = 1;
					$categories = $this->category_model->get_all();
					foreach ($categories as $category) { ?>
						<a href="#!" class="list-group-item" style="font-size:20px; font-weight:800" onclick="myFunction<?=$i;?>()">
							<?= $category->category_name; ?>
							<span class="pull-right">
								<i class="fa fa-angle-down"></i>
							</span>
						</a>
						<div class="dropdown-container<?=$i;?>" id="drop<?=$i;?>">
							<?php
							$sub_categories = $this->sub_category_model->get_subcategory_by_category($category->id);
							foreach ($sub_categories as $sub_category) {
								?>
								<a href="<?=base_url("view-all-products-by-category/" . $sub_category->id) ?>" class="list-group-item" style="font-size:17px;">
									<?= $sub_category->sub_category; ?>
										<span class=" pull-right">
									<i class="fa fa-angle-down"></i>
									</span>
								</a>
							<?php } ?>
						</div>
					<?php $i++;
					} ?>
				</div>



				</div>
				<div class="col-md-8" style="padding-top:30px;">

						<div class="col-md-6" style="padding-top:20px;">
              <img src="<?php echo base_url($product->picture); ?>" class="img-thumbnail product-image" alt="">
              <?php if(isset($product->show_weight_chart ) && $product->show_weight_chart == "1" ) {?>
							<div class="row" style="padding-top:40px;">
								<div class="col-md-12"><a
										onclick="document.getElementById('id01').style.display='block'"
										class="btn btn-info btn-block">Weight Chart</a></div>
							</div>
              <?php }?>
							<div id="id01" class="w3-modal">
								<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

									<div class="w3-center"><br>
										<span onclick="document.getElementById('id01').style.display='none'"
											class="w3-button w3-xlarge w3-hover-red w3-display-topright"
											title="Close Modal">&times;</span>
                      <?php if (isset($product->specification) && $product->specification != "") { ?>
                          <img src="<?php echo base_url($product->specification); ?>" style="width:500px !important;">
                      <?php } ?>
									</div>


									<div class="text-center">
                    <section class="product-info product-weight-chart" style="width:98%;margin-top:10px;">

                        <?php if (isset($product->weight_chart ) && $product->weight_chart !='') {
                            echo htmlspecialchars_decode($product->weight_chart);
                        } ?>
                    </section>

									</div>

								</div>

							</div>
              <?php if(isset($product->show_description) && $product->show_description == "1"){ ?>
                <div class="row" style="padding-top:42px;">
                  <div class="col-md-12"><a id="" href="#!" 	onclick="document.getElementById('id02').style.display='block'" class="btn btn-info btn-block">
                      Additional Info
                    </a></div>
                </div>
            <?php   } ?>


              <div id="id02" class="w3-modal">
								<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

									<div class="w3-center"><br>
										<span onclick="document.getElementById('id02').style.display='none'"
											class="w3-button w3-xlarge w3-hover-red w3-display-topright"
											title="Close Modal">&times;</span>
									</div>


									<div class="text-center">
                    <section class="product-info">
                        <p class="text-justify">
                            <?php
                            if ($product->description) {
                                echo $product->description;
                            }else { ?>
                                <div style="padding:20px;">No Additional Info Found</div>
                            <?php }

                            ?>
                        </p>
                    </section>
									</div>

								</div>

							</div>

						</div>
							<div class="col-md-6">
								<div class="text-center">
									<h3><b><?php echo $product->product_name; ?></b></h3>
								</div>
                <form id="addtocart" method="post" action="<?= base_url(); ?>shopping/add">
                 <?php
                 $product_id = $product->id;
                 $attribute_list = $this->products_model->get_by_id($product_id);
                 $attributes = $product->attributes;
                 if ($attribute_list != null) {
                     $jsonData = stripslashes(html_entity_decode($attributes));
                     $jsonDecode = json_decode('' . $jsonData . '', true);
                     foreach ($jsonDecode['data'] as $key => $attr) {
                         ?>
                         <div class="form-group row" style="padding: 0em 0;">
                             <label class="col-md-12 "><?= $attr ?>: </label>
                             <div class="col-md-12">
                                 <?php
                                 $pid = $this->uri->segment(3);
                                 $attribute_value = $this->attribute_model->get_attribute_value($pid, "attr" . ($key + 1) . "");
                                 ?>
                                 <select class="form-control attr_values" name="attributes[]" data-name="<?= $attr ?>">
                                     <option value="">Please Select</option>
                                     <?php foreach ($attribute_value as $value) { ?>
                                         <option value="<?= $value->attr_value; ?>"><?= $value->attr_value ?>
                                         </option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>
                     <?php    }
                 }
                 ?>
                 <div class="form-group row"  style="padding: 0em 0;">
                     <label class="col-md-12 ">Quantity:</label>
                     <div class="col-md-12">
                         <div class="row">
                             <div class="col-md-6">
                                 <input type="number" min="0" class="form-control" name="qty<?php echo $product->id ?>" id="qty<?php echo $product->id ?>">
                             </div>
                             <div class="col-md-6">
                                 <select name="product_unit<?php echo $product->id ?>" class="form-control" id="product_unit<?php echo $product->id ?>">
                                     <option>MT</option>
                                     <option>KG</option>
                                     <option>Pcs</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="form-group row"  style="padding: 0em 0;">
                     <label class="col-md-12 ">Others: </label>
                     <div class="col-md-12">
                         <textarea class="form-control" type="text" size="10" name="others<?php echo $product->id ?>" id="others<?php echo $product->id ?>"></textarea>
                     </div>
                 </div>
                 <div class="form-group row"  style="padding: 0em 0;">
                     <label class="col-md-12"></label>
                     <div class="col-md-12">
                         <a id="add_to_cart" product_id="<?= $product->id ?>" href="#!" class="btn btn-success add_to_cart btn-block openmodal">
                             <span class="fa fa-shopping-cart"></span>&nbsp; Add to Enquiry Cart
                         </a>
                     </div>
                 </div>

                 <!-- <div class="row">
                   <label class="col-4"></label>
                   <div class="col-4">
                     <a id="add_to_cart" product_id="1" href="#!"
                       class="btn btn-success add_to_cart btn-block openmodal">
                       <span class="fa fa-shopping-cart"></span>&nbsp; Add to Enquiry Cart
                     </a>
                   </div>
                 </div> -->
             </form>
							</div>


				</div>
			</div>
		</div>
	</section>




<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".openmodal", function() {
            $(this).empty().append("Processing..");
            var id = $(this).attr("product_id");
            var qty = $("#qty" + id + "").val();
            var product_unit = $("#product_unit" + id + "").val();
            var attributes = [];
            var attr_names = [];
            $('.attr_values').each(function() {
                attributes.push($(this).attr("data-name"));
            });
            $('.attr_values').each(function() {
                attr_names.push($(this).val());
            });
            console.log(attributes);
            var others = $("#others" + id + "").val();
            //$('#cart_modal').modal('show'); alert("pid : "+qry);
            $.ajax({
                method: "POST",
                url: '<?= base_url("shopping/add") ?>',
                //dataType: 'json',
                data: {
                    "id": id,
                    "qty": qty,
                    "product_unit": product_unit,
                    "attributes": attributes,
                    attr_names: attr_names,
                    "others": others
                },
                success: function(res) {
                    $('#cart_modal').modal('show');
                    $("#cartdetails").empty().html(res);
                    $('#add_to_cart').empty().append("Add to Cart");
                },
                failure: function(res) {
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

<script>
	function myFunction1() {
		var x = document.getElementById("drop1");
		if (x.className === "dropdown-container1") {
			if (x.style.display === "block") {
				x.style.display = "none";
			} else {
				x.style.display = "block";
			}
		}
	}

	function myFunction2() {
		var x = document.getElementById("drop2");
		if (x.className === "dropdown-container2") {
			if (x.style.display === "block") {
				x.style.display = "none";
			} else {
				x.style.display = "block";
			}
		}
	}
</script>
