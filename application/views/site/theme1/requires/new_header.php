
            <!DOCTYPE html>

            <html>

            <!-- Mirrored from bootstraptemplates.net/vertex/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:25:22 GMT -->
            <head>
                <meta charset="utf-8">
                <title><?= $page ?> | Supply Origin</title>
                <meta name="keywords" content="Supply Origin" />
                <meta name="description" content="Supply Origin">
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

                <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <!-- Web Fonts  -->
                <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

                <!-- Libs CSS -->
                <link href="<?= base_url(); ?>assets/template/css/bootstrap.min.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/style.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/font-awesome.min.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/streamline-icon.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/header.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/portfolio.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/blog.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/v-animation.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/v-bg-stylish.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/font-icons.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/shortcodes.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/utilities.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/css/theme-responsive.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/plugins/aos/aos.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/plugins/owl-carousel/owl.theme.css" rel="stylesheet" />
                <link href="<?= base_url(); ?>assets/template/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

                <!-- Current Page CSS -->
                <link href="<?= base_url(); ?>assets/template/plugins/rs-plugin/css/settings.css" rel="stylesheet" />

                <!-- Skin -->
                <link rel="stylesheet" href="<?= base_url(); ?>assets/template/css/skin/default.css">

                <!-- Custom CSS -->
                <link rel="stylesheet" href="<?= base_url(); ?>assets/template/css/custom.css">
                    <link href="<?= base_url(); ?>assets/template/custom.css" rel="stylesheet" type="text/css" media="all" />
                   <script src="<?= base_url(); ?>assets/template/js/jquery.min.js"></script>
            </head>

            <body>

                <!--Header-->
                <header id="header" class="header-effect-reveal" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 70}">
                    <div class="header-body">
                        <div class="header-container container">
                            <div class="header-row">
                                <div class="header-column justify-content-start">
                                    <div class="header-logo">
                                        <a href="index-2.html">
                                            <img alt="Vertex" width="250"  src="<?= base_url(); ?>assets/template/img/supply_logo.png">
                                        </a>
                                    </div>
                                </div>

                                <div class="header-column justify-content-end">
                                    <div class="header-nav">
                                        <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                            <nav class="collapse">
                                                <ul class="nav flex-column flex-lg-row" id="mainNav">
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url(); ?>home1">
                                                            Home
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a id="about" class="" href="<?= base_url(); ?>home1/about">
                                                            About
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url('home1/downloads') ?>">
                                                            Downloads
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url('home1/partnerprograms') ?>">
                                                            Partner Programs
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url("view-all-sub-category"); ?>">
                                                            Products
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url("blogs"); ?>">
                                                            Blogs
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega">
                                                        <a class="" href="<?= base_url(); ?>home/contact">
                                                            Contact
                                                        </a>
                                                    </li>

                                                  <?php if ($this->session->userdata("isuser")) {  ?>
                                                    <li class="dropdown dropdown-mega" >
                                                      <a href="<?= base_url("customers/dashboard/"); ?>"><i class="fa fa-bars" aria-hidden="true"></i>  &nbsp; Dashboard
                                                        </a>
                                                    </li>
                                                    <li class="dropdown dropdown-mega dropdown-mega-signin signin ml-lg-3" >
                                                        <a class="dropdown-item pl-lg-4" href="<?= base_url(); ?>login/logout">Logout</a>
                                                    </li>
                                                      <?php } else { ?>

                                                    <li class="dropdown dropdown-mega dropdown-mega-signin signin ml-lg-3" id="headerAccount">
                                                        <a class="dropdown-item pl-lg-4" href="#!">Sign In</a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <div class="dropdown-mega-content">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="signin-form">
                                                                                <!-- <span class="top-sub-title text-color-light-3">MEMBERSHIP</span> -->
                                                                                <h2 class="text-4 mb-4 mt-1">Sign In</h2>
                                                                                <form action="#!" id="frmSignIn" >
                                                                                  <span id="l_message"></span>
                                                                                  <!-- email block -->
                                                                                  <div id="login_with_email_div">
                                                                                    <div class="form-row">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="email"  maxlength="100" class="form-control" name="email" id="l_email" placeholder="Username" required><small id="emailHelp" class="form-text text-muted">We'll never share your Email with
                                                                                                anyone else.</small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="form-group col">
                                                                                            <input type="password"  class="form-control" name="password" id="password" placeholder="Password" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <!-- <div class="form-group col">
                                                                                            <div class="form-check checkbox-custom checkbox-default">
                                                                                                <input class="form-check-input" type="checkbox" id="signInRemember">
                                                                                                <label class="form-check-label" for="signInRemember">
                                                                                                    Remember me
                                                                                                </label>
                                                                                            </div>
                                                                                        </div> -->
                                                                                        <div class="form-group col text-right">
                                                                                            <a href="#" id="headerRecover" class="forgot-pw text-color-dark d-block">Forgot password?</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row align-items-center">
                                                                                        <div class="col">
                                                                                            <a href="#" id="headerSignUp" class="text-color-primary pl-0">Sign Up Now!</a>
                                                                                        </div>
                                                                                        <div class="col text-right">
                                                                                            <button type="button" id="signin" class="btn btn-primary btn-sm pull-right mb-0 mr-0"><i class="fa fa-lock"></i> SIGN IN</button>
                                                                                        </div>
                                                                                    </div>
                                                                                  </div>

                                                                                    <div id="login_with_otp_div" style="display:none;">

                                                                                    <div class="form-row">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="number" value="" maxlength="100" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile Number" required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col text-right">
                                                                                        <button type="button" id="sendotp" class="btn btn-primary btn-sm pull-right mb-0 mr-0"><i class="fa fa-lock"></i> Send OTP</button>
                                                                                    </div>
                                                                                    <div class="form-row afterotp" style="display: none">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="number"   maxlength="6" id="otp" class="form-control" name="otp"  placeholder="OTP">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col text-right afterotp" style="display: none">
                                                                                        <button type="button" id="otplogin" class="btn btn-primary btn-sm pull-right mb-0 mr-0"><i class="fa fa-lock"></i> Send OTP</button>
                                                                                    </div>

                                                                                  </div>


                                                                                </form>
                                                                                <hr/>
                                                                                <div class="form-group text-center" id="btn_login_with_otp" style="font-size: medium"><a href="#!" >OTP LOGIN</a></div>
                                                                                <div class="form-group text-center" id="btn_login_with_email" style="font-size: medium; display:none;"><a href="#!" >EMAIL LOGIN</a></div>
                                                                            </div>
                                                                            <div class="signup-form">
                                                                                <span class="top-sub-title text-color-light-3">MEMBERSHIP</span>
                                                                                <h2 class="text-4 mb-4 mt-1">Sign Up</h2>
                                                                                <form action="#" id="frmSignUp" method="post">
                                                                                    <div class="form-row">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="text" value="" class="form-control" name="name" id="signUpName" placeholder="Full Name" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="email" value="" maxlength="100" class="form-control" name="email" id="signUpEmail" placeholder="E-mail" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row mb-3">
                                                                                        <div class="form-group col">
                                                                                            <input type="password" value="" class="form-control" name="password" id="signUpPassword" placeholder="Password" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row align-items-center">
                                                                                        <div class="col">
                                                                                            <a href="#" id="headerSignIn" class="text-color-primary pl-0">Have an account?</a>
                                                                                        </div>
                                                                                        <div class="col text-right">
                                                                                            <button type="submit" class="btn btn-primary btn-sm pull-right mb-0 mr-0">SIGN UP</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="recover-form">
                                                                                <span class="top-sub-title text-color-light-3">MEMBERSHIP</span>
                                                                                <h2 class="text-4 mb-4 mt-1">Reset my Password</h2>
                                                                                <form action="#" id="frmResetPassword" method="post">
                                                                                    <div class="form-row mb-4">
                                                                                        <div class="form-group col mb-2">
                                                                                            <input type="email" value="" maxlength="100" class="form-control" name="email" id="resetPasswordEmail" placeholder="E-mail" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row align-items-center">
                                                                                        <div class="col">
                                                                                            <a href="#" id="headerRecoverCancel" class="text-color-primary pl-0">Have an account?</a>
                                                                                        </div>
                                                                                        <div class="col text-right">
                                                                                            <button type="submit" class="btn btn-primary btn-sm pull-right mb-0 mr-0">SUBMIT</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <button class="header-btn-collapse-nav ml-3" data-toggle="collapse" data-target=".header-nav-main nav">
                                            <span class="hamburguer">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </span>
                                            <span class="close">
                                                <span></span>
                                                <span></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!--End Header-->
