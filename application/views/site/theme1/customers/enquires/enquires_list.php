	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/dashboard/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="panel-group" style="margin-top:50px;">
				<div class="panel panel-default">
				<div class="panel-heading">
					Enquires
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
								$(document).ready(function () {
									$.extend($.fn.DataTable.ext.classes, {
											sWrapper: "dataTables_wrapper dt-bootstrap4",
									});
										$("#dtbl").DataTable({
												"columns": [
														{"data": "slno"},
														{"data": "enq_ref"},
														{"data": "enquiry_placed_date"},
														{"data": "id"},
												],
												"processing": true,
												"serverSide": true,
												"ajax": {
														"url": "<?= base_url("customers/enquires/getEnquiries") ?>",
														"dataType": "json",
														"type": "POST",
												},
												language: {
														processing: "<div class='loading'></div>",
												},
												"order": [[0, 'asc']],
												"lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
										});
								});
						</script>
						<table class="table table-bordered" id="dtbl">
								<thead>
										<tr>
												<th width="5%">(#)</th>
												<!-- <th width="10%">Login Id</th> -->
												<th width="70%">Enquiry ID</th>
												<th width="20%">Enquiry Date</th>
												<th width="20%">Action</th>
										</tr>
								</thead>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
