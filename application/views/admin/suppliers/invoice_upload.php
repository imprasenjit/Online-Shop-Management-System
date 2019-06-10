<div class="container-fluid">
	<div class="row">
		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">MANUFACTURER/SOURCING POINT DETAILS</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<!--<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>-->
					</div>
				</div>
                <!-- Card Body -->
                <form class="form" action="<?= base_url("admin/suppliers/send_invoice_details_action");?>" method="post">
				<div class="card-body">                    
                        <?php $purchase_order_to_supplier_id=$this->uri->segment(4);?>
                        <input type="hidden" name="purchase_order_to_supplier_id" value="<?=$purchase_order_to_supplier_id;?>">
                        <div class="form-row mb-5 ">
                            <label for="company_name" class="col-sm-2 text-right control-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company_name">
                            </div>
                        </div>
                        <div class="form-row mb-5">
                            <label for="invoice_no" class="col-sm-2 text-right control-label">Invoice No</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="invoice_no">
                            </div>
                            <label for="invoice_date" class="col-sm-2 text-right control-label">Invoice Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="invoice_date">
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <label for="lorry_no" class="col-sm-2 text-right control-label">Lorry No</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="lorry_no">
                            </div>
                            <label for="lorry_date" class="col-sm-2 text-right control-label">Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="lorry_date">
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <label for="lorry_no" class="col-sm-2 text-right control-label">Upload Invoice <?php echo form_error('invoice') ?></label>
                            <div class="col-sm-10">
                                <input type="file" name="invoice" id="invoice" data-error="Please upload Invoice." />
                            </div>
                        </div>
                        <script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
                        <script>
                            $(document).ready(function($) {
                                $("#invoice").pekeUpload({
                                    bootstrap: true,
                                    btnText:"Upload Invoice",
                                    url: "<?= base_url(); ?>upload/",
                                    data: {
                                        file: "invoice"
                                    },
                                    limit: 1,
                                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
                                });
                            });
                        </script>
                        <div class="form-group mb-2">
                            <div class="col-sm-offset-2 col-sm-10">
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                        <div class="clearfix"></div>
                        <br/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>