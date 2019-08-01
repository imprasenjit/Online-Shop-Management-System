<?php $date=date_create($blog_details->created_at);
 ?>
 <script>
 $(document).ready(function(){
 $('#blogs').addClass('active');
 });
 </script>
 <section style="padding:20px 0px;">
        <div class="index-content text-center">
            <div class="container">
                <div>
                    <h1><b><?=$blog_details->blog_title?></b></h1>
                </div><br><br>
                <div><img src="<?=base_url($blog_details->image);?>" alt="" height=80% width=80%></div><br><br>
                <div>
      <p class="post_date">  <?php echo date_format($date,"M d,Y H:i"); ?></p>
      <p align="justify"><?=$blog_details->blog?></p>
      <div class="socials">
        <?php $share_url=urlencode(base_url()."blogs/".url_title(trim($blog_details->blog_title), '-', TRUE)."/".$blog_details->blogs_id); ?>
        <div class="wt-blog__post__cta__content">
            <h3>Don't forget to share this post!</h3>
            <a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank" class="social-icon si-borderless si-facebook si-small mb-0" title="Facebook">
                <i class="fa fa-facebook-square"></i>
                <!-- <i class="fab fa-facebook-square"></i> -->
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>" target="_blank" class="social-icon si-borderless si-twitter si-small mb-0" title="Twitter">
                <i class="fa fa-linkedin-square"></i>
            </a>
        <!-- <ul class="socials-connected">

          <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank"><i class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;&nbsp;</li>
          <li><a  href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>

        </ul> -->
      </div>
    </div>
    </div>
    </div>
    </div>
 </section>
    
