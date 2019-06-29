<style>
.panel-group .panel {
    margin-bottom: 10px;
}
</style>
<div class="row profile scrollingContainer">
  <div class="col-md-2">
    <?php $this->load->view("site/theme1/customers/dashboard/profile"); ?>
  </div>
  <div class="col-md-10">

    <div class="panel-group">
      <div class="panel panel-default">
      <div class="panel-heading">
          Address
      </div>
        <div class="panel-body">
          <?php if ($this->session->flashdata("message")) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Success!</strong> <?= $this->session->flashdata("message") ?>
            </div>
          <?php } ?>
          <div class="row">
          <?php if($customer_address){
                  foreach ($customer_address as $key => $address) { ?>
                    <div class="col-sm-4">
                      <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-10">
                            <h5><?php if($address->address_type == "billing_address") echo "Billing Address"; else echo "Delivery Address";?></h5>
                          </div>
                          <div class="col-sm-2">
                            <a onclick="edit_address(this);" data-address_type="<?=$address->address_type;?>" data-address="<?=$address->address;?>"  data-address_id="<?=$address->address_id;?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          </div>
                        </div>
                        <hr/>
                        <div class="row">
                        <div class="col-sm-12">
                          <?=$address->address;?>
                        </div>
                      </div>
                        <!-- <div class="pull-right"> </div> -->

                      </div>
                      </div>
                    </div>

                  <?php }
           }else {
              echo "No Address Saved";
           } ?>
         </div>
           <hr/>
           <h5 align="center" style="padding:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Address</h5>

              <div class="row">
                <form action="<?=base_url()?>customers/customer/manage_address_action" method="post">
                  <div class=" col-md-12 form-group">
                      <label>Address Type<span class="text-danger">*</span></label>
                      <select class="form-control form-control-sm" name="address_type" id="address_type" required>
                        <option value="">Select</option>
                        <option value="delivery_address"> Delivery Address</option>
                        <option value="billing_address">Billing Address</option>
                      </select>
                      <?php echo form_error('address_type') ?>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Address<span class="text-danger">*</span></label>
                      <textarea type="text" class="form-control form-control-sm" name="customer_address" id="customer_address" required></textarea>
                      <?php echo form_error('customer_address') ?>
                  </div>
                  <input type="hidden" id="customer_address_id" name="customer_address_id"/>
                  <div class="col-md-12 form-group" style="margin-top:30px">
                    <button type="submit" class="btn btn-primary " id="btnSaveAddress" name="submit" value="save">Save</button>
                    <button type="submit" style="display:none;" class="btn btn-primary" name="submit" value="update" id="btnUpdateAddress">Update</button>
                    <button type="button" style="display:none;" class="btn btn-Danger " id="btnCancel">Cancel</button>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<script>
  function edit_address(obj){
  var address_type=$(obj).data('address_type');
  var address=$(obj).data('address');
  var address_id=$(obj).data('address_id');
  $("#address_type").val(address_type);
  $("#customer_address").val(address);
  $("#customer_address_id").val(address_id);
  $("#btnSaveAddress").hide();
  $("#btnUpdateAddress").show();
  $("#btnCancel").show();
  window.scrollTo(0,document.querySelector(".scrollingContainer").scrollHeight);
  // $("address_type").val(address_type);
  }
  $("#btnCancel").click(function(){
    $("#address_type").val('');
    $("#customer_address").val('');
    $("#btnSaveAddress").show();
    $("#btnUpdateAddress").hide();
    $("#btnCancel").hide();
  });

</script>
