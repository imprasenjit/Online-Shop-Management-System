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
<?php $this->load->helper('text');?>
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-6">
    <?php if($search_term){ ?>
      <div class="blog_result"> Result showing of <b><?=$search_term?></b></div>
    <?php }?>
    <?php if($blogs){ foreach ($blogs as $key => $blog): ?>
      <div class="entry-content">
        <div class="feat_image img-fluid">
            <?php if($blog->image){ ?>
              <img width="623" height="300" src="<?=base_url($blog->image);?>" class="img-fluid wp-post-image" sizes="(max-width: 623px) 100vw, 623px">
            <?php }else { ?>
              <img src="<?=base_url("assets/images/not-found.png")?>"  alt="">
            <?php } ?>
        </div>
        <h5 class="feat_title text-left pt-20">
          <a href="<?=base_url()?>blogs/<?=url_title(trim($blog->blog_title), '-', TRUE)?>/<?=$blog->blogs_id;?>" class="RM">
            <?=$blog->blog_title;?>
          </a>
        </h5>
        <div class="feat_desc text-left">
          <p ><?=word_limiter($blog->short_description,100)?></p>
        </div>
        <h5 class="feat_rm text-left pb-20"><a href="<?=base_url()?>blogs/<?=url_title(trim($blog->blog_title), '-', TRUE)?>/<?=$blog->blogs_id;?>" class="RM">READ MORE &gt;&gt;</a></h5>
        <hr class="blog_hr pt-10  pb-10">
      </div>


    <?php endforeach; }else { ?>
      <div class="well">
          <div class="media">
            <p style="text-align:center">No Blogs Found</p>
          </div>
        </div>
  <?php   }?>
  </div>
  <div class="col-sm-1">
  </div>
  <div class="col-sm-4">
    <div class="search-container">
      <form action="<?=base_url();?>search1" method="post">
        <div class="row">
          <div class="col-sm-11">
            <div class="form-group has-feedback">
              <input class="form-control " style="position:relative;"  type="text" required placeholder="Search.." name="search">
              <button style="position:absolute; right: 0px;top: 0px;display:none"  class="fa fa-search form-control-feedback" type="submit"></button>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
      </form>
    </div>
    <br/><br/>
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
