
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
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <!-- <div class="dropdown-header">Dropdown Header:</div>
                             <a class="dropdown-item" href="#">Action</a>
                             <a class="dropdown-item" href="#">Another action</a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="#">Something else here</a>-->
                        </div>
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
                    $this->load->view("admin/products/product_table_format", array("product" => (object) $product));
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
                    <hr/>
                    Customer Details:<br />
                    <?php
                    $customer = $this->customers_model->get_by_id($customer_id);
                    echo $customer->name . "<br/>";
                    echo $customer->contact . "<br/>";
                    echo $customer->email . "<br/>";
                    echo $customer->address . "<br/>";
                    ?>
                    <hr/>
                    <div>
                        <a href="<?= base_url("admin/purchase_orders"); ?>" class="btn btn-sm btn-primary float-right">Close</a>
                        <a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/admin/js/jquery.print.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", "#print_content", function () {
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
                prepend: '<img src="<?= base_url('assets/admin/img/header.png') ?>" style="width: 100%; height:200px" />',
                //Add this on bottom
                append: '<img src="<?= base_url('assets/admin/img/footer.png') ?>" style="width: 100%; height:200px" />',
                //Log to console when printing is done via a deffered callback
                deferred: $.Deferred().done(function () {
                    console.log('Printing done', arguments);
                })

            });
        });
    });
</script>
