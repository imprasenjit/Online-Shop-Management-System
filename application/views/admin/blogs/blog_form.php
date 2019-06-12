
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
                                  <label>Short Description<span class="text-danger">*</span></label>
                                  <textarea type="text" id="short_description" class="form-control form-control-sm" name="short_description" ><?php echo $blog_title; ?></textarea>
                              </div>
                              <div class="col-md-12 form-group">
                                  <label>Blog<span class="text-danger">*</span></label>
                                  <textarea type="text" id="blog" class="form-control form-control-sm" name="blog" ><?php echo $blog; ?></textarea>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="usr">Tags:</label>
                                  <input type="text" class="" id="" name="tags" value="<?php echo $tags;?>">
                                  <?php echo form_error('tags');?>
                                </div>
                            </div>
                          </div>
                          <div class=" col-md-12">
                              <br />
                              <label> Image <?php echo form_error('image') ?></label>
                              <?php if ($image) { ?>
                                  <input type="file" name="image" id="image" data-error="Please upload blog image." value="" />
                                  <img src="<?php echo base_url($image); ?>" class="img-responsive" style="width:120px;height:100px;">
                              <?php } else { ?>
                                  <input type="file" name="image" id="image" data-error="Please upload product image." />
                              <?php } ?>
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
              <script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js"></script>
              <link href="<?= base_url("assets/admin/summernote/summernote-bs4.css"); ?>" rel="stylesheet">
              <script src="<?= base_url("assets/admin/summernote/summernote-bs4.js"); ?>"></script>
              <script src="<?php echo base_url()?>assets/js/tagify.js"></script>
              <link href="<?php echo base_url()?>assets/css/tagify.css" rel="stylesheet" />
              <script>
                  $(document).ready(function($) {

                    $('#blog').summernote({
                        tabsize: 2,
                        height: 600
                    });
                    $("#image").pekeUpload({
                        bootstrap: true,
                        url: "<?= base_url(); ?>upload/",
                        data: {
                            file: "image"
                        },
                        limit: 1,
                        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
                    });
                  });
              </script>
              <script>
              var input = document.querySelector('input[name=tags]'),
                 // init Tagify script on the above inputs
                 tagify = new Tagify(input, {
                     whitelist : [],
                     blacklist : [], // <-- passed as an attribute in this demo
                 });

              // "remove all tags" button event listener
              document.querySelector('.tags--removeAllBtn')
                 // .addEventListener('click', tagify.removeAllTags.bind(tagify))

              // Chainable event listeners
              tagify.on('add', onAddTag)
                   .on('remove', onRemoveTag)
                   .on('input', onInput)
                   .on('edit', onTagEdit)
                   .on('invalid', onInvalidTag)
                   .on('click', onTagClick);

                   // tag added callback
                   function onAddTag(e){
                       // console.log("onAddTag: ", e.detail);
                       // console.log("original input value: ", input.value)
                       tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
                   }

                   // tag remvoed callback
                   function onRemoveTag(e){
                       // console.log(e.detail);
                       // console.log("tagify instance value:", tagify.value)
                   }

                   // on character(s) added/removed (user is typing/deleting)
                   function onInput(e){
                       // console.log(e.detail);
                       // console.log("onInput: ", e.detail);
                   }

                   function onTagEdit(e){
                       // console.log("onTagEdit: ", e.detail);
                   }

                   // invalid tag added callback
                   function onInvalidTag(e){
                       // console.log("onInvalidTag: ", e.detail);
                   }

                   // invalid tag added callback
                   function onTagClick(e){
                       // console.log(e.detail);
                       // console.log("onTagClick: ", e.detail);
                   }

              </script>
