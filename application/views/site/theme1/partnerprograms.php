<script>
    $(document).ready(function () {
        $('#partnerprograms').addClass('active');
    });
</script>
<div class="page-background">
    <div class="text-center container">
        <h2 class="header-title-inner-page">Partner Programs</h2>
    </div>
</div>

<div class="v-page-wrap">
    <div class="container pull-bottom-big pull-top">
      <div class="container">
          <div class="w3ls-heading">
              <h2 class="text-center" style="margin-bottom:20px;">CHOOSE US BUT WHY?</h2>
              <h3></h3>

              <div class="page-header">
                <h1>For SMEs :<small></small></h1>
              </div>


          <p class="text-justify">
                  SupplyOrigin is committed to sourcing of quality material from established manufacturers at the most
                  effective prices in the Eastern part of India. Be our partner and get access to our range of products
                  through a complete digitalized platform with automated workflow for the ease of dealing and providing
                  never before services to SMEs. <br>
                  We assure you trust and quality and you can decide on the services you receive from us.
                  Let us know what you think –
              </p>
          </div>
          <br/>
          <div class="row">
          <div class="col-md-6 pull-right">
              <form action="<?=base_url('partnerprograms1/smesave')?>" method="post">
                  <div class="card-body">
                      <div class="row">
                          <div class=" col-md-12 form-group">
                              <label>Name <span class="text-danger">*</span></label>
                              <input type="text" name="sme_name" value="" class="form-control" autocomplete="off" />
                              <?=form_error("sme_name")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-6 form-group">
                              <label>Mobile No. <span class="text-danger">*</span></label>
                              <input type="text" name="sme_mobile" value="" class="form-control" autocomplete="off" maxlength="10" />
                              <?=form_error("sme_mobile")?>
                          </div>
                          <div class="col-md-6 form-group" style="display:block">
                              <label>Email</label>
                              <input name="sme_email" value="" class="form-control" type="email" autocomplete="off" />
                              <?=form_error("sme_email")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-6 form-group">
                              <label>State<span class="text-danger">*</span></label>
                              <select name="sme_state" class="form-control">
                                  <option value="">Select</option>
                                  <?php $states = $this->suppliers_model->get_all_states();
                                  foreach ($states as $state_detail) { ?>
                                      <option value="<?=$state_detail->state_name?>"><?=$state_detail->state_name?></option>
                                  <?php } ?>
                              </select>
                              <?=form_error("sme_state")?>
                          </div>
                          <div class="col-md-6 form-group" style="display:block">
                              <label>District</label>
                              <input name="sme_district" value="" class="form-control" type="text" />
                              <?=form_error("sme_district")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-12 form-group">
                              <label>Message <span class="text-danger">*</span></label>
                              <textarea name="sme_msg" class="form-control"></textarea>
                              <?=form_error("sme_msg")?>
                          </div>
                      </div><!-- End of .row -->
                  </div><!--End of .card-body-->
                  <div class="card-footer text-center">
                      <button type="reset" class="btn btn-danger">
                          <i class="fa fa-remove"></i> Reset
                      </button>
                      <button class="btn btn-success" type="submit">
                          <i class="fa fa-check"></i> Send
                      </button>
                  </div><!--End of .card-footer-->
              </form>
          </div><!--End of .card-->
          </div><!--End of .card-->
  <div class="clearfix"></div>
  <br/>
    <div class="w3ls-heading">
  <div class="page-header">
    <h1>For Companies : <small></small></h1>
  </div>


          <p class="text-justify">
              Companies who want to focus on manufacturing and quality of products looking for trusted partners to sell
              and build their brand, get associated with SupplyOrigin and get access to our network of loyal channel
              partners who believe in us and the products we source. <br>
              We are open to diversifying our range of products. Send us your details and we’ll get back to you.
          </p>

</div>
          <div>
          <div class="row">
          <div class="col-md-6">
              <form action="<?=base_url('partnerprograms1/companysave')?>" method="post">
                  <div class="card-body">
                      <div class="row">
                          <div class=" col-md-12 form-group">
                              <label>Company Name <span class="text-danger">*</span></label>
                              <input type="text" name="company_name" value="" class="form-control" autocomplete="off" />
                              <?=form_error("company_name")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-6 form-group">
                              <label>Contact Person <span class="text-danger">*</span></label>
                              <input type="text" name="contact_person" value="" class="form-control" />
                              <?=form_error("contact_person")?>
                          </div>
                          <div class="col-md-6 form-group" style="display:block">
                              <label>Designation</label>
                              <input name="designation" value="" class="form-control" type="text" autocomplete="off" />
                              <?=form_error("designation")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-6 form-group">
                              <label>Contact No. <span class="text-danger">*</span></label>
                              <input type="text" name="conatct_no" value="" class="form-control" autocomplete="off" maxlength="10" />
                              <?=form_error("conatct_no")?>
                          </div>
                          <div class="col-md-6 form-group" style="display:block">
                              <label>Email</label>
                              <input name="contact_email" value="" class="form-control" type="email" autocomplete="off" />
                              <?=form_error("contact_email")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-12 form-group">
                              <label>Products Manufactured<span class="text-danger">*</span></label>
                              <textarea name="product_manufactured" class="form-control"></textarea>
                              <?=form_error("product_manufactured")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class="col-md-12 form-group" style="display:block">
                              <label>Registered Office Address</label>
                              <textarea name="office_address" class="form-control"></textarea>
                              <?=form_error("office_address")?>
                          </div>
                      </div><!-- End of .row -->

                      <div class="row">
                          <div class=" col-md-12 form-group">
                              <label>Factory/Plant Address <span class="text-danger">*</span></label>
                              <textarea name="factory_address" class="form-control"></textarea>
                              <?=form_error("factory_address")?>
                          </div>
                      </div><!-- End of .row -->
                  </div><!--End of .card-body-->
                  <div class="card-footer text-center">
                      <button type="reset" class="btn btn-danger">
                          <i class="fa fa-remove"></i> Reset
                      </button>
                      <button class="btn btn-success" type="submit">
                          <i class="fa fa-check"></i> Submit
                      </button>
                  </div><!--End of .card-footer-->
              </form>
          </div><!--End of .card-->
          </div><!--End of .card-->
          <br/>
          <br/>
          <br/>
      </div>
  </div>
    </div>
</div>
