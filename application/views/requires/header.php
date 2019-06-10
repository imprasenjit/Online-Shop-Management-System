<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $page ?>-SupplyOrigin</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel='shortcut icon' type='image/x-icon' href='<?= base_url("assets/images/favicon.ico") ?>' />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //custom-theme files-->
    <link href="<?= base_url(); ?>assets/css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link defer href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css" media="all" />
    <link defer href="<?= base_url(); ?>assets/css/sidenavbar_style.css" rel='stylesheet' type='text/css' />
    <link defer href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
    <!-- //carousel -->
    <link href="<?= base_url(); ?>assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/owl.theme.default.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- for bootstrap working -->
    <script defer src="<?= base_url(); ?>assets/css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script defer src="<?= base_url(); ?>assets/js/owl.carousel.js" type="text/javascript"></script>
    <!-- //font-awesome-icons -->
</head>

<body>
    <!-- banner -->
    <div class="banner-1">
        <div class="banner-dott">
            <!-- Top-Bar -->
            <div class="top">
                <div class="container">
                    <div class="col-md-6 top-left">
                        <ul>
                            <li><i class="fa fa-whatsapp" aria-hidden="true"></i> +91 9706122341</li>
                            <!--<li><i class="fa fa-map-marker" aria-hidden="true"></i> G.S. Road, Bhangagarh, Guwahati, Assam </li>-->
                        </ul>
                    </div>
                    <?php
                    //print_r($this->session->userdata());
                    ?>
                    <div class="col-md-6 top-middle">
                        <ul>
                            <li><a class="cart_modal"><i class="fa fa-shopping-cart"></i></a></li>
                            <?php if ($this->session->userdata("isuser")) {  ?>
                                <li><a href="<?= base_url("customers/dashboard/"); ?>"><i class="fa fa-bars" aria-hidden="true"></i>
                            Dashboard    
                                </a></li>
                                <li><a href="<?= base_url(); ?>login/logout">Logout</i></a></li>
                            <?php } else { ?>
                                <li><a class="login_modal" href="javascript:void(0)">&nbsp;Login</a></li>
                                <li><a class="register_modal" href="#!">&nbsp;Register</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="top-bar" id="myHeader">
                <div class="container">
                    <div class="header">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header navbar-left">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/supply_logo.png" width="200px"></span></a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                                <nav class="top-menu">
                                    <ul class="nav navbar-nav">
                                        <li class="" id="home"><a href="<?= base_url(); ?>home">Home</a></li>
                                        <li id="about"> <a href="<?= base_url(); ?>home/about">About</a></li>
                                        <li id="downloads"> <a href="<?= base_url('downloads') ?>">Downloads</a></li>
                                        <li id="partnerprograms"> <a href="<?= base_url('partnerprograms') ?>">Partner Programs</a></li>
                                        <li class="dropdown" id="products">
                                            <a href="<?= base_url("view-all-sub-category"); ?>">Products</a>
                                        </li>
                                        <li id="contact"><a href="<?= base_url(); ?>home/contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>