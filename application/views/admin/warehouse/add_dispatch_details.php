<div class="container-fluid">
  <div class="mb-4">
    <?=$this->breadcrumbs->show();?>
  </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Dispatch Information</h6>
                </div>
                <!-- Card Body -->
                <form class="form" action="<?= base_url("admin/warehouse/add_dispatch_details_action");?>" method="post">
				<div class="card-body">
                        <input type="hidden" name="purchase_order_to_supplier_id" value="<?=$po_id;?>">

                        <div class="form-row mb-2">
                            <label for="lorry_no" class="col-sm-2  control-label">Upload Docs <?php echo form_error('dispatch_doc') ?></label>
                            <div class="col-sm-10">
                                <input type="file" name="dispatch_doc" id="dispatch_doc" data-error="Please upload Invoice." />
                            </div>
                        </div>
                        <?php if($docs_info->dispatch_doc){ ?>
                        <div class="row">
                          <br/>
                          <div class="col-sm-12">
                            <label class="control-label">Dispatch docs : </label><br/>
                          </div>
                          <div class="col-sm-12">
                            <?php
                              foreach (json_decode($docs_info->dispatch_doc) as $key => $value) {?>
                                <a href="<?=base_url($value)?>" target="_blank">Document <?=$key+1;?></a>&nbsp;&nbsp;<br/>
                              <?php }?>
                            <p><i>Note: On upload of new document above document will be deleted permanently.</i></p>
                          </div>


                        </div>
                      <?php }?>
                        <script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
                        <script>
                            $(document).ready(function($) {
                                $("#dispatch_doc").pekeUpload({
                                    bootstrap: true,
                                    // btnText:"Upload Invoice",
                                    url: "<?= base_url(); ?>upload/",
                                    data: {
                                        file: "dispatch_doc"
                                    },
                                    limit: 5,
                                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
                                });
                            });
                        </script>
                        <div class="form-group mb-2">
                            <div class="col-sm-offset-2 col-sm-10">
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                        <div class="clearfix"></div>
                        <br/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
