<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Warehouse Dashboard(Purchase Orders Recived)</h6>
				</div>
				<div class="card-body">
					<link href="<?= base_url('public/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
					<script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
					<script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							$.extend($.fn.DataTable.ext.classes, {
								sWrapper: "dataTables_wrapper dt-bootstrap4",
							});
							$("#dtbl").DataTable({
								"columnDefs": [{
									className: 'text-right',
									orderable: false,
									targets: 3
								}],
								"columns": [{
										"data": "sl_no"
									},
									{
										"data": "customer"
									},
                                    {
										"data": "po_date"
									},
									{
										"data": "action"
									}
								],
								"processing": true,
								"serverSide": true,
								"ajax": {
									"url": "<?= base_url("admin/warehouse/get_dtrecords_for_warehouse/") ?>",
									"dataType": "json",
									"type": "POST",
								},
								language: {
									processing: "<div class='loading'></div>",
								},
								"order": [
									[0, 'DESC']
								],
								"lengthMenu": [
									[20, 30, 50, 100, 200],
									[20, 30, 50, 100, 200]
								]
							});
							});
							</script>

					<table class="table table-bordered" id="dtbl">
						<thead>
							<tr>
                                <th>(#)</th>
                                <th>Customer</th>
                                <th>PO Date</th>
                                <th style="text-align:right">Action</th>
							</tr>
					</table>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$(document).on("click",".goods_dispatch",function(){
			var element=$(this);
			var po_id=$(this).attr("data-po-id");console.log(po_id);
			$(this).empty().append("Processing...");
			$.ajax({
				url:"<?=base_url("admin/warehouse/goods_dispatch_status/")?>",
				method:"POST",
				data:{purchase_order_to_warehouse_id:po_id},
				dataType:"json",
				success:function(jsn){
					if(jsn.x==1){
						element.removeClass("btn-warning").addClass("btn-success");
						element.empty().append('<i class="glyphicon glyphicon-ok"></i>&nbsp;Sent');

					}else{
						element.empty().append('<i class="glyphicon glyphicon-warning-sign"></i>&nbsp;Error');
					}
				}
			});
		});
	});
</script>
