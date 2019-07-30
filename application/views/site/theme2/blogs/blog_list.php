<link href="<?= base_url(); ?>assets/theme2/css/blogs.css" rel="stylesheet">
<script>
  $(document).ready(function() {
    $('#blogs').addClass('active');
  });
</script>
<div class="agile-banner" >
  <div class="text-center container" style="color:white; padding:200px 200px;">
    <h1 class="header-title-inner-page">Blogs</h1>
  </div>
</div>
<section>
  <div class="index-content">
    <div class="container">
      <?php $this->load->helper('text'); ?>
      <?php if ($blogs) {
        foreach ($blogs as $key => $blog) : ?>
          <a href="<?= base_url() ?>blogs/<?= url_title(trim($blog->blog_title), '-', TRUE) ?>/<?= $blog->blogs_id; ?>">
            <div class="col-lg-4">
              <div class="card">
                <?php if ($blog->image) { ?>
                  <img src="<?= base_url($blog->image); ?>">
                <?php } else { ?>
                  <img src="<?= base_url("assets/images/not-found.png") ?>" alt="">
                <?php } ?>
                <h4><?=$blog->blog_title;?></h4>
                <p><?= word_limiter($blog->short_description, 100) ?></p>
                <a href="<?= base_url() ?>blogs/<?= url_title(trim($blog->blog_title), '-', TRUE) ?>/<?= $blog->blogs_id; ?>" class="blue-button">Read More</a>
              </div>
            </div>
          </a>

        <?php endforeach;
      } else { ?>
        <div class="well">
          <div class="media">
            <p style="text-align:center">No Blogs Found</p>
          </div>
        </div>
      <?php   } ?>
    </div>
  </div>
</section>
