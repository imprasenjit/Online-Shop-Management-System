<div class="nav-side-menu">
	<div class="brand" >Products
	</div>
    

    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
	
	<div class="menu-list">
		
		<ul id="menu-content" class="menu-content collapse out">
			<li>
				<a href="<?= base_url();?>dashboard/customer_dashboard">
					<i class="fa fa-dashboard fa-lg"></i> Dashboard
				</a>
			</li>
			<li  data-toggle="collapse" data-target="#products" class="collapsed active">
				<a href="#!"><i class="fa fa-braille fa-fw"></i> Structural Steel <span class="arrow"></span></a>
			</li>
			<!--<ul class="sub-menu collapse" id="products">-->
			<ul class="sub-menu" id="products">
			<?php $products=$this->products_model->get_all();
			    $i=0;
				foreach($products as $product){
				?>
				<li class=""><a href="<?= base_url(); ?>products/view/<?=$product->id?>"><?=$product->product_name?></a></li>
				<?php
				}
				?>
				
				<!--<li><a href="<?= base_url(); ?>byproducts/ms_channel">MS Channel</a></li>
				<li><a href="#">MS Flat</a></li>
				<li><a href="#">MS Beam/Joist</a></li>
				<li><a href="#">MS Pipe</a></li>
				<li><a href="#">MS Rectangular tube</a></li>
				<li><a href="#">MS Square Tube</a></li>
				<li><a href="#">MS Round (Plain Rod)</a></li>
				<li><a href="#">MS Square Bar</a></li>
				<li><a href="#">MS Rectangular Bar</a></li>
				<li><a href="#">TMT &amp; Rebars</a></li>
				<li><a href="#">MS Wire rod</a></li>
				-->
			</ul>
			
			
			<li data-toggle="collapse" data-target="#gi" class="collapsed">
				<a href="#!"><i class="fa fa-braille fa-fw"></i> Galvanized Iron (GI) <span class="arrow"></span></a>
			</li>  
			<ul class="sub-menu collapse" id="gi">
				<li>GI Angle</li>
				<li>GI Channel</li>
				<li>GI Flat/Strip</li>
				<li>GI Pipe</li>
				<li>GI Structures for Distribution &nbsp;&nbsp;&nbsp;&nbsp;Line</li>
				<li>GI Wire</li>
			</ul>
			
			
			<li data-toggle="collapse" data-target="#new" class="collapsed">
				<a href="#!"><i class="fa fa-braille fa-fw"></i> Steel Tubular Pole <span class="arrow"></span></a>
			</li>
			<ul class="sub-menu collapse" id="new">
				<li>Swaged Steel Tubular Pole &nbsp;&nbsp;&nbsp;&nbsp;(MS/GI)</li>
				<li>Octagonal Pole</li>
				<li>High Mast Pole</li>
			</ul>
			
			<li data-toggle="collapse" data-target="#sheet" class="collapsed">
				<a href="#!"><i class="fa fa-braille fa-fw"></i> Sheet &amp; Plate <span class="arrow"></span></a>
			</li>
			<ul class="sub-menu collapse" id="sheet">
				<li>HR Plate</li>
				<li>HR Sheet</li>
				<li>CR Sheet</li>
				<li>PPGL Sheet</li>
				<li>PPGI Sheet</li>
				<li>CGI Sheet</li>
			</ul>
			
			
			
			<!--<li>
				<a href="#">
					<i class="fa fa-users fa-lg"></i> Users
				</a>
			</li>-->
		</ul>
	</div>
</div>