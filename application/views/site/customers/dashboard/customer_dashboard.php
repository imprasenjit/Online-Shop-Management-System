	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<?php echo $this->breadcrumbs->show(); ?>
			<div class="panel-group">
				<div class="panel panel-default">
				<div class="panel-heading">
						Dashboard
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
                                    targets: 2
                                }],
									"columns": [{
											"data": "enquiry_placed_date"
										},
										{
											"data": "unique_id"
										},
										{
											"data": "id"
										},
									],
									"processing": true,
									"serverSide": true,
									"ajax": {
										"url": "<?= base_url("customers/dashboard/getCustomerDashboard") ?>",
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
						<table class="table table-hover table-bordered" id="dtbl">
							<thead>
								<tr>
									<th>Enquiry Date</th>
									<th>Enquiry No</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<br>
<br>