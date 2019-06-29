<h2 style="margin-top:0px">Products <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">name <?php echo form_error('product_name') ?></label>
                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="name" value="<?php echo $product_name; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">category <?php echo form_error('product_category') ?></label>
                <input type="text" class="form-control" name="product_category" id="product_category" placeholder="category" value="<?php echo $product_category; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">sub <?php echo form_error('product_sub_category') ?></label>
                <input type="text" class="form-control" name="product_sub_category" id="product_sub_category" placeholder="sub" value="<?php echo $product_sub_category; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('description') ?></label>
                <input type="text" class="form-control" name="description" id="description" placeholder="" value="<?php echo $description; ?>" />
            </div>
	    <!--<div class="form-group">
                <label for="varchar">len <?php echo form_error('product_len') ?></label>
                <input type="text" class="form-control" name="product_len" id="product_len" placeholder="len" value="<?php echo $product_len; ?>" />
            </div>-->
	    <div class="form-group">
                <label for="decimal">price <?php echo form_error('product_price') ?></label>
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="price" value="<?php echo $product_price; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('picture') ?></label>
                <input type="text" class="form-control" name="picture" id="picture" placeholder="" value="<?php echo $picture; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum"> <?php echo form_error('status') ?></label>
                <input type="text" class="form-control" name="status" id="status" placeholder="" value="<?php echo $status; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('byproducts') ?>" class="btn btn-default">Cancel</a>
	</form>