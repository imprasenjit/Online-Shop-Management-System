
<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Enquiriy No : <?php echo $result->unique_id ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="print_html">
                    <?php
                    $sl = 1;
                    if ($result) {
                        ?>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left"><?= $result->name; ?></td>
                                    <td class="text-left"><?= $result->contact; ?></td>
                                    <td class="text-left"><?= $result->email; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><strong>Customer Address :</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <?= $result->address; ?>&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7"><strong>Billing State :</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <?= $result->state; ?>&nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <h3>No records found! Try again.</h3>
                    <?php } ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>Product Information </strong>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        $enquery_detail = $this->enquires_model->get_product_details($result->enquiry_id);
                                        $slno = 1;
                                        if ($enquery_detail) {
                                            ?>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl No.</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Attributes</th>
                                                        <th>Others</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($enquery_detail as $products) {
                                                        $product_id = $products->productid;
                                                        $productname = $this->products_model->get_by_id($products->productid)->product_name;
                                                        ?>
                                                        <tr>
                                                            <td class="text-left"><?= $slno; ?></td>
                                                            <td class="text-left"><?= $productname; ?></td>
                                                            <td class="text-left"><?= $products->quantity; ?><?= $products->product_unit; ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if ($products->attributes != "") {
                                                                    $attributes_decoded = json_decode($products->attributes, true);
                                                                    $sl = 1;
                                                                    foreach ($attributes_decoded["attributes"] as $key => $values) {
                                                                        if ($values[0] != "") {
                                                                            echo $values[0];
                                                                            echo " : ";
                                                                            echo $values[1];
                                                                            echo "<br/>";
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?= $products->others; ?></td>
                                                        </tr>
                                                        <?php
                                                        $slno++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <h3>No records found! Try again.</h3>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url("admin/quotation/send_quotation/" . $result->enquiry_id . ""); ?>"><input type="button" class="btn btn-sm btn-info" value="Send Quotation"></a>
                    <a href="<?= base_url("admin/enquires"); ?>" class="btn btn-sm btn-danger">Close</a>
                    <a href="#!" id="print_content" class="btn btn-sm btn-warning">Print</a>
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
                prepend: '<img src="<?=base_url($headerImg)?>" style="width: 100%; height:200px" />',
                append: '<div style="position:fixed;left:0;bottom:0"><img src="<?=base_url($footerImg)?>" style="width: 100%; height:200px;" /></div>',
                deferred: $.Deferred().done(function () {
                    console.log('Printing done', arguments);
                })
            });
        });
    });
</script>
