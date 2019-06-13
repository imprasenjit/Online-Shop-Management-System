<br/>
<div>
<div class="container">
<?php $this->load->helper('text');?>
  <?php if($search_term){ ?>
    <div> Result showing of <b><?=$search_term?></b></div>
  <?php }?>
  <?php if($blogs){ foreach ($blogs as $key => $blog): ?>
    <div class="well">
        <div class="media">
        	<a class="pull-left" href="<?=base_url()?>blogs/<?=url_title(trim($blog->blog_title), '-', TRUE)?>/<?=$blog->blogs_id;?>">
            <?php if($blog->image){ ?>
              <img class="media-object" src="<?=base_url($blog->image);?> " width="200" height="200">
            <?php }else { ?>
              <img src="<?=base_url("assets/images/not-found.png")?>"  alt="">
            <?php } ?>

    		</a>
    		<div class="media-body">
      		<h4 class="media-heading"><?=$blog->blog_title;?></h4>
            <!-- <p class="text-right">By Francisco</p> -->
            <p><?=word_limiter($blog->short_description,100)?></p>
            <ul class="list-inline list-unstyled">
    			<li><span><i class="glyphicon glyphicon-calendar"></i><?php $date=date_create($blog->created_at);
echo date_format($date,"M d,Y H:i"); ?></span></li>
              <!-- <li>|</li> -->
              <!-- <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span> -->


  			</ul>
         </div>
      </div>
    </div>
  <?php endforeach; }else { ?>
    <div class="well">
        <div class="media">
          <p style="text-align:center">No Blogs Found</p>
        </div>
      </div>
<?php   }?>
</div>
</div>
