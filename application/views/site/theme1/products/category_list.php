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
		<div class="col-md-9 offset-md-3">
				<h2>Products</h2>
		</div>
	</div>
	<div id="products" class="row">
		<div class="col-md-4 categories">
			<div class="well no-padding" style="background-color: #fff;border: 1px solid #fff;">
				<ul class="nav nav-list nav-menu-list-style">
					<?php
					$categories = $this->category_model->get_all();
					foreach ($categories as $category) { ?>
						<li><label class="tree-toggle nav-header glyphicon-icon-rpad">
								<?= $category->category_name; ?>
								<i class="menu-collapsible-icon fa fa-angle-down" aria-hidden="true"></i>
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
		<div class="col-md-8">
			<div class="row">
			<?php
			if ($this->session->flashdata('flashMsg') != null) {
				echo $this->session->flashdata('flashMsg');
			}

			?>
			<?php
			$this->load->helper('text');
			foreach ($subcategory_list as $row) {
				?>
				<div class="col-4">
				<a class="product-link" href="<?= base_url("view-all-products-by-category/" . $row->id) ?>">
					<div class="item grid-group-item">
						<div class="thumbnail">
							<img class="group list-group-image" src="<?php echo base_url($row->picture); ?>" />
							<h4 class="text-center product-title">
								<?php echo $row->sub_category; ?>
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
			if ($(this).parent().children('label').children(".fa").is(".fa-angle-down")) {
				$(this).parent().children('label').children(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
			} else {
				$(this).parent().children('label').children(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
			}
		});
	});
	$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(0);
		$('.tree-toggle').parent().children('.showproducts').slideDown(500);
		i = true;
	})
</script>