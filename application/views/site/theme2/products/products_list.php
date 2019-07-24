	<link href="<?= base_url(); ?>assets/theme2/css/sidebar.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?= base_url(); ?>assets/theme2/css/cards.css" rel="stylesheet" type="text/css" media="all" />
	<script>
	$(document).ready(function() {
		$('#products').addClass('active');
	});
</script>
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
						<a href="#" class="list-group-item" style="font-size:20px; font-weight:800" onclick="myFunction<?=$i;?>()">
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
								<a href="#" class="list-group-item" style="font-size:17px;"">
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
					<div class="col-md-9">
						<div class="index-content">
							<div class="container">
					<?php
$this->load->helper('text');
$j=3;
foreach ($products_data as $byproducts) {
	?>

						<?php 
						if($j%3==0){
						?>
						<div class="row">
						<?php } ?>
							<a href="<?= base_url("products/product_view/" . $byproducts->id) ?>">
								<div class="col-lg-3">
									<div class="card">
										<img src="<?php echo base_url($byproducts->picture); ?>">
										<h4 class="text-center" style="font-size:18px; font-weight: 800;"><?php echo $byproducts->product_name; ?></h4>
										<br>
										<p></p>
									</div>
								</div>
							</a>							
							<?php 
							$j++;
						if($j%3==0){
						?>
						</div>
						<?php } ?>
						<?php 
					     } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //products -->
	<script>
		$(function () {
			$('#slide-submenu').on('click', function () {
				$(this).closest('.list-group').fadeOut('slide', function () {
					$('.mini-submenu').fadeIn();
				});
			});
			$('.mini-submenu').on('click', function () {
				$(this).next('.list-group').toggle('slide');
				$('.mini-submenu').hide();
			})
		})
	</script>
	<script>
		function myFunction() {
			var x = document.getElementById("drop");
			if (x.className === "dropdown-container" ) {
				if (x.style.display === "block") {
					x.style.display = "none";
				} else {
					x.style.display = "block";
				}
			}
		}
		function myFunction2() {
			var x = document.getElementById("drop2");
			if (x.className === "dropdown-container2" ) {
				if (x.style.display === "block") {
					x.style.display = "none";
				} else {
					x.style.display = "block";
				}
			}
		}
	</script>