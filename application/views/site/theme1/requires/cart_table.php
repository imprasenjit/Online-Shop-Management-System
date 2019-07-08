<table class="table table-hover">
        <?php
        if ($cart) { ?>
            <thead>
                <tr id="main_heading">
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Attributes</th>
                    <th>Others</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $i = 1;
            foreach ($cart as $item) { ?>
                <tr>
                    <td>
                        <?php echo $i++; ?>
                    </td>
                    <td>
                        <?php echo $item['name']; ?>
                    </td>
                    <td>
                        <?php echo $item['quantity']; ?>
                    </td>
                    <td>
                        <?php echo $item['product_unit']; ?>
                    </td>
                    <td>
                        <?php
                        $attr_names = $item["attributes"];
                        foreach ($item["attr_names"] as $key => $values) {
                            echo $attr_names[$key] . ' : ' . $values . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $item['others']; ?>
                    </td>
                    <td align="center">
                        <a href="<?= base_url(); ?>shopping/remove/<?= $item['rowid'] ?>" ]>
                            <font color="red"><i class="fa fa-times fa-2x" aria-hidden="true"></i></font>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>