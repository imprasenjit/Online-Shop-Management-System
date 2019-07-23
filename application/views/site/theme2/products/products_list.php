
	<link href="<?= base_url(); ?>assets/theme2/css/sidebar.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?= base_url(); ?>assets/theme2/css/cards.css" rel="stylesheet" type="text/css" media="all" />
	<script>
	$(document).ready(function() {
		$('#products').addClass('active');
	});
</script>

	<!-- products -->
	<section style="padding-top:20px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-3 sidebar" style="padding-top:32px;">
					<div class="mini-submenu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>
					<div class="list-group">
						<span href="#" class="list-group-item " style="font-size:20px;font-weight: 900;">
							Categories
							<!-- <span class="pull-right" id="slide-submenu">
								<i class="fa fa-times"></i>
							</span> -->
						</span>
						<a href="#" class="list-group-item" style="font-size:20px; font-weight:800" onclick="myFunction()">
							Steel
							<span class="pull-right">
								<i class="fa fa-angle-down"></i>
							</span>
						</a>
						<div class="dropdown-container" id="drop">
							<a href="#" class="list-group-item" style="font-size:17px;"">
								Structural Steel
								<span class="pull-right">
										<i class="fa fa-angle-down"></i>
									</span>
							</a>
							<a href=" #" class="list-group-item" style="font-size:17px;"">
									Galvanized Steel
									<span class="pull-right">
											<i class="fa fa-angle-down"></i>
										</span>
								</a>
								<a href=" #" class="list-group-item" style="font-size:17px;"">
										Metal Sheet & Roofing
										<span class="pull-right">
												<i class="fa fa-angle-down"></i>
											</span>
									</a>
									<a href=" #" class="list-group-item" style="font-size:17px;"">
											Construction Steel
											<span class="pull-right">
													<i class="fa fa-angle-down"></i>
												</span>
										</a>
						</div>
						<a href=" #" class="list-group-item" style="font-size:20px; font-weight:800" onclick="myFunction2()">
								Lubricants
								<span class="pull-right">
									<i class="fa fa-angle-down"></i>
								</span>
							</a>
							<div class="dropdown-container2" id="drop2">
									<a href="#" class="list-group-item" style="font-size:17px;"">
										Industrial Lubricants
										<span class="pull-right">
												<i class="fa fa-angle-down"></i>
											</span>
									</a>
									<a href=" #" class="list-group-item" style="font-size:17px;"">
											Automotive Lubricants
											<span class="pull-right">
													<i class="fa fa-angle-down"></i>
												</span>
										</a>
								</div>
							<!-- <a href="#" class="list-group-item">
							<i class="fa fa-user"></i> Lorem ipsum
						</a>
						<a href="#" class="list-group-item">
							<i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
						</a>
						<a href="#" class="list-group-item">
							<i class="fa fa-bar-chart-o"></i> Lorem ipsumr <span class="badge">14</span>
						</a>
						<a href="#" class="list-group-item">
							<i class="fa fa-envelope"></i> Lorem ipsum
						</a> -->
						</div>
					</div>
					<div class="col-md-9">
						<!-- <div class="col-md-9"><div style="padding:25px 0px;">
				</div></div> -->
						<div class="index-content">
							<div class="container">
								<div class="row">
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="images/structuralsteel.png">
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Structural Steel</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a>
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="https://supplyorigin.com/storage/WEBSITE_FILES/2019/05/05/7927225f0b7c7aa0186bc77ffa9a05c7.jpg" width=253 height=195>
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Galvanized Steel</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a>
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="https://supplyorigin.com/storage/WEBSITE_FILES/2019/05/05/4db998d9b8c37493bca9b55c9de535e0.jpg" width=253 height=195>
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Metal Sheet & Roofing
												</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a></div>
								<div class="row">
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="images/constructionsteel.png">
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Construction Steel</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a>
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="images/industriallubricants.png">
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Industrial Lubricants</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a>
									<a href="blog-ici.html">
										<div class="col-lg-3">
											<div class="card">
												<img src="images/automotivelubricants.png">
												<h4 class="text-center" style="font-size:18px; font-weight: 800;">Automotive Lubricants
												</h4>
												<br>
												<p></p>
												<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<a href="blog-ici.html" class="blue-button">Read More</a> -->
											</div>
										</div>
									</a>
								</div>

							</div>
						</div>
					</div>

					<!-- <div class="col-6 col-lg-4 col-md-4 col-sm-3">
					<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="images/structuralsteel.png" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title" style="margin-left:65px;padding-top:10px;">Sructural Steel</h5>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-md-4 col-sm-3">
					<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="https://supplyorigin.com/storage/WEBSITE_FILES/2019/05/05/7927225f0b7c7aa0186bc77ffa9a05c7.jpg" alt="Card image cap" width="253px" height="197px">
						<div class="card-body">
							<h5 class="card-title">Galvanized Steel</h5>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-md-4 col-sm-3">
					<div class="card" style="width: 18rem;">
						<img class="card-img-top" src="https://supplyorigin.com/storage/WEBSITE_FILES/2019/05/05/4db998d9b8c37493bca9b55c9de535e0.jpg" alt="Card image cap" width="253px" height="197px">
						<div class="card-body">
							<h5 class="card-title">Metal Sheet & Roofing</h5>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-md-4 col-sm-3">
						<div class="card" style="width: 18rem;">
							<img class="card-img-top" src="images/constructionsteel.png" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Construction Steel</h5>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-4 col-md-4 col-sm-3">
							<div class="card" style="width: 18rem;">
								<img class="card-img-top" src="images/industriallubricants.png" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title">Industrial Lubricants</h5>
								</div>
							</div>
						</div>
						<div class="col-6 col-lg-4 col-md-4 col-sm-3">
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="images/automotivelubricants.png" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title">Automotive Lubricants</h5>
									</div>
								</div>
							</div> -->
				</div>
			</div>
		</div>
	</section>
	<!-- //products -->
	<script>
		$(function () {

			$('#slide-submenu').on('click', function () {
				$(this).closest('.list-group').fadeOut('slide', function () {
					$('.mini-submenu').fadeIn();
				});

			});

			$('.mini-submenu').on('click', function () {
				$(this).next('.list-group').toggle('slide');
				$('.mini-submenu').hide();
			})
		})

	</script>

	<script>
		function myFunction() {
			var x = document.getElementById("drop");

			if (x.className === "dropdown-container" ) {
				if (x.style.display === "block") {
					x.style.display = "none";
				} else {
					x.style.display = "block";
				}
			}
		}
		function myFunction2() {
			var x = document.getElementById("drop2");

			if (x.className === "dropdown-container2" ) {
				if (x.style.display === "block") {
					x.style.display = "none";
				} else {
					x.style.display = "block";
				}
			}
		}
	</script>