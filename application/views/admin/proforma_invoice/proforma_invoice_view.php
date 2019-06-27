    <div class="container-fluid">
    	<div class="mb-4">
    		<?= $this->breadcrumbs->show(); ?>
    	</div>
    	<div class="row">
    		<!-- Area Chart -->
    		<div class="col-xl-12 col-lg-12">
    			<div class="card shadow mb-4">
    				<!-- Card Header - Dropdown -->
    				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    					<h6 class="m-0 font-weight-bold text-primary">Proforma Invoice</h6>
    				</div>
    				<!-- Card Body -->
    				<div class="card-body" id="print_html">
              			Ref : With reference to Purchase Order No. <?=$purchase_order_ref?>
    					<?= $editordata ?>    								
    									<?php
										$product_details=array(
											"productid"=>$products,
											"others"=>$others,
											"quantity"=>$quantity,
											"product_unit"=>$product_unit,
											"tax_rate"=>$tax_rate,
											"attributes"=>$attributes,
											"product_price"=>$product_price,
											"cgst"=>$cgst,
											"sgst"=>$sgst,
											"igst"=>$igst,
											"exyard"=>$exyard,
											"frieght"=>$frieght,
											"total"=>$total,
										);
										$this->load->view("admin/products/product_table_format",array("product"=>(object)$product_details)); ?>

										<?= $editordata2; ?>
										

					</div>
					<div class="card-footer">
					<a href="<?= base_url("admin/proforma_invoice"); ?>" class="btn btn-sm btn-primary float-right">Close</a>
					<a href="<?= base_url("admin/purchase_orders/send_po_to_supplier/$purchase_order_id") ?>" class="btn btn-sm btn-info">Send PO to supplier</a>
    				<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
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
