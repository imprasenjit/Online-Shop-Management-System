	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/theme1/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="panel-group" style="margin-top:50px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						Proforma Invoice
					</div>
					<div class="panel-body">
						<?php if ($this->session->flashdata("message")) { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Success!</strong> <?= $this->session->flashdata("message") ?>
							</div>
						<?php } ?>
						<link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
						<link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
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
											"data": "slno"
										},
										{
											"data": "purchase_order_date"
										},
										{
											"data": "created_at"
										},
										{
											"data": "id"
										}
									],
									"processing": true,
									"serverSide": true,
									"ajax": {
										"url": "<?= base_url("customers/proforma_invoice/getProformaInvoice") ?>",
										"dataType": "json",
										"type": "POST",
									},
									language: {
										processing: "<div class='loading'></div>",
									},
									"order": [
										[0, 'asc']
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
									<th>Purchase Order Date</th>
									<th>Performa Invoice Date</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
