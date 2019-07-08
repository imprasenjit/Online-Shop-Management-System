<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Purchase Order View</h6>
				</div>
				<div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <?php if($purchase_order_to_supplier_id!=NULL){?>
                                                <tr>
                                                    <td>Supplier Details</td>
                                                    <td>

                                                            <?php $supplier = $this->suppliers_model->get_by_id($supplier_id); ?>
                                                            <?php
                                                            echo $supplier->name . '<br/>';
                                                            echo $supplier->address . '<br/>';
                                                            echo $supplier->mobile . '<br/>';
                                                            ?>

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td width="30%">
                                                    Purchase Order No : <?=$purchase_order_to_warehouse_id?>
                                                    </td>
                                                    <td>
                                                    Purchase Order  Date: <?php echo date("d-m-Y", strtotime($created_at)); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td width="30%">Customer Details</td>
                                                    <td>
                                                            <?php $customer_details = $this->customers_model->get_by_id($customer_id);
                                                            ?>
                                                            <?php
                                                            echo !empty($customer_details->name) ?  $customer_details->name : ""; '<br/>';
                                                            echo !empty($customer_details->contact) ? $customer_details->contact : ""; '<br/>';
                                                            ?>
                                                    <?php if($customer_address!=NULL){
                                                        echo !empty($customer_address)?$customer_details->contact:"", '<br/>';
                                                    }else{
                                                        echo !empty($customer_details->address)?$customer_details->address:""; '<br/>';
                                                    }?>
                                                    </td>
                                                </tr>
                                                <?php
                                                if($purchase_order_from_customer_id!=NULL){
                                                $client_po_details=$this->purchase_order_model->get_by_id($purchase_order_from_customer_id);
                                                ?>
                                                <tr>
                                                    <td width="30%">
                                                    Purchase Order No: <?=$purchase_order_from_customer_id?>
                                                    </td>
                                                    <td>
                                                    Purchase Order  Date: <?php echo !empty($client_po_details->created_at)? date("d-m-Y", strtotime($client_po_details->created_at)) :""; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if ($invoice_id != NULL) {
                                            $invoice_details = $this->invoice_model->get_by_id($invoice_id);
                                            ?>
                                            MANUFACTURER/SOURCING POINT DETAILS
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="30%">Company Name :</td>
                                                        <td> <?= $invoice_details->company_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice No: </td>
                                                        <td><?= $invoice_details->invoice_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice Date :</td>
                                                        <td> <?= date("d-m-Y", strtotime($invoice_details->invoice_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lorry No : </td>
                                                        <td><?= $invoice_details->lorry_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date : </td>
                                                        <td><?= date("d-m-Y", strtotime($invoice_details->lorry_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice Document :</td>
                                                        <td> <a href="<?= $invoice_details->invoice_doc ?>" target="_blank" class="btn btn-sm btn-primary">Download</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <?php }?>
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
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                    <a href="<?=base_url("admin/purchase_orders/purchase_order_to_warehouse_list");?>" class="btn btn-primary btn-sm">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
