<br />
<script>
    $(document).ready(function() {
        $('#products').addClass('active');
    });
</script>
<div>
    <div class="content-wrapper">
        <div class="item-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url($product->picture); ?>" class="img-rounded product-image" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-7 col-md-offset-5">
                            <h2><?php echo $product->product_name; ?></h2><br />
                        </div>
                        <br />
                        <form id="addtocart" class="form-horizontal" method="post" action="<?= base_url(); ?>shopping/add">
                            <?php
                            $product_id = $product->id;
                            //echo $product_id; die();
                            $attribute_list = $this->products_model->get_by_id($product_id);
                            $attributes = $product->attributes;
                            if ($attribute_list != null) {
                                $jsonData = stripslashes(html_entity_decode($attributes));
                                $jsonDecode = json_decode('' . $jsonData . '', true);
                                //print_r($jsonDecode); die();
                                foreach ($jsonDecode['data'] as $key => $attr) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-5 text-right"><?= $attr ?>: </label>
                                        <div class="col-md-7">
                                            <!--<input value="" id="attributes" data-name="<?= $attr ?>" class="form-control attr_values" size="10" name="attributes[]">-->
                                            <?php
                                            $pid = $this->uri->segment(3);
                                            $attribute_value = $this->attribute_model->get_attribute_value($pid, "attr" . ($key + 1) . "");
                                            //var_dump($attribute_value);
                                            ?>
                                            <select class="form-control attr_values" name="attributes[]" data-name="<?= $attr ?>">
                                                <option value="">Please Select</option>
                                                <?php foreach ($attribute_value as $value) { ?>
                                                    <option value="<?= $value->attr_value; ?>"><?= $value->attr_value ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php    }
                        }
                        ?>
                            <div class="form-group">
                                <label class="col-md-5 text-right">Quantity:</label>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="number" min="0" class="form-control" name="qty<?php echo $product->id ?>" id="qty<?php echo $product->id ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="product_unit<?php echo $product->id ?>" class="form-control" id="product_unit<?php echo $product->id ?>">
                                                <option>MT</option>
                                                <option>KG</option>
                                                <option>Pcs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 text-right">Others: </label>
                                <div class="col-md-7">
                                    <textarea class="form-control" type="text" size="10" name="others<?php echo $product->id ?>" id="others<?php echo $product->id ?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5"></label>
                                <div class="col-md-7">
                                    <a id="add_to_cart" product_id="<?= $product->id ?>" href="#!" class="btn btn-primary add_to_cart btn-block openmodal">
                                        <span class="fa fa-shopping-cart"></span>&nbsp; Add to Enquiry Cart </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 product-info">
                        <ul id="myTab" class="nav nav-tabs nav_tabs">
                            <li class="active"><a href="#service-one" data-toggle="tab">WEIGHT CHART</a></li>
                            <li><a href="#service-two" data-toggle="tab">ADDITIONAL INFO</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="service-one">
                                <section class="product-info product-weight-chart">
                                <?php if($product->specification!=""){?>
                                <img src="<?php echo base_url($product->specification); ?>" style="width:500px !important;">
                                <?php } ?>
                                <?php echo htmlspecialchars_decode($product->weight_chart); ?>
                                    <!--<table class="table table-bordered">
                                        <tr class="table-tr">
                                            <?php foreach ($jsonDecode['data'] as $jsn) { ?>
                                                <th><?= $jsn; ?></th>
                                            <?php } ?>
                                        </tr>
                                        <?php $result = $this->attribute_model->get_all_product_attribute($product_id);
                                        $i = 1;
                                        foreach ($result as $row) { ?>
                                            <tr>
                                                <?php foreach ($jsonDecode['data'] as $key => $jsn) { ?>
                                                    <td><?php $attr = "attr" . ($key + 1);
                                                        echo $row->$attr; ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>-->
                                </section>
                            </div>
                            <div class="tab-pane fade in" id="service-two">
                                <section class="product-info">
                                    
                                    <p class="text-justify"><?php echo $product->description; ?><p>
                                </section>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".openmodal", function() {
            $(this).empty().append("Processing..");
            var id = $(this).attr("product_id");
            var qty = $("#qty" + id + "").val();
            var product_unit = $("#product_unit" + id + "").val();
            var attributes = [];
            var attr_names = [];
            $('.attr_values').each(function() {
                attributes.push($(this).attr("data-name"));
            });
            $('.attr_values').each(function() {
                attr_names.push($(this).val());
            });
            console.log(attributes);
            var others = $("#others" + id + "").val();
            //$('#cart_modal').modal('show'); alert("pid : "+qry);
            $.ajax({
                method: "POST",
                url: '<?= base_url("shopping/add") ?>',
                //dataType: 'json',
                data: {
                    "id": id,
                    "qty": qty,
                    "product_unit": product_unit,
                    "attributes": attributes,
                    attr_names: attr_names,
                    "others": others
                },
                success: function(res) {
                    $('#cart_modal').modal('show');
                    $("#cartdetails").empty().html(res);
                    $('#add_to_cart').empty().append("Add to Cart");
                },
                failure: function(res) {
                    alert(response);
                }
            });
        });
    });

    function clear_cart() {
        var result = confirm('Are you sure want to clear cart?');
        if (result) {
            window.location = "<?php echo base_url(); ?>index.php/shopping/remove/all";
        } else {
            return false; // cancel button
        }
    }
</script>