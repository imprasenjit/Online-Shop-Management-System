<div class="modal fade" tabindex="-1" role="dialog" id="cart_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enquiry Cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" >
                <div id="cartdetails">
                <?php                           
						if(count($this->cart->contents())==0){
							echo '&nbsp;&nbsp;&nbsp;To add products to your Enquiry cart click on "Add to Enquiry Cart" Button'; 
						}?>
                    <table class="table table-hover">
                        <?php
							// All values of cart store in "$cart". 
							if ($cart = $this->cart->contents()){ ?>
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
                        <?php $i = 1;foreach ($cart as $item){?>
                        <tr>
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <?php echo $item['name']; ?>
                            </td>
                            <td>
                                <?php echo $item['qty'];?>
                            </td>
							<td>
								<?php echo $item['product_unit']; ?>
							</td>
                            <td>
                                <?php 
											//print implode(", ", $attributes);
											$attr_names=$item["attributes"];
											foreach($item["attr_names"] as $key => $values){
												echo $attr_names[$key].' : '.$values."<br>";
											}
										?>
                            </td>
                            <td>
                                <?php echo $item['others']; ?>
                            </td>
                            <td align="center">
                                <a href="<?=base_url();?>shopping/remove/<?= $item['rowid'] ?>" class="btn btn-danger btn-circle" >
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </table>
                </div>
                </div>
                <div class="modal-footer">
                    <a href="<?=base_url("view-all-sub-category");?>" class="btn btn-primary">Add Products</a>
                    <a href="<?=base_url("shopping/billing");?>"  class='btn btn-success'>Send Enquiry</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->