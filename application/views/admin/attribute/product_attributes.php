<?php if ($results) {$jsonDecode = json_decode($results->attributes, true);
$sl_count=0;
    foreach ($jsonDecode['data'] as $key => $attr) {
        ?>
        <div class="">
            <label for="product_<?= $results->id; ?>attr[]"><?= $attr ?>: </label>
            <?php
            $attribute_value = $this->attribute_model->get_attribute_value($results->id, "attr" . ($key + 1) . "");
            ?>
            <select class="form-control form-control-sm attr_values" name="product_attr[]">
                <option value="">Please Select</option>
                <?php foreach ($attribute_value as $value) { ?>
                    <option value="<?= $value->attr_value; ?>"><?= $value->attr_value ?>
                    </option>
                <?php } ?>
            </select>
        </div>
       
    <?php $sl_count++;
    }
} ?>
<input type="hidden" name="product_attr_count[]" value="<?=$sl_count?>">