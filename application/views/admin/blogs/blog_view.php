
    <div class="container-fluid">
        <div class="mb-4">
            <?= $this->breadcrumbs->show(); ?>
        </div>
        <div class="row">

    <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Blog details</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div>
            <?=$blog_title?>
          </div>
          <div><img src="<?=base_url($image)?>" width="300" height="300"/></div>
          <div>
            <?=$blog?>
          </div>
          <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                  <label for="tags"><b>Tags: </b></label><?php $all_tags='';$len=count($tags)-1; foreach ($tags as $key => $value) {
                    $all_tags .= $value->value;
                    if($key != $len)
                    $all_tags .= ",";
                  }
                  echo $all_tags;
                  ?>

                </div>
            </div>
          </div>

        </div>
        </div>
      </div>
    </div>
    </div>
