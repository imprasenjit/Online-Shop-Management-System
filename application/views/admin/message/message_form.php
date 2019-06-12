
<div class="container-fluid">
    <div class="mb-4">
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Compose Message</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-status-wrap">

                                <form action="<?php echo $action; ?>" method="post">
                                    <div class="form-group">
                                        <label for="varchar">To <?php echo form_error('send_to') ?></label>
                                        <input type="text" class="form-control form-control-sm" name="send_to" id="send_to" placeholder="To : " value="<?php echo $send_to; ?>" />
                                        <span id="cust_details"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="varchar">Subject <?php echo form_error('subject') ?></label>
                                        <input type="text" class="form-control form-control-sm" name="subject" id="subject" placeholder="Subject :" value="<?php echo $subject; ?>" />
                                    </div>
                                    <?php $msgFooter = "Regards, \nSupply Origin \nGuwahati Assam"; ?>
                                    <div class="form-group">
                                        <label for="varchar">Message <?php echo form_error('message') ?></label>
                                        <textarea type="text" class="form-control form-control-sm" rows="10" name="message" id="message" placeholder="Enter Your Message Here : "><?php echo $message; ?><?php echo $msgFooter; ?></textarea>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    
                                    <div class=" col-md-6 form-group">
                                        <label for="varchar">Attachment(If any)</label>
                                        <input type="file" name="download_file" id="downloads_image" />
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    <a href="<?php echo site_url('admin/message') ?>" class="btn btn-default">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?=base_url('public/jqueryui/jquery-ui.min.css')?>" rel="stylesheet" type="text/css" />
<script src="<?=base_url('public/jqueryui/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#downloads_image").pekeUpload({
          bootstrap: true,
          url: "<?= base_url(); ?>upload/",
          data: {file: "download_file"},
          limit: 1,
          allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
        });
        
        $("#send_to").autocomplete({
            source:"<?=base_url('admin/message/get_custnames')?>", 
            minLength:1,
            select: function(event,ui){ 
                $("#cust_details").html(ui.item.label);
            },
        }); //End of autocomplete #cust_search_box
    });
</script>
