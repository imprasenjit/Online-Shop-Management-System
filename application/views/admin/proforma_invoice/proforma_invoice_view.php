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
    					<div class="dropdown no-arrow">
    						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    						</a>
    						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
    							<!-- <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
								-->
    						</div>
    					</div>
    				</div>
    				<!-- Card Body -->
    				<div class="card-body" id="print_html">
    					<table class="table table-bordered" id="proforma_table">
    						<tbody>
    							<tr>
    								<td colspan="11" class="text-left">
    									<?= $editordata ?>
    								</td>
    							</tr>
    							<tr>
    								<td>
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
									
    									
    								</td>
    							</tr>
    							<tr>
    								<td>
    									<?= $editordata2; ?>
    								</td>
    							</tr>

    						</tbody>
    					</table>


    					<a href="<?= base_url("admin/proforma_invoice"); ?>" class="btn btn-sm btn-primary float-right">Close</a>
    					<a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
    				</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>

    <script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$(document).on("click", "#print_content", function() {
    			//Print ele4 with custom options
    			$("#print_html").print({
    				//Use Global styles
    				globalStyles: true,
    				//Add link with attrbute media=print
    				mediaPrint: true,
    				//Custom stylesheet
    				stylesheet: "<?= base_url("assets/admin/css/sb-admin-2.css"); ?>",
    				stylesheet: "<?= base_url("assets/admin/css/print.css"); ?>",
    				//Print in a hidden iframe
    				iframe: false,
    				//Don't print this
    				noPrintSelector: ".btn",
    				//Add this at top
    				prepend: "Purchase Order",
    				//Add this on bottom
    				append: "<span><br/></span>",
    				//Log to console when printing is done via a deffered callback
    				deferred: $.Deferred().done(function() {
    					console.log('Printing done', arguments);
    				})

    			});
    		});
    	});
    </script>