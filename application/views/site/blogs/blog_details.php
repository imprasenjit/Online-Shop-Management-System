<?php $date=date_create($blog_details->created_at);
 ?>
<div class="blog-page-background">
<div class=" container">
<h2 class="header-title-inner-page"><?=$blog_details->blog_title;?></h2>
<div class="blog-date">Posted on <?php echo date_format($date,"M d,Y H:i"); ?></div>
</div>
</div>
<div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <?=$blog_details->blog?>
      <div class="socials">
        <div class="wt-blog__post__cta__content">
            <h3>Don't forget to share this post!</h3>
        <ul class="socials-connected">
          <?php $share_url=urlencode(base_url()."blogs/".url_title(trim($blog_details->blog_title), '-', TRUE)."/".$blog_details->blogs_id); ?>
          <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank"><i class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;&nbsp;</li>
          <li><a  href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
        </ul>
      </div>
    </div>
    </div>
    <div class="col-md-4">
      <div class="section-title">
				<h2>Recent Posts</h2>
			</div>
      <?php foreach ($recent_blogs as $key => $recent): ?>
        <div class="post post-thumb">
                  <a class="post-img" href="<?=base_url()?>blogs/<?=url_title(trim($recent->blog_title), '-', TRUE)?>/<?=$recent->blogs_id;?>"><img src="<?=base_url($recent->image)?>" alt=""></a>
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
              	<li><a href="#"><?=$value?></a></li>
            <?php }
          }?>
				</ul>
		 </div>
    </div>
  </div>
</div>
</div>
