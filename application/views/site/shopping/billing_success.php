<?php $this->load->view('requires/header',array("page"=>"Enquery Success"));?>
<section class="pricing py-md-5 py-4">
	<div class="container" style="margin-bottom:100px;">
		<div class="row">
			<div class="col-md-12" align="center">	
				<div id='result_div'><br/><br/>
					<?php
					// this will show you thank you message.
					//echo "<span id='go_back'><a class='btn btn-info' href=" . base_url() . ">Go back</a></span>";
					echo "<h1 align='center'>Thank You! your Enquery has been placed!</h1>";
					echo "<h3 align='center'>We will contact you soon!</h3>";
				   
					?>
				</div>
			</div>
			<div class="col-md-12" align="center"><br/><br/>	
				<div class="col-md-3"></div>
				<div class="col-md-6" align="center">
					<a href="<?=base_url("view-all-sub-category");?>"><button type="submit" data-toggle="tooltip" title="go_back" class="btn btn-info btn-block"><i class="fa fa-arrow-left"></i> Go back</button></a>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
  	</div>
</section> 
<?php $this->load->view('requires/footer');?>