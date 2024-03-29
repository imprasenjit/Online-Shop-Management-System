<script>
	$(document).ready(function() {
		$('#products').addClass('active');
	});
</script>
<div class="page-background">
	<div class="text-center container">
		<h2 class="header-title-inner-page">Products</h2>
	</div>
</div>
<div class="container">
	<div class="row design-btns">
		<div class="col-md-3">
			<h2></h2>
		</div>
		<div class="col-md-9">
			<div class="col-md-4">
				<h3>Products</h3>
			</div>
		</div>
	</div>
	<div id="products" class="row">
		<div class="col-md-3 categories">
			<div class="well no-padding" style="background-color: #fff;border: 1px solid #fff;">
				<ul class="nav nav-list nav-menu-list-style">
					<?php
					$categories = $this->category_model->get_all();
					foreach ($categories as $category) { ?>
						<li><label class="tree-toggle nav-header glyphicon-icon-rpad">
								<span class="glyphicon glyphicon-link m5"></span><?= $category->category_name; ?>
								<span class="menu-collapsible-icon glyphicon glyphicon-minus"></span>
							</label>
							<ul class="nav nav-list tree bullets showproducts">
								<?php
								$i = 0;
								$sub_categories = $this->sub_category_model->get_subcategory_by_category($category->id);
								foreach ($sub_categories as $sub_category) {
									?>
									<li>
										<label class="tree-toggle nav-header glyphicon-icon-rpad">
											<?= $sub_category->sub_category; ?>
											<span class="menu-collapsible-icon glyphicon glyphicon-plus"></span>
										</label>
										<ul class="nav nav-list tree bullets">
											<?php
											$i = 0;
											$products = $this->byproducts_model->get_all_by_subcategory($sub_category->id);
											foreach ($products as $product) { ?>
												<li><a href="<?= base_url(); ?>products/product_view/<?= $product->id ?>"><?= $product->product_name; ?></a></li>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="row">
			<?php
			if ($this->session->flashdata('flashMsg') != null) {
				echo $this->session->flashdata('flashMsg');
			}
			?>
			<?php
			$this->load->helper('text');
			foreach ($products_data as $byproducts) {
				?>
				<div class="col-4">
				<a class="product-link" href="<?= base_url("products/product_view/" . $byproducts->id) ?>">
					<div class="item grid-group-item">
						<div class="thumbnail">
							<img class="group list-group-image" src="<?php echo base_url($byproducts->picture); ?>" alt="" />
							<h4 class="text-center product-title">
								<?php echo $byproducts->product_name; ?>
							</h4>
						</div>
					</div>
				</a>
			</div>
			<?php } ?>
		</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
	$(document).ready(function() {
		$('#list').click(function(event) {
			event.preventDefault();
			$('#products .item').addClass('list-group-item');
			$('#products .item').removeClass('grid-group-item');
		});
		$('#grid').click(function(event) {
			event.preventDefault();
			$('#products .item').removeClass('list-group-item');
			$('#products .item').addClass('grid-group-item');
		});
	});
	var i = true;
	$('.tree-toggle').click(function() {
		$(this).parent().children('ul.tree').toggle(500, "easeOutQuint", function() {
			if ($(this).parent().children('label').children(".glyphicon").is(".glyphicon-plus")) {
				$(this).parent().children('label').children(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
			} else {
				$(this).parent().children('label').children(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
			}
		});
	});
	$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(0);
		$('.tree-toggle').parent().children('.showproducts').slideDown(500);
		i = true;
	})
</script>