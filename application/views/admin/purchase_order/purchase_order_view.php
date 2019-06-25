<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Order View</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="print_html">
                    <input type="hidden" name="quotation_id" value="<?= $quotation_id ?>">
                    To,<br />
                    Hitech Industries<br />
                    Guwahati<br />
                    Subject: Purchase Order<br />
                    Terms &amp; Conditions valid as per quotation received.<br /><br />

                    Ref : With reference to Quotation No. <?= $quotation_id ?>
                    <br /><br />
                    <?php
                    $product = array(
                        "productid" => $product,
                        "others" => $others,
                        "quantity" => $quantity,
                        "product_unit" => $unit,
                        "tax_rate" => $tax_rate,
                        "attributes" => $attributes,
                        "product_price" => $price,
                        "cgst" => $cgst,
                        "sgst" => $sgst,
                        "igst" => $igst,
                        "exyard" => $exyard,
                        "frieght" => $frieght,
                        "total" => $total,
                    );
                    $this->load->view("admin/products/product_table_format", array("product" => (object)$product));
                    ?>
                    <div class="row">
                        <div class="col-md-6">Billing Address:<br />
                            <?php echo $billing_address; ?>
                        </div>
                        <div class="col-md-6">Delivery Address:<br />
                            <?php echo $delivery_address; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Contact Person Name:<br />
                            <?php echo $contact_person_name; ?>
                        </div>
                        <div class="col-md-6">Contact Person Mobile:<br />
                            <?php echo $contact_person_mobile; ?>
                        </div>
                    </div>
                    <hr />
                    Customer Details:<br />
                    <?php
                    $customer = $this->customers_model->get_by_id($customer_id);
                    echo $customer->name . "<br/>";
                    echo $customer->contact . "<br/>";
                    echo $customer->email . "<br/>";
                    echo $customer->address . "<br/>";
                    ?>
                    <hr />
                    <div>
                        <a href="<?= base_url("admin/purchase_orders"); ?>" class="btn btn-sm btn-primary float-right">Close</a>
                        <?php if ($purchase_order_supplier_id) {?>
                           <a href="#!" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i>PO Sent</a>&nbsp;
                        <? } else { ?>
                            <a href="<?= base_url("admin/purchase_orders/send_po_to_supplier/$potoadmin_id") ?>" class="btn btn-sm btn-info">Send PO</a>
                        <?php }
                    if ($porforma_invoice_id) {?>
                        <a href="#!" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i>PI Sent</a>&nbsp;
                    <?php } else { ?>
                            <a href="<?= base_url("admin/proforma_invoice/send_pi_to_customer/$potoadmin_id") ?>" class="btn btn-sm btn-warning">Send PI</a>
                        <?php }
                    ?>
                        <?php if ($order_status) { ?>
                            <a href="#!" class="btn btn-sm btn-danger cancel_po" data-po-id="<?= $potoadmin_id ?>">Cancel PO</a>
                        <?php } else { ?>
                            <a href="#!" class="btn btn-sm btn-danger disabled">Canceled</a>
                        <?php } ?>

                        <a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$rowHeader = $this->settings_model->get_row("key", "PDF_HEADER");
$headerImg = $rowHeader ? $rowHeader->values : 'assets/admin/img/header.png';

$rowFooter = $this->settings_model->get_row("key", "PDF_FOOTER");
$footerImg = $rowFooter ? $rowFooter->values : 'assets/admin/img/footer.png';
?>
<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "#print_content", function() {
            $("#print_html").print({
                globalStyles: true,
                mediaPrint: true,
                stylesheet: "<?= base_url("assets/admin/css/print.css"); ?>",
                iframe: false,
                noPrintSelector: ".btn",
                prepend: '<div style="position:relative;left:0;top:0;width:100%; height:50mm"><img src="<?= base_url($headerImg) ?>" style="width: 100%; height:100%" /></div>',
                append: '<div style="position:fixed;left:0;bottom:0;width:100%; height:50mm"><img src="<?= base_url($footerImg) ?>" style="width: 100%; height:100%;" /></div>',
                deferred: $.Deferred().done(function() {
                    console.log('Printing done', arguments);
                })
            });
        });

        $(document).on("click", ".cancel_po", function() {
            var element = $(this);
            var po_id = $(this).attr("data-po-id");
            $(this).empty().append("Processing...");
            $.ajax({
                url: "<?= base_url("admin/purchase_orders/cancel_purchase_order/") ?>",
                method: "POST",
                data: {
                    po_id: po_id
                },
                dataType: "json",
                success: function(jsn) {
                    if (jsn.x == 1) {
                        element.removeClass("btn-danger").addClass("disabled");
                        element.empty().append('<i class="glyphicon glyphicon-ok"></i>&nbsp;Cancelled');
                        $.notify({
                            message: 'PO Canceled Successfully'
                        }, {
                            // settings
                            type: 'success',
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                            offset: {
                                x: 20,
                                y: 100
                            }
                        });
                    } else {
                        element.empty().append('<i class="glyphicon glyphicon-warning-sign"></i>&nbsp;Error');
                    }
                }
            });
        });
    });
</script>