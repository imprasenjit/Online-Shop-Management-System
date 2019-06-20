
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
						<h6 class="m-0 font-weight-bold text-primary">Purchase Order To Supplier </h6>
					</div>
					<!-- Card Body -->
					<div class="card-body" id="print_html">
                        <?php $supplier = $this->suppliers_model->get_by_id($supplier_id); ?>
                                            To,<br />
                                            <?php
                                            echo $supplier->name . '<br/>';
                                            echo $supplier->address . '<br/>';
											echo $supplier->mobile . '<br/>';
											echo '<hr/>';
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
                                       
                                        <?php if ($invoice_status != NULL) {
                                            $invoice_details=$this->invoice_model->get_by_id($invoice_id);
                                            ?>
                                            <hr/>
                                            <h6>Invoice Details from Supplier</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr><td width="25%">Company Name :</td><td> <?=$invoice_details->company_name;?></td></tr>
                                                <tr><td>Invoice No: </td><td><?=$invoice_details->invoice_no;?></td></tr>
                                                <tr><td>Invoice Date :</td><td> <?=date("d-m-Y",strtotime($invoice_details->invoice_date));?></td></tr>
                                                <tr><td>Lorry No : </td><td><?=$invoice_details->lorry_no;?></td></tr>
                                                <tr><td>Date : </td><td><?=date("d-m-Y",strtotime($invoice_details->lorry_date));?></td></tr>
                                                <tr><td>Invoice Document :</td><td> <a href="<?=base_url($invoice_details->invoice_doc);?>" target="_blank" class="btn btn-primary btn-sm">Download</a></td></tr>
                                        </tbody>
                                            </table>
                                        <?php } else {
                                            echo '<span class="text-danger">Invoice is not generated.</span>';
                                        } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

												<a href="<?= base_url("admin/purchase_orders/purchase_order_to_supplier_list"); ?>" class="btn btn-sm btn-primary">Close</a>
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
