
	<div class="container-fluid">
		<div class="mb-4">
			<?=$this->breadcrumbs->show();?>
		</div>
		<div class="row">
			<!-- Area Chart -->
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Quotation To Customer </h6>
						<div class="dropdown no-arrow">
							<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
								<div class="dropdown-header">Dropdown Header:</div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<!-- Card Body -->
					<div class="card-body" id="print_html">
						<?php
						$qid = $this->uri->segment(4);
						$rowq = $this->quotation_model->get_by_id($qid);
						
						if ($rowq) {
							$cust_result = $this->enquires_model->get_by_id($rowq->enquiry_id);
							?>
							<div class="float-right">
								<p class="text-left">
									Quotation No: <?php echo $this->uri->segment(4); ?><br />
									Quotation Date: <?php echo date('d-m-Y', strtotime($rowq->quotation_date)); ?>
								</p>
							</div>
							<?php
							if ($cust_result) {
								?>
								<div class="float-left">
									<p class="text-left">
										To,<br/>
										<?= $cust_result->name ?><br>
										<?= $cust_result->contact ?><br>
										<?= $cust_result->email ?><br>
										<?= $cust_result->address ?><br>
								</div>
							<?php
						}
						?>
						<div class="clearfix"></div>

							<p><?php echo $rowq->editordata; ?></p>
						<?php 
						$enq_unique_id = $cust_result->unique_id;
						$enquiry_placed_date = $cust_result->enquiry_placed_date;
						$sl = 1;
						$quotation_id = $rowq->quotation_id;
						$enquiry_id = $rowq->enquiry_id;
						$editordata = $rowq->editordata;
						$editordata2 = $rowq->editordata2;
						$this->load->view("admin/products/product_table_format",array("product"=>$rowq));	
						?>
							
							<p><?php echo $rowq->editordata2; ?></p>
						
						<div class="row">
							<div class="col-md-12 pl-4">
								From <br />
								Supply Origin <br />G.S. Road Bhangagarh <br />Guwahati
							</div>
						</div>
						<div align="center">
							<a href="<?= base_url("admin/quotation"); ?>" class="btn btn-sm btn-primary">Close</a>
							<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
						</div>
						<?php }else{
							echo 'No Record Found';
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on("click","#print_content",function(){
                    //Print ele4 with custom options
                    $("#print_html").print({
                        //Use Global styles
                        globalStyles : true,
                        //Add link with attrbute media=print
                        mediaPrint : true,
                        //Custom stylesheet
                        stylesheet : "<?=base_url("assets/admin/css/sb-admin-2.css");?>",
                        stylesheet : "<?=base_url("assets/admin/css/print.css");?>",
                        //Print in a hidden iframe
                        iframe : false,
                        //Don't print this
                        noPrintSelector : ".btn",
                        //Add this at top
                        prepend : "Quotation",
                        //Add this on bottom
                        append : "<span><br/></span>",
                        //Log to console when printing is done via a deffered callback
                        deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })

                    });
                });
                });

</script>