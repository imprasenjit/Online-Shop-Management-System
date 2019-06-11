<br/>
<div>
<div class="container">
<?php  $this->load->helper('text');?>
    <div class="well">
      <h4 class="media-heading"><?=$blog_details->blog_title;?></h4>
        <div class="media">
      		<img class="media-object" src="<?=base_url($blog_details->image);?> " >
    		<div class="media-body">
            <p><?=$blog_details->blog?></p>
            <!-- <ul class="list-inline list-unstyled">
    			<li><span><i class="glyphicon glyphicon-calendar"></i><?php $date=date_create($blog_details->created_at);
echo date_format($date,"M d,Y H:i"); ?></span></li>

  			</ul> -->
         </div>
      </div>
    </div>
</div>
</div>
