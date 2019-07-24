  <?php $imgRows = $this->home_page_slider_model->get_results();
  ?>
  <script>
      $(document).ready(function() {
          $('#home').addClass('active');
      });
  </script>
  <!-- <a href="https://api.whatsapp.com/send?phone=+919707333490&text=We Have some requirement for Steel" class="float" target="_blank">
      <i class="fa fa-whatsapp my-float"></i>
  </a> -->
  <script type="text/javascript">
      $(document).ready(function() {
          $(document).on("click", ".openmodal2", function() {
              $('#cart_modal').modal('show');
          });
          $(document).on("click", ".exampleModalCenter", function() {
              $('#exampleModalCenter').modal('show');
          });
      });
      function clear_cart() {
          var result = confirm('Are you sure want to clear cart?');
          if (result) {
              window.location = "<?php echo base_url("shopping/remove/all"); ?>";
          } else {
              return false; // cancel button
          }
      }
  </script>
  <!-- <a href="<?php echo base_url("view-all-sub-category"); ?>" id="myBtn" title="Go to Quotes">Get Quotes</a> -->
<!-- <div class="slider">
        <div class="owl-carousel owl-theme" id="banner-carousel">
            <?php $imgRows = $this->home_page_slider_model->get_results();
            if ($imgRows) {
                foreach ($imgRows as $irows) {
                    echo '<div class="item"><img class="" src="' . base_url($irows->file_path) . '" /></div>';
                }
            }
            ?>
        </div>
        <div class="owl-theme">
            <div class="owl-controls">
                <div class="custom-nav owl-nav"></div>
            </div>
        </div>
    </div> -->
    <!-- top-header and slider -->
  	<div class="w3-slider">
  	<!-- main-slider -->
  		<ul id="demo1">
        <?php
        if ($imgRows) {
            foreach ($imgRows as $irows) { ?>
                <li>
                  <img src="<?=base_url($irows->file_path);?>" alt="" />
                  <!--Slider Description example-->
                  <!-- <div class="slide-desc">
                    <h3>THE POWER OF SUN AT YOUR HOUSE</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's dummy. </p>
                  </div> -->
                </li>
            <?php }
        }
        ?>
  		</ul>
  	</div>
  	<!-- //main-slider -->
  	<!-- //top-header and slider -->
  	<!---728x90--->
  	<!-- Specialize-section -->
  			<section class="w3-about text-center">
  				<div class="container">
  					<hr style="margin-top:-20px;">
  					<h2 class="w3ls_head"><span>Your trusted Sourcing Partners</span></h2>
  					<hr><br><br>
  					<div class="w3l-about-grids">
  							<div class="col-md-6 w3ls-about-left">
  								<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/199001319?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
  							</div>
  							<div class="col-md-6 w3ls-about-right">
  								<p align="justify" style="font-size:16.5px;margin-top:30px;">
  									We understand the challenges behind sourcing high-quality building materials from endless manufacturers in the market. Besides, when the goal is to deliver impeccable infrastructural properties, nobody wants their building foundation to be compromised, do they? <br><br>
  									This is precisely why, for the first time in Eastern India, we have introduced a ‘much-needed’ digital platform for purchasing the best quality raw and finished materials in a hassle-free transactional setup. We carry out regular third-party lab testing under NABL accreditation; so that, quality delivered to you is of the highest grade, every time.
  								</p><br><br>
  							</div>
  							<div class="clearfix"> </div>
  						</div>
  				</div>
  			</section>
  			<section style="padding:50px; background: #252525">
  				<div class="container">
  					<div class="row text-center" style="color:white">
  							<div class="col-md-2">
  									<div>
  										<img src="<?=base_url();?>assets/theme2/images/tests.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>Test reports available</h4>
  									</div>
  							</div>
  							<div class="col-md-2">
  								<div class="agileits-icon-grid">
  									<div class=>
  										<!-- <i class="fa fa-cubes" aria-hidden="true"></i> -->
  										<img src="<?=base_url();?>assets/theme2/images/trustedbrands.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>Trusted brands</h4>
  									</div>
  								</div>
  							</div>
  							<div class="col-md-2">
  								<div class="agileits-icon-grid">
  									<div>
  										<!-- <i class="fa fa-inr" aria-hidden="true"></i> -->
  										<img src="<?=base_url();?>assets/theme2/images/bestprice.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>Best industry pricing</h4>
  									</div>
  								</div>
  							</div>
  							<div class="col-md-2">
  								<div class="agileits-icon-grid">
  									<div>
  										<!-- <i class="fa fa-users" aria-hidden="true"></i> -->
  										<img src="<?=base_url();?>assets/theme2/images/onlinetransac.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>Hassle-free online transactions</h4>
  									</div>
  								</div>
  							</div>
  							<div class="col-md-2">
  								<div class="agileits-icon-grid">
  									<div>
  										<!-- <i class="fa fa-car" aria-hidden="true"></i> -->
  										<img src="<?=base_url();?>assets/theme2/images/insuredlogistic.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>Insured Logistic support</h4>
  									</div>
  								</div>
  							</div>
  							<div class="col-md-2">
  								<div class="agileits-icon-grid">
  									<div>
  										<!-- <i class="fa fa-car" aria-hidden="true"></i> -->
  										<img src="<?=base_url();?>assets/theme2/images/aftersales.png" width="150" height="150">
  									</div>
  									<div class="icon-right">
  										<h4>After-sales support</h4>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  			</section>
  			<section style="padding:50px;">
          <?php $products = $this->sub_category_model->get_all();?>
       <?php if($products){ ?>
  				<div class="container">
  							<h3 class="w3ls_head" style="padding-top:20px;"><span>Our Products</span></h3>
  							<br>
  							<div class="owl-carousel owl-theme" id="products-carousel">
                  <?php
                    foreach ($products as $product) { ?>
  										<div class="item">
  										      <a href="<?= base_url("view-all-products-by-category/$product->id"); ?>"> <img class="" src="<?= base_url($product->picture); ?>"></a>
  										      <h4 class="text-center" style="padding-top:25px;"><?= $product->sub_category ?></h4>
  									 </div>
                    <?php
                     }
                   ?>
  									</div>
  							<div class="owl-theme">
  								<div class="owl-controls">
  									<div class="custom-nav owl-nav"></div>
  								</div>
  							</div>
  						</div>
                  <?php }?>
  						<br /><br /><br /><br />
  						<script>
  							$(document).ready(function() {
  								$('#products-carousel').owlCarousel({
  									autoplay: true,
  									margin: 20,
  									autoplayTimeout: 4000,
  									autoplayHoverPause: true,
  									smartSpeed: 500,
  									loop: true,
  									navText: [
  										'<i class="fa fa-angle-left" aria-hidden="true"></i>',
  										'<i class="fa fa-angle-right" aria-hidden="true"></i>'
  									],
  									responsiveClass: true,
  									dots: true,
  									nav: true,
  									responsive: {
  										0: {
  											items: 1
  										},
  										480: {
  											items: 1
  										},
  										768: {
  											items: 1
  										},
  										992: {
  											items: 6
  										}
  									}
  								});
  							});
  						</script>
  			</section>
			  <section style="background-color:#E5E7E9;">    
					<div classs="container" style="padding:30px;">
							<div class="row">
								<div class="col-sm-12">
									<h2 class="w3ls_head" style="padding-top:50px;"><span>Customer Testimonials</span></h2>			
									<div id="myCarousel" class="carousel slide" data-ride="carousel">
										<div><p><br><br></p></div>
										<!-- Carousel indicators -->
										<ol class="carousel-indicators">
											<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
											<li data-target="#myCarousel" data-slide-to="1"></li>
											<li data-target="#myCarousel" data-slide-to="2"></li>
										</ol>
										<!-- Wrapper for carousel items -->
										<div class="carousel-inner">
                        <?php
                        $testimonials = $this->feedback_model->get_all_active_feedbacks();//echo "<pre>";var_dump($testimonials);die;
						$i = 0;
						//echo '<pre>';
						//print_r($testimonials);
                        if (count($testimonials)>0) {
                            while ($i < count($testimonials)) {
                                ?>
  									<div class="item carousel-item <?=($i==1)?"active":"";?>">
												<div class="row">
													<br>
													<div class="col-sm-6">
														<div class="testimonial">
															<p><?=$testimonials[$i]->message?></p>
														</div>
														<div class="media">
															<div class="media-left d-flex mr-3">
																<img src="images/client.jpg" alt="">										
															</div>
															<div class="media-body">
																<div class="overview">
																	<div class="name"><b><?=$testimonials[$i]->name?></b></div>
																	<div class="details"><?=$testimonials[$i]->address?></div>
																	<div class="star-rating">
																		<ul class="list-inline">
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
																		</ul>
																	</div>
																	<br>
																</div>										
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="testimonial">
															<p><?=$testimonials[$i+1]->message?></p>
														</div>
														<div class="media">
															<div class="media-left d-flex mr-3">
																<img src="images/client.jpg" alt="">
															</div>
															<div class="media-body">
																<div class="overview">
																	<div class="name"><b><?=$testimonials[$i+1]->name?></b></div>
																	<div class="details"><?=$testimonials[$i+1]->address?></div>
																	<div class="star-rating">
																		<ul class="list-inline">
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star"></i></li>
																			<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
																		</ul>
																	</div>
																</div>										
															</div>
														</div>
													</div>
												</div>			
											</div>
                              <?php
                              $i+=2;
                          }
                      }
                      ?>
  										</div>
  										<!-- Carousel controls -->
  										<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
  											<i class="fa fa-chevron-left"></i>
  										</a>
  										<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
  											<i class="fa fa-chevron-right"></i>
  										</a>
  									</div>
  								</div>
  							</div>
  						</div>
  			</section>
  			<section style="padding:50px;">
  					<div class="two-grids">
  							<div class="container">
  								<h2 class="w3ls_head"><span>Our Associated Brands</span></h2>
  								<div class="col-md-12 col-centered" style="padding:40px; ">
  									<div class="owl-carousel owl-theme" id="brands-carousel">
                      <?php
                      $results = $this->associated_brands_model->get_all();
                      $i = 1;
                      if ($results) {
                          foreach ($results as $r) {
                              //$id = $r->id;
                              $name = $r->name;
                              $picture = $r->picture;
                              ?>
  																<div class="client-brand"><img class="client-image" src="<?php echo base_url($picture); ?>"></div>
  																		<!-- <div class=" client-brand"><img class="client-image" src="<?=base_url();?>assets/theme2/images/savsol.png"></div>
  																		<div class=" client-brand"><img class="client-image" src="<?=base_url();?>assets/theme2/images/bstl.png"></div>
  																		<div class=" client-brand"><img class="client-image" src="<?=base_url();?>assets/theme2/images/sail.png"></div>
  																		<div class="client-brand"><img class="client-image" src="<?=base_url();?>assets/theme2/images/savita.png"></div> -->
                                      <?php
                                      $i++;
                                  }
                              }
                              ?>
  								</div>
  								</div>
  							</div>
  						</div>
  						<script>
  							$(document).ready(function() {
  								  $('#testimonials-carousel').owlCarousel({
  									autoplay: true,
  									margin: 10,
  									autoplayTimeout: 5000,
  									autoplayHoverPause: true,
  									smartSpeed: 500,
  									loop: true,
  									responsive: {
  										0: {
  											items: 1
  										},
  										600: {
  											items: 2
  										},
  										1000: {
  											items: 1
  										}
  									}
  								});
  								var owl = $('#brands-carousel');
  								owl.owlCarousel({
  									autoplay: true,
  									margin: 10,
  									autoplayTimeout: 2000,
  									autoplayHoverPause: false,
  									smartSpeed: 500,
  									loop: true,
  									responsive: {
  										0: {
  											items: 1
  										},
  										600: {
  											items: 3
  										},
  										1000: {
  											items: 5
  										}
  									}
  								});
  							});
  						</script>
  			</section>
  			<!-- <div class="w3layouts-clients">
  				<div class="container">
  					<h3>Gain energy <span>independence</span></h3>
  					<p>There Are Many Variations Of Passages Of Lorem Ipsum Available, But The Majority Have Suffered In Some, By Injected Humour.Contrary To Popular Belief, Lorem Ipsum Is Not Simply Random Text. It Has Roots In A Piece Of Latin Literature From 45 BC, Making.</p>
  				</div>
  			</div> -->
  	<!--//clients-->
  		<!--advantage-->
  		<!---728x90--->
  <!--
  				<div class="what-w3ls">
  					<div class="container">
  						<h3 class="w3ls_head">What <span>We Do</span></h3>
  						<div class="what-grids">
  							<div class="col-md-6 what-grid">
  							<div class="list-img">
  								<img src="images/5.jpg" class="img-responsive" alt=""/>
  								<div class="textbox"></div>
  								</div> -->
  							<!-- </div>
  							<div class="col-md-6 what-grid1">
  								<div class="what-top">
  									<div class="what-left">
  										<i class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></i>
  									</div>
  									<div class="what-right">
  										<h4>Rainwater Harvesting</h4>
  										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aut dignissimos ea est, impedit incidunt, laboriosam </p>
  									</div>
  									<div class="clearfix"></div>
  								</div>
  								<div class="what-top1">
  									<div class="what-left">
  										<i class="glyphicon glyphicon-flash" aria-hidden="true"></i>
  									</div>
  									<div class="what-right">
  										<h4>Home Energy Saving</h4>
  										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aut dignissimos ea est, impedit incidunt, laboriosam </p>
  									</div>
  									<div class="clearfix"></div>
  								</div>
  								<div class="what-top1">
  									<div class="what-left">
  										<i class="glyphicon glyphicon-fire" aria-hidden="true"></i>
  									</div>
  									<div class="what-right">
  										<h4>Wind Power</h4>
  										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aut dignissimos ea est, impedit incidunt, laboriosam </p>
  									</div>
  									<div class="clearfix"></div>
  								</div>
  							</div>
  							<div class="clearfix"></div>
  						</div>
  					</div>
  				</div> -->
  			<!--advantage-->
  	<!--stats-->
  		<!-- <div class="stats" id="stats">
  			<div class="container">
  				<div class="stats-info">
  					<div class="col-md-3 col-sm-3 stats-grid slideanim">
  						<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='1200' data-delay='.5' data-increment="1">1200</div>
  						<h4 class="stats-info">Followers</h4>
  					</div>
  					<div class="col-md-3 col-sm-3 stats-grid slideanim">
  						<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='3000' data-delay='.5' data-increment="1">3000</div>
  						<h4 class="stats-info">Support</h4>
  					</div>
  					<div class="col-md-3 col-sm-3 stats-grid slideanim">
  						<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='9000' data-delay='.5' data-increment="10">9000</div>
  						<h4 class="stats-info">Clients</h4>
  					</div>
  					<div class="col-md-3 col-sm-3 stats-grid slideanim">
  						<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='169' data-delay='.5' data-increment="1">169</div>
  						<h4 class="stats-info">Awards</h4>
  					</div>
  					<div class="clearfix"></div>
  				</div>
  			</div>
  		</div> -->
  	<!--//stats-->
  	<!-- <div class="agileinfo-work-top">
  		<div class="container">
  			<div class="w3-agileits-rides-heading">
  				<h3 class="w3ls_head">Our Recent <span>Works</span></h3>
  			</div>
  			<div class="agileits-w3layouts-rides-grids">
  				<div class="col-sm-4 rides-grid">
  					<div class="agileinfo-work">
  					<div class="list-img">
  						<img src="images/g1.jpg" class="img-responsive" alt="">
  						<div class="textbox"></div>
  						</div>
  						<h4>Nullam tristique</h4>
  						<p>Pellentesque auctor euismod lectus a pretium. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus.</p>
  						<ul>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Nullam tristique faucibus pharetra.</a></li>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Pellentesque auctor</a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="col-sm-4 rides-grid">
  					<div class="agileinfo-work">
  					<div class="list-img">
  						<img src="images/g2.jpg" class="img-responsive" alt="">
  						<div class="textbox"></div>
  						</div>
  						<h4>Euismod lectus </h4>
  						<p>Pellentesque auctor euismod lectus a pretium. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus .</p>
  						<ul>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Nullam tristique faucibus pharetra.</a></li>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Pellentesque auctor</a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="col-sm-4 rides-grid">
  					<div class="agileinfo-work">
  					<div class="list-img">
  						<img src="images/g3.jpg" class="img-responsive" alt="">
  						<div class="textbox"></div>
  					</div>
  						<h4>Curabitur non </h4>
  						<p>Pellentesque auctor euismod lectus a pretium. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus .</p>
  						<ul>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Nullam tristique faucibus pharetra.</a></li>
  							<li><i class="fa fa-arrow-right" aria-hidden="true"></i> <a href="#">Pellentesque auctor</a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="clearfix"> </div>
  			</div>
  		</div>
  	</div> -->
