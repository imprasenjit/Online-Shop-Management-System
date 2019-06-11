<div class="container-fluid">
	<div class="mb-4">
		<?= $this->breadcrumbs->show(); ?>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Attribute</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<form class="form-horizontal" action="<?php echo $action; ?>" method="post">
						<div class="form-group">
							<label>Product Name</label>
							<select class="form-control form-control-sm form-control-sm" name="product_id" id="product_id">
								<option value="">Please Select</option>
								<?php foreach ($product_id as $p) { ?>
									<option value="<?= $p->id ?>"><?= $p->product_name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<div id="attributes"> </div>
						</div>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="submit" class="btn btn-sm btn-primary"><?php echo $button ?></button>
						<a href="<?php echo site_url('admin/attribute') ?>" class="btn btn-sm btn-info">Cancel</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		//alert("yy");
		$('#myform').submit(function(e) {
			if ($('#product_id').val() == "") {
				e.preventDefault();
				alert("Please Select product name.");
			}
		});
	});
	$("#product_id").change(function() {
		var id = $(this).val(); //alert(id);die();
		var divid = "#pid" + id;
		$(".hideall").hide();
		$(divid).show();
		$.ajax({
			type: "post",
			url: "<?= base_url('admin/attribute/getAttributesDetails/"+id+"') ?>",
			dataType: 'json',
			success: function(res) {
				$('#attributes').empty();
				var data = jQuery.parseJSON(res);
				$(data.data).each(function(key, value) {
					$('#attributes').append('<div class="form-group"> <label class="col-md-12">' + value + ': </label> <div class="col-md-12"> <input value="" id="attributes' + (key + 1) + '" class="form-control form-control-sm attr_values" size="10" name="attributes' + (key + 1) + '"> </div> </div>');
				});
				//console.log(data.data);
			}
		});
	});
</script>