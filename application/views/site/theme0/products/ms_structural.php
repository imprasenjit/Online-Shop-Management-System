
<style>
	
	.profile {
	  margin: 20px 0;
	}
	
	.profile-sidebar {
	  padding: 20px 0 10px 0;
	  background: #fff;
	}
	
	.profile-userpic img {
	  float: none;
	  margin: 0 auto;
	  width: 50%;
	  height: 50%;
	  -webkit-border-radius: 50% !important;
	  -moz-border-radius: 50% !important;
	  border-radius: 50% !important;
	}
	
	.profile-usertitle {
	  text-align: center;
	  margin-top: 20px;
	}
	
	.profile-usertitle-name {
	  color: #5a7391;
	  font-size: 16px;
	  font-weight: 600;
	  margin-bottom: 7px;
	}
	
	.profile-usertitle-job {
	  text-transform: uppercase;
	  color: #5b9bd1;
	  font-size: 12px;
	  font-weight: 600;
	  margin-bottom: 15px;
	}
	
	.profile-userbuttons {
	  text-align: center;
	  margin-top: 10px;
	}
	
	.profile-userbuttons .btn {
	  text-transform: uppercase;
	  font-size: 11px;
	  font-weight: 600;
	  padding: 6px 15px;
	  margin-right: 5px;
	}
	
	.profile-userbuttons .btn:last-child {
	  margin-right: 0px;
	}
		
	.profile-usermenu {
	  margin-top: 30px;
	}
	
	.profile-usermenu ul li {
	  border-bottom: 1px solid #f0f4f7;
	}
	
	.profile-usermenu ul li:last-child {
	  border-bottom: none;
	}
	
	.profile-usermenu ul li a {
	  color: #93a3b5;
	  font-size: 14px;
	  font-weight: 400;
	}
	
	.profile-usermenu ul li a i {
	  margin-right: 8px;
	  font-size: 14px;
	}
	
	.profile-usermenu ul li a:hover {
	
	  color: #5b9bd1;
	}
	
	.profile-usermenu ul li.active {
	  border-bottom: none;
	}
	
	.profile-usermenu ul li.active a {
	  color: #5b9bd1;
	  background-color: #f6f9fb;
	  border-left: 2px solid #5b9bd1;
	  margin-left: -2px;
	}
	
	/* Profile Content */
	.profile-content {
	  padding: 20px;
	  background: #fff;
	  min-height: 460px;
	}
	
		/*Prasenjits CSS*/
	/*********************************************
						PRODUCTS
	*********************************************/
	.table-tr{
		background: #404040;
		color:#FFF;
	}
	.product{
		border: 1px solid #dddddd;
		height: 321px;
	}
	
	.product>img{
		max-width: 230px;
	}
	
	.product-rating{
		font-size: 20px;
		margin-bottom: 25px;
	}
	
	.product-title{
		font-size: 24px;
		font-weight: 700;
	}
	
	.product-desc{
		font-size: 14px;
	}
	
	.product-price{
		font-size: 22px;
	}
	
	.product-stock{
		color: #74DF00;
		font-size: 20px;
		margin-top: 10px;
	}
	
	.product-info{
	
	}
	
	/*********************************************
						VIEW
	*********************************************/
	
	.content-wrapper {
		max-width: 1349px;
		background: #fff;
		margin: 0 auto;
		margin-top: 25px;
		margin-bottom: 10px;
		border: 0px;
		border-radius: 0px;
	}
	
	.container-fluid{
		max-width: 1140px;
		margin: 0 auto;
	}
	
	.view-wrapper {
		float: right;
		max-width: 70%;
		margin-top: 25px;
	}
	
	.container {
		padding-left: 0px;
		padding-right: 0px;
		max-width: 100%;
	}
	
	/*********************************************
					ITEM 
	*********************************************/
	
	.service1-items {
		padding: 0px 0 0px 0;
		float: left;
		position: relative;
		overflow: hidden;
		max-width: 100%;
	
	}
	
	.service1-item {
		height: 107px;
		width: 120px;
		display: block;
		float: left;
		position: relative;
		padding-right: 20px;
		border-right: 1px solid #DDD;
		border-top: 1px solid #DDD;
		border-bottom: 1px solid #DDD;
	}
	
	.service1-item > img {
		max-height: 110px;
		max-width: 110px;
		opacity: 0.6;
		transition: all .2s ease-in;
		-o-transition: all .2s ease-in;
		-moz-transition: all .2s ease-in;
		-webkit-transition: all .2s ease-in;
	}
	
	.service1-item > img:hover {
		cursor: pointer;
		opacity: 1;
	}
	
	.service-image-left {
		padding-right: 50px;
	}
	
	.service-image-right {
		padding-left: 50px;
	}
	
	.service-image-left > center > img,.service-image-right > center > img{
		
	}
	
	.navbar-brand{
		padding:0px !important;
	}
	.panel-grey{
		background:#252628;
	}
	.panel-dark{
		border: 2px solid #252628;
	}
	.glyphicon { margin-right:5px; }
	.list-group-item,.grid-group-item{
		border: 0;
		border-radius:8px; 
	}
	.list-group-item .thumbnail .product-title{
		text-align: left;
	}
	.design-btns{
	margin-top:50px;
	margin-bottom:50px;
	
	}
	.grid-group-item > .thumbnail
	{
		margin-bottom: 20px;    
		padding: 0px;
		-webkit-box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
		-moz-box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
		box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
		height:400px;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}
	.grid-group-item > .thumbnail:hover{
		-webkit-box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	-moz-box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	transition: 1s;
	}
	.grid-group-item > .thumbnail > .caption{
	text-align: justify;
	}
	.grid-group-item .view-btn{
		position: absolute;
		bottom: 25px;
		right: 21px;
	}
	.list-group-item .view-btn{
	display: none;
	}
	.item.list-group-item
	{
		float: none;
		width: 100%;
		background-color: #fff;
		margin-bottom: 10px;
	}
	.item.grid-group-item:hover{
		transition: 1s;
	}
	.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
	{
	
		transition: 1s;
	}
	.product-link{
		text-decoration: none;
		color: #000;
	}
	.item.list-group-item .list-group-image
	{
		margin-right: 10px;
		height:100px;
		width:100px;
	}
	.item.list-group-item .thumbnail
	{
	
		margin-bottom: 0px;
		height: 120px;;
	}
	.list-group-item > .thumbnail:hover{
		-webkit-box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	-moz-box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	box-shadow: -2px 4px 29px 6px rgba(0,0,0,0.55);
	transition: 1s;
	}
	.item.list-group-item .caption
	{
		padding: 9px 9px 0px 9px;
	}
	.item.list-group-item:nth-of-type(odd)
	{
		background: #eeeeee;
	}
	
	.item.list-group-item:before, .item.list-group-item:after
	{
		display: table;
		content: " ";
	}
	.item.grid-group-item img
	{
		float: left;
		height:195px;
		margin-bottom: 2rem;
	}
	.item.list-group-item img
	{
		float: left;
		width:20%;
	}
	.item.list-group-item:after
	{
		clear: both;
	}
	.list-group-item-text
	{
		margin: 0 0 11px;
	}
		.no-padding {
			padding: 0px;
		}
		.glyphicon-icon-rpad .glyphicon,
		.glyphicon-icon-rpad .glyphicon.m8,
		.fa-icon-rpad .fa,
		.fa-icon-rpad .fa.m8 {
			padding-right: 8px;
		}
		.glyphicon-icon-lpad .glyphicon,
		.glyphicon-icon-lpad .glyphicon.m8,
		.fa-icon-lpad .fa,
		.fa-icon-lpad .fa.m8 {
			padding-left: 8px;
		}
		.glyphicon-icon-rpad .glyphicon.m5,
		.fa-icon-rpad .fa.m5 {
			padding-right: 5px;
		}
		.glyphicon-icon-lpad .glyphicon.m5,
		.fa-icon-lpad .fa.m5 {
			padding-left: 5px;
		}
		.glyphicon-icon-rpad .glyphicon.m12,
		.fa-icon-rpad .fa.m12 {
			padding-right: 12px;
		}
		.glyphicon-icon-lpad .glyphicon.m12,
		.fa-icon-lpad .fa.m12 {
			padding-left: 12px;
		}
		.glyphicon-icon-rpad .glyphicon.m15,
		.fa-icon-rpad .fa.m15 {
			padding-right: 15px;
		}
		.glyphicon-icon-lpad .glyphicon.m15,
		.fa-icon-lpad .fa.m15 {
			padding-left: 15px;
		}
		ul.nav-menu-list-style .nav-header .menu-collapsible-icon {
			position: absolute;
			right: 3px;
			top: 16px;
			font-size: 14px;
		}
		ul.nav-menu-list-style {
			margin: 0;
		}
		ul.nav-menu-list-style .nav-header {
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #e8e8e8;
			display: block;
			margin: 0;
			line-height: 42px;
			padding: 0 8px;
			font-weight: 600;
			font-size: 18px;
		}
		ul.nav-menu-list-style>li {
			cursor: pointer;
			position: relative;
			font-size: 16px;
			font-weight: 500;
		}
		ul.nav-menu-list-style>li a {
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #e8e8e8;
			padding: 0 10px;
			line-height: 32px;
		}
		.categories{
			-webkit-box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
	-moz-box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
	box-shadow: 2px 2px 24px -2px rgba(0,0,0,0.39);
		}
		.nav-list.tree{
			padding-left:30px; 
		}
		.tree-toggle {
			cursor: pointer;
		}
		ul.nav-menu-list-style {
			list-style: none;
			padding: 0px;
			margin: 0px;
		}
		ul.nav-menu-list-style li .badge,
		ul.nav-menu-list-style li .pull-right,
		ul.nav-menu-list-style li span.badge,
		ul.nav-menu-list-style li label.badge {
			float: right;
			margin-top: 7px;
		}
		ul.bullets {
			list-style: inside disc
		}
		ul.numerics {
			list-style: inside decimal
		}
		.ul.kas-icon-aero {}
		ul.kas-icon-aero li a:before {
			font-family: 'Glyphicons Halflings';
			font-size: 14px;
			content: "\e258";
			padding-right: 8px;
		}
	</style>
	<div class="container">
		<div class="row design-btns">
			<div class="col-md-4">
				<h2></h2>
			</div>
			<div class="col-md-8">
				<a href="#" id="list" class="btn btn-default pull-right"><span
						class="glyphicon glyphicon-th-list"></span>List</a>
				<a href="#" id="grid" class="btn btn-default pull-right"><span
						class="glyphicon glyphicon-th"></span>Grid</a>
			</div>
		</div>
		<div id="products" class="row list-group">
			<div class="col-md-3 pl-4 categories">
				<div class="well no-padding" style="background-color: #fff;border: 1px solid #fff;">
					<ul class="nav nav-list nav-menu-list-style">
					<?php 
						$categories=$this->category_model->get_all();
						  foreach($categories as $category){ ?>
						<li><label class="tree-toggle nav-header glyphicon-icon-rpad">
								<span class="glyphicon glyphicon-link m5"></span><?=$category->category_name;?>
								<span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span>
							</label>
							<ul class="nav nav-list tree bullets">
							<?php 						    
								$i=0;
								$sub_categories=$this->sub_category_model->get_subcategory_by_category($category->id);
								foreach($sub_categories as $sub_category){
								?>
								<li><a href="<?=base_url();?>products/category/<?=$sub_category->id?>"><?=$sub_category->sub_category?></a></li>						
								<?php
								}
							?>			
							</ul>
						</li>
	
						<li class="divider"></li>	
							<?php } ?>			
						
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<?php
									if ($this->session->flashdata('flashMsg') != NULL)
										echo $this->session->flashdata('flashMsg');
								?>
				<?php 
										$this->load->helper('text');
										foreach ($byproducts_data as $byproducts)
									{	
								?>
				<a class="product-link" href="<?=base_url("products/product_view/".$byproducts->id)?>">
					<div class="item grid-group-item  col-6 col-lg-4 col-md-4 col-sm-4">
						<div class="thumbnail">
							<img class="group list-group-image" src="<?php echo $byproducts->picture; ?>" alt="" />
							<h4 class="text-center product-title">
							<?php echo $byproducts->product_name;?>
							</h4>
							<div class="caption">							
								<p class="group inner list-group-item-text">
									<?php echo word_limiter($byproducts->description, 15); ?>
								</p>
								<a class="view-btn" href="<?=base_url("products/product_view/".$byproducts->id)?>"
									target="_blank">View</a>								
								<br/>
							</div>
							
						</div>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function () {
			$('#list').click(function (event) {
				event.preventDefault();
				$('#products .item').addClass('list-group-item');
				$('#products .item').removeClass('grid-group-item');
			});
			$('#grid').click(function (event) {
				event.preventDefault();
				$('#products .item').removeClass('list-group-item');
				$('#products .item').addClass('grid-group-item');
			});
		});
		var i = true;
		$('.tree-toggle').click(function () {
			$(this).parent().children('ul.tree').toggle(500, "easeOutQuint", function () {
				if ($(this).parent().children('label').children(".glyphicon").is(".glyphicon-chevron-right")) {
					$(this).parent().children('label').children(".glyphicon").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
				} else {
					$(this).parent().children('label').children(".glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
				}
			}
			);
		});
		$(function () {
			$('.tree-toggle').parent().children('ul.tree').slideDown(500);
			i = true;
		})
	</script>