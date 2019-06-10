<!DOCTYPE html>
<html>
<head>
	<title>Supply Origin | Home </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);
		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="<?= base_url(); ?>themes/1/assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="<?= base_url(); ?>themes/1/assets/css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="<?= base_url(); ?>themes/1/assets/css/style.css" rel='stylesheet' type='text/css' />
	<link href="<?= base_url(); ?>themes/1/assets/css/simpleLightbox.css" rel='stylesheet' type='text/css' />
	<link href="<?= base_url(); ?>themes/1/assets/css/fontawesome-all.css" rel="stylesheet">
	<link href="<?= base_url(); ?>themes/1/assets/css/owl.carousel.min.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:100i,200,200i,300,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url(); ?>themes/1/assets/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>themes/1/assets/js/bootstrap.min.js"></script>
</head>
<body>
	<header>
		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="<?= base_url(); ?>">
					<img src="<?= base_url(); ?>themes/1/assets/images/supply_logo.png" class="img-responsive logo-image">
				</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse d-md-flex flex-row-reverse" id="navbarSupportedContent">
					<ul class="navbar-nav tp-nav text-center">
						<li class="nav-item active">
							<a class="nav-link" href="<?= base_url("home"); ?>">Home
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="blog.html">Blog</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
							    aria-expanded="false">
								Categories
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="project.html">Steel</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="error.html">Lubricants and Transformer Oils</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Contact</a>
						</li>
					</ul>
					<!--<form action="#" method="post" class="form-inline my-2 my-lg-0 search">
						<input class="form-control mr-sm-2" type="search" placeholder="Search here..." name="Search" required="">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>-->
				</div>
			</nav>
		</div>
	</header>
	<!--//header-->
    <!--/banner-->
	<div class="banner ">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner " role="listbox">
				<div class="carousel-item active">
				<img class="d-block w-100" src="<?=base_url("themes/1/assets/images/banner1.jpg")?>">
					<div class="carousel-caption ">						
						<h3>MS Structural</h3>
					</div>
				</div>
				<div class="carousel-item">
				<img class="d-block w-100" src="<?=base_url("themes/1/assets/images/banner2.jpg")?>">
					<div class="carousel-caption">
						<h3>GI Structural</h3>
					</div>
				</div>
				<div class="carousel-item">
				<img class="d-block w-100" src="<?=base_url("themes/1/assets/images/banner1.jpg")?>">
					<div class="carousel-caption">
						<h3>Sheet/Plate </h3>
					</div>
				</div>
				<div class="carousel-item">
				<img class="d-block w-100" src="<?=base_url("themes/1/assets/images/banner2.jpg")?>">
					<div class="carousel-caption">
						<h3>MS Pipe</h3>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
    <script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 3500
        });
    });
    </script>
	<!--/model-->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Introduction Video</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body video">
					<iframe src="https://player.vimeo.com/video/33531612"></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!--//model-->
	<!--//banner-->
	<section class="banner-bottom">
		<div class="container">
			<!-- Three columns of text below the carousel -->
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-lg-5 bt-bottom-info" data-aos="fade-right">
				<img class="d-block w-100" style="height:280px;" src="<?=base_url("themes/1/assets/images/banner2.jpg")?>">
				</div>
				<div class="col-lg-7 bt-bottom-info" data-aos="fade-left">
					<p align="justify">Supply Origin is the only digital platform dedicated to serve and resolve the challenges of SMEs in the Eastern part of the country. Our research team works relentlessly in identifying the challenges related to sourcing for SMEs and sets up robust channels & processes to plug these gaps. We play an important role in sourcing quality raw materials and finished products from trusted sources at the most economical price points. We eliminate intermediaries which brings down the costs. SMEs get the advantage of hassle-free sourcing, best pricing, quality product and freedom from transportation woes.</p>
				</div>
			</div>
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-lg-2 bottom-sub-grid text-center aos-init aos-animate" data-aos="zoom-in">
					<div class="bt-icon">
						<span class="fas fa-trophy"></span>
					</div>
					<h4 class="sub-tittle_w3ls">WIDE RANGE OF PRODUCTS</h4>
				</div>
				<!-- /.col-lg-4 -->
				<div class="col-lg-2 bottom-sub-grid text-center aos-init aos-animate" data-aos="zoom-in">
					<div class="bt-icon">
						<span class="far fa-thumbs-up"></span>
					</div>
					<h4 class="sub-tittle_w3ls">QUALITY GUARANTEED</h4>
				</div>
				<!-- /.col-lg-4 -->
				<div class="col-lg-2 bottom-sub-grid text-center aos-init aos-animate" data-aos="zoom-in">
					<div class="bt-icon">
						<span class="fas fa-rupee-sign"></span>
					</div>
					<h4 class="sub-tittle_w3ls">AFFORDABLE PRICE</h4>
				</div>
				<!-- /.col-lg-4 -->
				<!-- /.col-lg-4 -->
				<div class="col-lg-2 bottom-sub-grid text-center aos-init aos-animate" data-aos="zoom-in">
					<div class="bt-icon">
						<span class="fas fa-users"></span>
					</div>
					<h4 class="sub-tittle_w3ls">PROCUREMENT FROM TRUSTED SOURCES</h4>
				</div>
				<!-- /.col-lg-4 -->
				<!-- /.col-lg-4 -->
				<div class="col-lg-2 bottom-sub-grid text-center aos-init aos-animate" data-aos="zoom-in">
					<div class="bt-icon">
						<span class="fas fa-car"></span>
					</div>
					<h4 class="sub-tittle_w3ls">HASSLE-FREE TRANSPORTATION</h4>
				</div>
				<!-- /.col-lg-4 -->
			</div>
		</div>
		<!-- /.row -->
		</div>
	</section>
	<!---->
	<!-- /stats -->
	<!--<section class="stats_test container-fluid">
		<div class="row inner_stat_wthree_agileits">
			<div class="col-md-3 stats_left counter_grid">
				<i class="far fa-building"></i>
				<p class="counter">145</p>
				<h4>Branches</h4>
			</div>
			<div class="col-md-3 stats_left counter_grid1">
				<i class="fas fa-users"></i>
				<p class="counter">165</p>
				<h4>Trainers</h4>
			</div>
			<div class="col-md-3 stats_left counter_grid2">
				<i class="far fa-edit"></i>
				<p class="counter">563</p>
				<h4>Pojects</h4>
			</div>
			<div class="col-md-3 stats_left counter_grid3">
				<i class="far fa-smile"></i>
				<p class="counter">1045</p>
				<h4>Happy Clients</h4>
			</div>
		</div>	
	</section>-->
	<!-- //stats -->
	<!--/services-->
	<!--<section class="services">
		<div class="container" style="margin-top:-120px;">
			<h3 class="tittle_w3ls">Unlimited Features</h3>
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-lg-4 grid_info_main" data-aos="flip-left">
					<div class="grid_info">
						<div class="icon_info">
							<span class="icon">
								<i class="fas fa-laptop"></i>
							</span>
							<h5>Fully Responsive</h5>
							<p>Lorem ipsum dolor sit amet,vehicula vel sapien et, feugiat sapien amet.</p>
						</div>
					</div>
					<div class="grid_info second">
						<div class="icon_info">
							<span class="icon">
								<i class="far fa-clone"></i>
							</span>
							<h5>Layered PSD Files</h5>
							<p>Lorem ipsum dolor sit amet,vehicula vel sapien et, feugiat sapien amet.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 grid_info_main mid" data-aos="flip-down">
					<img src="<?= base_url(); ?>themes/1/assets/images/mid.png" class="img-responsive" alt=" ">
				</div>
				<div class="col-lg-4 grid_info_main" data-aos="flip-right">
					<div class="grid_info">
						<div class="icon_info">
							<span class="icon">
								<i class="fas fa-sitemap"></i>
							</span>
							<h5>Site Builder</h5>
							<p>Lorem ipsum dolor sit amet,vehicula vel sapien et, feugiat sapien amet.</p>
						</div>
					</div>
					<div class="grid_info second">
						<div class="icon_info">
							<span class="icon">
								<i class="fab fa-android"></i>
							</span>
							<h5>Animation</h5>
							<p>Lorem ipsum dolor sit amet,vehicula vel sapien et, feugiat sapien amet.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--//services-->
	<!---->
	<!--<section class="grids_sec_2">
		<div class="row style-grids_main">
			<div class="col-md-6 grid_sec_info">
				<div class="style-grid-2-text_info" data-aos="fade-right">
					<h3>We are composer one of the best in web designing.</h3>
					<p>Itaque earum rerum hic tenetur a sapiente delectus reiciendis maiores alias consequatur.sed quia non numquam eius modi
						tempora incidunt ut labore .</p>
					<div class="bnr-button">
						<button type="button" class="btn btn-primary play" data-toggle="modal" data-target="#exampleModal">
							<i class="fas fa-play"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-6 style-image-2">
			</div>
			<div class="col-md-6 style-image-2 second">
			</div>
			<div class="col-md-6 grid_sec_info">
				<div class="style-grid-2-text_info" data-aos="fade-right">
					<h3>We are composer one of the best in web designing.</h3>
					<p>Itaque earum rerum hic tenetur a sapiente delectus reiciendis maiores alias consequatur.sed quia non numquam eius modi
						tempora incidunt ut labore .</p>
					<div class="bnr-button">
						<button type="button" class="btn btn-primary play" data-toggle="modal" data-target="#exampleModal">
							<i class="fas fa-play"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>-->
	<!--/Projects-->
	<section class="services">
		<div class="container" style="margin-top:-150px;">
		<div class="row">
		<div class="col-md-8 offset-md-2">
			<h3 class="tittle_w3ls">Our Works</h3>
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-md-12 proj_gallery_grid" data-aos="zoom-in">
					<div class="section_1_gallery_grid">
						<a title="" href="<?= base_url(); ?>themes/1/assets/images/workingcapital.jpeg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/workingcapital.jpeg" alt=" " class="img-responsive"  height="300"/>
								<div class="proj_gallery_grid1_pos">
									<h2>Quick & Easy </h3>
									<h2>Working Capital Loan </h3>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
	</section>
	<!--//Projects-->
	<!--/Projects-->
	<section class="newsletter py-5 my-lg-5" id="newsletter">
	<h3 class="heading text-center text-uppercase">Our Associated Brands</h3>
	<p class="heading-bottom text-center font-italic mb-5">We proudly deliver the Best Products from the Best Brands </p>
	<div class="container">
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-md-12 proj_gallery_grid" data-aos="zoom-in">
						 <div class="owl-carousel">
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/sail_logo.png" ></div>
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/bstl_logo.png"></div>
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/savita_logo.png"></div>
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/savsol-logo.png"></div>
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/shyam_metalics_logo.png"></div>
							<div class="item"><img src="<?= base_url(); ?>themes/1/assets/images/rashmi_group_logo.png"></div>
					</div>
				</div>
			</div>
	</div>
</section>
	<!--//Projects-->
	<!--/Projects-->
	<!--<section class="services">
		<div class="container">
			<h3 class="tittle_w3ls">Our Works</h3>
			<div class="row inner-sec-w3layouts-agileinfo">
				<div class="col-md-4 proj_gallery_grid" data-aos="zoom-in">
					<div class="section_1_gallery_grid">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g1.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g1.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g2.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g2.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g3.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g3.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4 proj_gallery_grid" data-aos="zoom-in">
					<div class="section_1_gallery_grid">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g4.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g4.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g5.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g5.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g6.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g6.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4 proj_gallery_grid" data-aos="zoom-in">
					<div class="section_1_gallery_grid">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g7.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g7.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g8.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g8.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
					<div class="section_1_gallery_grid" data-aos="zoom-in">
						<a title="Donec sapien massa, placerat ac sodales ac, feugiat quis est." href="<?= base_url(); ?>themes/1/assets/images/g9.jpg">
							<div class="section_1_gallery_grid1">
								<img src="<?= base_url(); ?>themes/1/assets/images/g9.jpg" alt=" " class="img-responsive" />
								<div class="proj_gallery_grid1_pos">
									<h3>Digital Biz</h3>
									<p>Add some text</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>-->
	<!--//Projects-->
	<!--reviews_sec-->
	<section class="reviews_sec" id="testimonials">
		<h3 class="tittle_w3ls cen">Clients</h3>
		<div class="inner-sec-w3layouts-agileinfo">
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="testimonials_grid">
								<div class="testimonials_grid-inn">
									<img src="<?= base_url(); ?>themes/1/assets/images/t3.jpg" alt=" " class="img-responsive" />
									<div class="test_social_pos">
										<ul class="social_list1">
											<li>
												<a href="#" class="facebook1">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
											<li>
												<a href="#" class="twitter2">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<li>
												<a href="#" class="dribble3">
													<i class="fab fa-dribbble"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<h3>Prasenjit Das
									<span>Customer</span>
								</h3>
								<i>Guwahati</i>
								<p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus. Proin
									eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
							</div>
						</li>
						<li>
							<div class="testimonials_grid">
								<div class="testimonials_grid-inn">
									<img src="<?= base_url(); ?>themes/1/assets/images/t2.jpg" alt=" " class="img-responsive" />
									<div class="test_social_pos">
										<ul class="social_list1">
											<li>
												<a href="#" class="facebook1">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
											<li>
												<a href="#" class="twitter2">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<li>
												<a href="#" class="dribble3">
													<i class="fab fa-dribbble"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<h3>Anamika
									<span>Customer</span>
								</h3>
								<i>Guwahati</i>
								<p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus. Proin
									eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
							</div>
						</li>
						<li>
							<div class="testimonials_grid">
								<div class="testimonials_grid-inn">
									<img src="<?= base_url(); ?>themes/1/assets/images/t1.jpg" alt=" " class="img-responsive" />
									<div class="test_social_pos">
										<ul class="social_list1">
											<li>
												<a href="#" class="facebook1">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
											<li>
												<a href="#" class="twitter2">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<li>
												<a href="#" class="dribble3">
													<i class="fab fa-dribbble"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<h3>Chirajit
									<span>Customer</span>
								</h3>
								<i>Assam</i>
								<p>Maecenas interdum, metus vitae tincidunt porttitor, magna quam egestas sem, ac scelerisque nisl nibh vel lacus. Proin
									eget gravida odio. Donec ullamcorper est eu accumsan cursus.</p>
							</div>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</section>
	<!---->
	<script type="text/javascript">
		$(document).ready(function () {
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				nav: true,
				navText: [
					"<i class='fa fa-caret-left'></i>",
					"<i class='fa fa-caret-right'></i>"
				],
				autoplay: true,
				autoplayHoverPause: true,
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
    <!--footer-->
	<footer>
		<div class="container">
			<div class="row footer-top-w3layouts-agile">
				<div class="col-lg-3 footer-grid" data-aos="zoom-in">
					<div class="footer-title">
						<h2>About Us</h2>
					</div>
					<div class="footer-text">
						<p>Supply Origin is the only digital platform dedicated to serve and resolve the challenges of SMEs in the Eastern part of the country..</p>

					</div>
				</div>
				<div class="col-lg-3 footer-grid" data-aos="zoom-in">
					<div class="footer-title">
						<h3>Contact Us</h3>
					</div>
					<div class="footer-office-hour">
						<ul>
							<li class="hd">Address :</li>
							<li>G.S. Road,Guwahati, Assam, India</li>

						</ul>
						<ul>
							<li class="hd">Phone:+91- 9706189034</li>
							<li class="hd">Email:
								<a href="mailto:supplyorigin@gmail.com">supplyorigin@gmail.com</a>
							</li>
							
						</ul>
					</div>
				</div>
				
				<div class="col-lg-3 footer-grid" data-aos="zoom-in">
					<div class="footer-title">
						<h3>Subscribe</h3>
					</div>
					<p>Please subscribe to get updates</p>
					<form action="#" method="post" class="newsletter">
						<input class="email" type="email" placeholder="Your email..." required="">
						<button class="btn1">
							<i class="far fa-envelope"></i>
						</button>
					</form>
					<div class="clearfix"></div>
				</div>

			</div>

		</div>
	</footer>
	<!---->
	<div class="copyright">
		<div class="container">
			<div class="copyrighttop" data-aos="fade-left">
				<ul>
					<li>
						<h4>Follow us on:</h4>
					</li>
					<li>
						<a class="facebook" href="#">
							<i class="fab fa-facebook-f"></i>
						</a>
					</li>
				
					<li>
						<a class="facebook" href="#">
							<i class="fab fa-pinterest-p"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="copyrightbottom" data-aos="fade-right">
				<p>© 2019 Suppply Origin. All Rights Reserved | Design by
					<a href="http://avantikain.com/">AIPL</a>
				</p>

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- js -->

	<!-- //js -->
	<!-- simpleLightbox -->
	<script src="<?= base_url(); ?>themes/1/assets/js/simpleLightbox.js"></script>
	<script src="<?= base_url(); ?>themes/1/assets/js/owl.carousel.js"></script>
	<script>
		$('.proj_gallery_grid a').simpleLightbox();
	</script>
	<!-- //simpleLightbox -->
	<!-- flexSlider -->
	<script defer src="<?= base_url(); ?>themes/1/assets/js/jquery.flexslider.js"></script>
	<script type="text/javascript">
	 
	  $(window).load(function(){
		$('.flexslider').flexslider({
		  animation: "slide",
		  start: function(slider){
			$('body').removeClass('loading');
		  }
		});
	  });
	</script>
  
	<!-- //flexSlider -->

	<!-- stats -->
	<script src="<?= base_url(); ?>themes/1/assets/js/jquery.waypoints.min.js"></script>
	<script src="<?= base_url(); ?>themes/1/assets/js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
	<!-- //stats -->
	<!-- /js files -->
	<link href='<?= base_url(); ?>themes/1/assets/css/aos.css' rel='stylesheet prefetch' type="text/css" media="all" />
	<link href='<?= base_url(); ?>themes/1/assets/css/aos-animation.css' rel='stylesheet prefetch' type="text/css" media="all" />
	<script src='<?= base_url(); ?>themes/1/assets/js/aos.js'></script>
	<script src="<?= base_url(); ?>themes/1/assets/js/aosindex.js"></script>
	<!-- //js files -->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="<?= base_url(); ?>themes/1/assets/js/move-top.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>themes/1/assets/js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 900);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->

	<script type="text/javascript">
		$(document).ready(function () {
			/*
									var defaults = {
							  			containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear' 
							 		};
									*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<a href="#home" class="scroll" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span>
	</a>
	


</body>

</html>