<?php $date=date_create($blog_details->created_at);
 ?>
 <script>
 $(document).ready(function(){
 $('#blogs').addClass('active');
 });
 </script>
 <div class="page-background">
 <div class="text-center container">
 <h2 class="header-title-inner-page">Blogs</h2>
 </div>
 </div>
 <br/>
<div style="margin-top:50px;">
<div class="container">
  <div class="row">
    <div class="col-md-8" style="text-align: justify;">
      <div class="feat_image">
        <img src="<?=base_url($blog_details->image);?>" alt="" class="img-fluid">
      </div>
      <h5 class="blog_title text-left pt-20"><?=$blog_details->blog_title?></h5>
      <p class="post_date">  <?php echo date_format($date,"M d,Y H:i"); ?></p>
      <div class="blog_text_post"><?=$blog_details->blog?></div>
      <div class="socials">
        <?php $share_url=urlencode(base_url()."blogs/".url_title(trim($blog_details->blog_title), '-', TRUE)."/".$blog_details->blogs_id); ?>
        <div class="wt-blog__post__cta__content">
            <h3>Don't forget to share this post!</h3>
            <a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank" class="social-icon si-borderless si-facebook si-small mb-0" title="Facebook">
                <i class="si-icon-facebook"></i>
                <i class="si-icon-facebook"></i>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>" target="_blank" class="social-icon si-borderless si-twitter si-small mb-0" title="Twitter">
                <i class="si-icon-linkedin"></i>
                <i class="si-icon-linkedin"></i>
            </a>
        <!-- <ul class="socials-connected">

          <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank"><i class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;&nbsp;</li>
          <li><a  href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>

        </ul> -->
      </div>
    </div>
    </div>
    <div class="col-md-4">
      <div class="search-container">
        <form action="<?=base_url();?>search1" method="post">
          <!-- <input type="text" placeholder="Search.." name="search">
          <button type="submit"><i class="fa fa-search"></i></button> -->
          <div class="row">
            <div class="col-sm-11">
              <div class="form-group">
                <input class="form-control " style="position:relative;"  type="text" required placeholder="Search.." name="search">
                <button style="position:absolute; right: 0px;top: 0px; display:none"  class="fa fa-search btn-default" type="submit"></button>
              </div>
            </div>
            <div class="col-sm-1">
            </div>
          </div>

        </form>
      </div>
      <div class="section-title">
				<h2>Recent Posts</h2>
			</div>
      <?php foreach ($recent_blogs as $key => $recent): ?>
        <div class="post post-thumb">
                  <a class="post-img" href="<?=base_url()?>blogs/<?=url_title(trim($recent->blog_title), '-', TRUE)?>/<?=$recent->blogs_id;?>">
                    <?php if($recent->image){ ?>
                      <img src="<?=base_url($recent->image)?>" alt="">
                    <?php }else { ?>
                      <img src="<?=base_url("assets/images/not-found.png")?>"  alt="">
                    <?php } ?>

                  </a>
                  <div class="post-body">
                    <h3 class="post-title"><a href="<?=base_url()?>blogs/<?=url_title(trim($recent->blog_title), '-', TRUE)?>/<?=$recent->blogs_id;?>"><?=$recent->blog_title;?></a></h3>
                    <div class="post-meta">
                      <span class="post-date"><?php $blogdate=date_create($recent->created_at); echo "Posted on ".date_format($blogdate,"M d,Y H:i");?></span>
                    </div>
                  </div>
        </div>
      <?php endforeach; ?>
      <div class="tags-widget">
				<ul>
          <?php if($tags){
            foreach ($tags as $key => $value) {?>
              	<li><a href="<?=base_url()?>blogs/<?=$value?>"><?=$value?></a></li>
            <?php }
          }?>
				</ul>
		 </div>
    </div>
  </div>
</div>
</div>
