
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                      <form action="<?php echo $action; ?>" method="post">
                          <div class="row">
                              <div class="col-md-12 form-group">
                                  <label>Title<span class="text-danger">*</span></label>
                                  <textarea type="text" id="blog_title" class="form-control form-control-sm" name="blog_title" ><?php echo $blog_title; ?></textarea>
                              </div>
                              <div class="col-md-12 form-group">
                                  <label>Blog<span class="text-danger">*</span></label>
                                  <textarea type="text" id="blog" class="form-control form-control-sm" name="blog" ><?php echo $blog; ?></textarea>
                              </div>
                          </div>

                          <input type="hidden" name="id" value="<?php echo $blogs_id; ?>" />
                          <div class="row">
                              <div class="col-md-12" ></br>
                                  <button type="submit" class="btn btn-primary btn-sm"><?php echo $button ?></button>
                                  <a href="<?php echo site_url('admin/blogs') ?>" class="btn btn-info btn-sm">Cancel</a>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <link href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>" rel="stylesheet">
              <script src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
              <script>
                  $(document).ready(function($) {
                    $('#blog_title').summernote({
                        tabsize: 2,
                        height: 50
                    });
                    $('#blog').summernote({
                        tabsize: 2,
                        height: 600
                    });
                  });
              </script>
