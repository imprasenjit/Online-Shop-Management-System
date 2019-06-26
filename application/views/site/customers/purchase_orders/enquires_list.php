<div class="container">
	<div class="row profile">
		<div class="col-md-2">
			<?php $this->load->view("site/customers/profile"); ?>
		</div>
		<div class="col-md-10">
			<div class="panel-group" style="margin-top:50px;">

				<div class="panel panel-default">
				<div class="panel-heading">
					Purchase Orders
			    </div>
					<div class="panel-body">
						<?php if ($this->session->flashdata("message")) { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Success!</strong> <?= $this->session->flashdata("message") ?>
							</div>
						<?php } ?>
					<div style="margin-left: 30px;margin-right: 30px">
						<table class="table table-hover" style="margin-bottom:10px;">
							<tr>
								<th>Sl No.</th>
								<th>Enquiry ID</th>
								<th>Enquiry Date</th>
								<th width="37%" style="text-align:center">Action</th>
							</tr><?php
									$start = 1;
									//print_r($enquires_data);
									foreach ($enquires_data as $enquires) {
											?>
								<tr>
									<td><?php echo $start++ ?></td>
									<?php $enq_enq_ref = $enquires->enq_ref; ?>
									<td><?php echo $enq_enq_ref ?></td>
									<td><?php echo date("d-m-Y", strtotime($enquires->enquiry_placed_date)); ?></td>
									<td style="text-align:center">
										<?php
										echo anchor(site_url('customers/dashboard/enquiry_details/'.$enquires->enquiry_id .''), 'View Enquiry', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
										?>
									</td>
								</tr>
							<?php
						}
					?>
						</table>
					</div>
					<div class="row">
						<div class="col-md-6">
							<h4>Total Record : <?php echo $total_rows ?></h4>							
						</div>
						<div class="col-md-6 text-right">
							<?php echo $pagination ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>