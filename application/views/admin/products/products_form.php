<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $button ?> Product</h6>
                </div>
                <!-- Card Body -->
                <form class="form-horizontal" action="<?php echo $action; ?>" method="post" id="myform">
                <div class="card-body">
                   
                        <div class="row">
                            <!-- <div class="form-group full-width"> -->
                            <div class=" col-md-6">
                                <label>Product Name</label>
                                <input type="text" class="form-control form-control-sm" name="product_name" id="product_name" placeholder="Product Name" value="<?php echo $product_name; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label>Select Category<?php echo form_error('product_category') ?></label>
                                <select class="form-control form-control-sm" name="product_category" id="product_category">
                                    <option value="">Please Select</option>
                                    <?php
                                    $category = $this->category_model->get_all();
                                    foreach ($category as $p) {
                                        ?>
                                        <option value="<?= $p->id ?>" <?php if ($p->id == $product_category) echo 'selected="selected"'; ?>><?= $p->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="row">
                            <!-- <div class="form-group full-width"> -->
                            <div class="col-md-6">
                                <label>Select Sub-Category</label>
                                <select class="form-control form-control-sm" name="product_sub_category" id="product_sub_category">
                                    <?php
                                    $subcategory = $this->sub_category_model->get_all($product_category, "array");
                                    foreach ($subcategory as $sc) {
                                        ?>
                                        <option value="<?= $sc->id; ?>" <?php echo ($sc->id == $product_sub_category) ? 'selected="selected"' : ''; ?>><?= $sc->sub_category ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Tax Rate</label>
                                <select class="form-control form-control-sm" name="tax_rate">
                                    <option value="5" <?= ($tax_rate == 5) ? "selected" : ""; ?>>5</option>
                                    <option value="9" <?= ($tax_rate == 9) ? "selected" : ""; ?>>9</option>
                                    <option value="12" <?= ($tax_rate == 12) ? "selected" : ""; ?>>12</option>
                                    <option value="18" <?= ($tax_rate == 18) ? "selected" : ""; ?>>18</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>HSN Code</label>
                                <input name="hsn_code" value="<?= $hsn_code ?>" id="hsn_code" placeholder="HSN CODE" type="text" class="form-control form-control-sm" />
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Product Description"><?php echo $description; ?></textarea>
                            </div>
                            <div class="col-md-12">
                              <div class="checkbox">
                                <label><input type="checkbox" value="1" <?=$show_description?"checked":""?> name="show_description">Show Description in Frontend</label>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Weight Chart</label>
                                <textarea type="text" name="weight_chart" id="weight_chart"><?php echo htmlspecialchars_decode($weight_chart); ?></textarea>
                            </div>
                            <div class="col-md-12">
                            <div class="checkbox">
                              <label><input type="checkbox" value="1"  <?=$show_weight_chart?"checked":""?> name="show_weight_chart">Show Weight Chart in Frontend</label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group full-width">
                                    <div class=" col-md-12">
                                        <br />
                                        <label>Upload Product Image <?php echo form_error('picture') ?></label>
                                        <?php if ($picture) { ?>
                                            <input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $picture; ?>" />
                                            <img src="<?php echo base_url($picture); ?>" class="img-responsive" style="width:120px;height:100px;">
                                        <?php } else { ?>
                                            <input type="file" name="picture" id="picture" data-error="Please upload product image." value="<?php echo $picture; ?>" />
                                        <?php } ?>
                                    </div>
                                    <div class=" col-md-12">
                                        <br />
                                        <label>Upload Specification Image <?php echo form_error('specification') ?></label>
                                        <?php if ($specification) { ?>
                                            <input type="file" name="specification" id="specification" data-error="Please upload Specification image." value="" />
                                            <img src="<?php echo base_url($specification); ?>" class="img-responsive" style="width:120px;height:100px;">
                                        <?php } else { ?>
                                            <input type="file" name="specification" id="specification" data-error="Please upload product image." />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Attributes</label>
                                <table class="table table-bordered table-striped" id="attr_table">
                                    <?php
                                    if ($attributes != NULL) {
                                        $jsonData = stripslashes(html_entity_decode($attributes));
                                        $jsonDecode = json_decode('' . $jsonData . '', TRUE);
                                        //print_r($jsonDecode);
                                        foreach ($jsonDecode["data"] as $item) {
                                            ?>
                                            <tr>
                                                <td><input value="<?= $item; ?>" class="form-control form-control-sm" name="attributes[]"></td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning add-button" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    <a class="btn btn-sm btn-danger delete-button" href="#!"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php }
                                } else { ?>
                                        <tr>
                                            <td><input class="form-control form-control-sm" name="attributes[]"></td>
                                            <td>
                                                <a class="btn btn-sm btn-warning add-button" href="#!"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                <!--<a class="btn btn-sm btn-danger delete-button" href="#!"><i class="fa fa-minus" aria-hidden="true"></i></a>-->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <a href="<?php echo site_url('admin/products') ?>" class="btn btn-sm btn-info">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
<link href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>" rel="stylesheet">
<script src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
<script>
    $('#weight_chart').summernote({
        tabsize: 2,
        height: 200
    });
    $(document).ready(function($) {
        $("#picture").pekeUpload({
            bootstrap: true,
            url: "<?= base_url(); ?>upload/",
            data: {
                file: "picture"
            },
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
        $("#specification").pekeUpload({
            bootstrap: true,
            url: "<?= base_url(); ?>upload/",
            data: {
                file: "specification"
            },
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
        $('#myform').submit(function(e) {
            if ($('#product_sub_category').val() == "") {
                e.preventDefault();
                alert("Please Select Product Sub Category");
            }
        });
        $('#product_category').change(function() {
            //alert($(this).val()); die();
            getSubCategory($(this).val());
        });
        $(document).on('click', '.add-button', function() {
            $('#attr_table').append('<tr>\
            <td><input class="form-control  form-control-sm" name="attributes[]"></td>\
            <td><a class="btn btn-sm btn-danger delete-button" href="#!"><i class="fa fa-minus" aria-hidden="true"></i></a>\
            </td>\
            </tr>');
        });
        $(document).on('click', '.delete-button', function() {
            $(this).parent().parent().remove();
        });
    });
    function getSubCategory(val) {
        $.ajax({
            type: "post",
            url: "<?= base_url('admin/products/get_sub_category') ?>",
            data: {
                id: val
            },
            success: function(data) {
                $("#product_sub_category").html(data);
            }
        });
    }
</script>
