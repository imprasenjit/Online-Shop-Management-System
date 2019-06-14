<!DOCTYPE html>
<html>
    <head>
        <title>Test page</title>
    </head>
    <body>
        <?php 
        $id = 4;//$this->uri->segment(3);
        $row=$this->proforma_invoice_model->get_by_id($id);
        if($row) {
            $purchase_order_id = $row->purchase_order_id;
            $customer_id = $row->customer_id;
            $pro_inv_no = $row->pro_inv_no;
            $products = $row->products;
            $quantity =  $row->quantity;
            $product_unit =  $row->product_unit;
            $attributes =  $row->attributes;
            $others =  $row->others;
            $product_price =  $row->product_price;
            $tax_rate =  $row->tax_rate;
            $cgst =  $row->cgst;
            $sgst =  $row->sgst;
            $igst =  $row->igst;
            $exyard =  $row->exyard;
            $frieght =  $row->frieght;
            $total =  $row->total;
            $editordata =  $row->editordata;
            $editordata2 =  $row->editordata2;
            $created_at= $row->created_at; ?>

            <link async href="<?= base_url("assets/admin/css/sb-admin-2.css"); ?>" rel="stylesheet">
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
                            $product_details = array(
                                "productid" => $products,
                                "others" => $others,
                                "quantity" => $quantity,
                                "product_unit" => $product_unit,
                                "tax_rate" => $tax_rate,
                                "attributes" => $attributes,
                                "product_price" => $product_price,
                                "cgst" => $cgst,
                                "sgst" => $sgst,
                                "igst" => $igst,
                                "exyard" => $exyard,
                                "frieght" => $frieght,
                                "total" => $total,
                            );
                            $this->load->view("admin/products/product_table_format", array("product" => (object) $product_details));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $editordata2; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } else {
            echo "No records found";
        }//End of if else ?>
    </body>
</html>
