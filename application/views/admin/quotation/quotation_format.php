
	<div class="container-fluid">
		<div class="mb-4">
			<?=$this->breadcrumbs->show();?>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Quotation To Customer </h6>
					</div>
					<div class="card-body" id="print_html">
						<?php
						if ($quotation_details) {
							$cust_result = $this->enquires_model->get_by_id($quotation_details->enquiry_id);
							?>
							<div class="float-right">
								<p class="text-left">
									Quotation No: <?php echo $quotation_details->quotation_ref; ?><br />
									Quotation Date: <?php echo date('d-m-Y', strtotime($quotation_details->quotation_date)); ?>
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

							<p><?php echo $quotation_details->editordata; ?></p>
						<?php
						$enq_enq_ref = !empty($cust_result->enq_ref)?$cust_result->enq_ref:"";
						$enquiry_placed_date = !empty($cust_result->enquiry_placed_date)?$cust_result->enquiry_placed_date:"";
						$sl = 1;
						$quotation_id = $quotation_details->quotation_id;
						$enquiry_id = $quotation_details->enquiry_id;
						$editordata = $quotation_details->editordata;
						$editordata2 = $quotation_details->editordata2;
						$this->load->view("admin/products/product_table_format",array("product"=>$quotation_details));
						?>

							<p><?php echo $quotation_details->editordata2; ?></p>

						<div class="row">
							<div class="col-md-12 pl-4">
								From <br />
								Supply Origin <br />G.S. Road Bhangagarh <br />Guwahati
							</div>
						</div>
						<?php }else{
							echo 'No Record Found';
						} ?>
					</div>
					<div class="card-footer">
					<a href="<?= base_url("admin/quotation"); ?>" class="btn btn-sm btn-primary">Close</a>
					<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$rowHeader=$this->settings_model->get_row("key", "PDF_HEADER");
$headerImg = $rowHeader?$rowHeader->values:'assets/admin/img/header.png';

$rowFooter=$this->settings_model->get_row("key", "PDF_FOOTER");
$footerImg = $rowFooter?$rowFooter->values:'assets/admin/img/footer.png';
?>
<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", "#print_content", function () {
            $("#print_html").print({
                globalStyles: true,
                mediaPrint: true,
                stylesheet: "<?= base_url("assets/admin/css/print.css"); ?>",
                iframe: false,
                noPrintSelector: ".btn",
                prepend: '<div style="position:relative;left:0;top:0;width:100%; height:50mm"><img src="<?=base_url($headerImg)?>" style="width: 100%; height:100%" /></div>',
                append: '<div style="position:fixed;left:0;bottom:0;width:100%; height:50mm"><img src="<?= base_url($footerImg) ?>" style="width: 100%; height:100%;" /></div>',
                deferred: $.Deferred().done(function () {
                    console.log('Printing done', arguments);
                })
            });
        });
    });
</script>
