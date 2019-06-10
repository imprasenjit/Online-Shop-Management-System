<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Administrator</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<link href="<?= base_url(); ?>assets/css/login_bootstrap.css" type="text/css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/font-awesome.css" type="text/css" rel="stylesheet" />
    <link type="text/css" href="<?= base_url(); ?>assets/css/login_css.css" rel="stylesheet" media="screen" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id="container">
<header id="header" class="navbar navbar-static-top">
	<div class="container-fluid">
		<div id="header-logo" class="navbar-header"><a href="<?= base_url();?>home" class="navbar-brand"><img src="<?=base_url("assets/images/supply_logo.png");?>" width="150px" alt="SupplyOrigin" title="SupplyOrigin" /></a></div>
		<a href="#" id="button-menu" class="hidden-md hidden-lg"><span class="fa fa-bars"></span></a>
	</div>
</header>
<div id="content">
	<div class="container-fluid"><br />
		<br />
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-center">Supplier Login.</h1>
					</div>
					<div class="panel-body">
						<div id="usernameBlock">
						<?php if(isset($name) && !empty($name)){ ?>
							<h1 class="panel-title text-center"> <?php echo "Welcome ".ucfirst($name);?></h1>
							<h1 class="panel-title text-center"> <?php echo ($username);?></h1>
							<div class="text-center"><a href="#!" onclick="showUsername();">Not You ?</a></div>
						<?php } ?>
					</div>
                    <span id="l_message"></span>
						<form action="<?= base_url(); ?>admin/login/process" method="post" enctype="multipart/form-data">
						<div class="form-group" id="input-username" <?php if(isset($username) && !empty($username)){?> style="display:none;" <?php }?> >
							<label for="input-username">Username</label>
							<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
							  <input type="text" name="username"  placeholder="Username" value="<?php echo $username;?>" id="s_username"  class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label for="input-password">Password</label>
							<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" name="password" value="" placeholder="Password" id="s_password" class="form-control" />
							</div>
											<!--<span class="help-block"><a href="http://192.168.88.229/open/admin/index.php?route=common/forgotten">Forgotten Password</a></span>-->
						</div>
						<div class="text-right">
							<a type="submit" class="btn btn-primary btn-block" id="signin"><i class="fa fa-key"></i> Login</a>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('body').keydown(function(event) {
    if (event.keyCode == 13 || event.which == 10) {
      $("#signin").trigger("click");
      return false;
    }
  });
		showUsername=function(){
			document.getElementById("input-username").style.display = "block";
			document.getElementById("usernameBlock").style.display = "none";
		}
		$("#signin").click(function() {
			$('#signin').empty().append("processing...");
			var username = $("#s_username").val();
			var password = $("#s_password").val();
			$.ajax({
				url: "<?= base_url("admin/login/supplier_login_process"); ?>",
				method: "post",
				data: {
					username: username,
					password: password
				},
				dataType: "json",
				success: function(jsn) {
					if (jsn.login) {
						$('#l_message').empty().append('<div class="alert alert-success" role="alert">' + jsn.message + '</div>');
						window.location.href="<?=base_url("admin/suppliers/dashboard")?>";
					} else {
						$('#l_message').empty().append('<div class="alert alert-danger" role="alert">' + jsn.message + '</div>');
					}
					$('#signin').empty().append("Submit");

				}
			});
		});
	});
</script>
<footer id="footer"><a href="http://avantikain.com">Avantika Innovations PVT LTD</a> &copy; 2018 All Rights Reserved.<br /> Version 1.0.0</footer>
</div>

</body></html>
