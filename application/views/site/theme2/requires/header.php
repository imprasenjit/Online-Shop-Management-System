<!DOCTYPE html>
<html lang="en">

<head>
  <title>SupplyOrigin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/theme2/css/modal.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?= base_url(); ?>assets/theme2/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" /><!-- fontawesome -->
  <link href="<?= base_url(); ?>assets/theme2/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" /><!-- Bootstrap stylesheet -->
  <link href="<?= base_url(); ?>assets/theme2/css/styles.css" rel="stylesheet" type="text/css" media="all" /><!-- stylesheet -->
  <link href="<?= base_url(); ?>assets/theme2/css/login-register.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>assets/theme2/css/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/theme2/css/owl.theme.default.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?= base_url(); ?>assets/theme2/js/jquery.min.js.download"></script>
  <script src="<?= base_url(); ?>assets/theme2/js/owl.carousel.js.download" type="text/javascript"></script>


  <script>
    $(document).ready(function() {
      $(".dropdown").hover(
        function() {
          $('.dropdown-menu', this).stop(true, true).slideDown("fast");
          $(this).toggleClass('open');
        },
        function() {
          $('.dropdown-menu', this).stop(true, true).slideUp("fast");
          $(this).toggleClass('open');
        }
      );
    });
  </script>
  <!-- //script for smooth drop down-nav -->
</head>

<body>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125810435-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-125810435-1');
  </script>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../../../../www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-30027142-1', 'w3layouts.com');
    ga('send', 'pageview');
  </script>
  <header>
		<div class="w3layouts-top-strip">
			<div class="container">
				<div class="logo">
					<a href="<?=base_url()?>"><img src="<?= base_url() ?>assets/theme2/images/supply_logo.png" width="200px"></a>
				</div>
				<div class="w3ls-social-icons">
					<a class="cart_modal" href="#!"><i class="fa fa-shopping-cart"></i></a>
          <?php if ($this->session->userdata("isuser")) {  ?>
            <a href="<?= base_url("customers/dashboard/"); ?>"><i class="fa fa-bars" aria-hidden="true"></i>
              Dashboard
            </a>
            <a href="<?= base_url(); ?>login/logout"><i class="fa fa-sign-out"></i></a>
          <?php } else { ?>
            <a class="login_modal" href="javascript:void(0)"><i class="fa fa-sign-in"></i></a>
          <?php } ?>
				</div>
			
				<div class="agileits-contact-info text-right">
					<ul>
						<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:sales@supplyorigin.com">sales@supplyorigin.com</a></li>
						<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><a href="tel:+919706122341">+91 9706122341</a></li>
					</ul>
				</div>
				
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- navigation -->
			<nav class="navbar navbar-default">
			  <div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">
            <li ><a id="home" href="<?= base_url(); ?>home">Home</a></li>
			<li ><a id="about" href="<?= base_url(); ?>home/about">About</a></li>
			<li ><a id="products" href="<?= base_url("view-all-sub-category"); ?>">Products</a></li>
            <li ><a id="downloads" href="<?= base_url('home/downloads') ?>">Downloads</a></li>
            <li ><a id="partnerprograms" href="<?= base_url('home/partnerprograms') ?>">Partner Programs</a></li>
            
            <li ><a id="blogs" href="<?= base_url("blogs"); ?>">Blogs</a></li>
            <li ><a id="contact" href="<?= base_url(); ?>home/contact">Contact</a></li>
				  </ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		<!-- //navigation -->
	</header>
