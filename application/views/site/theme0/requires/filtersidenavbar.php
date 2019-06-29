<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?= base_url(); ?>assets/css/sidenavbar2_style.css" rel='stylesheet' type='text/css' />
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="row">
    <div class="side-menu">
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                    SupplyOrigin
                </a>
            </div>

            <!-- Search -->
            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <span class="glyphicon glyphicon-search"></span>
            </a>

            <!-- Search body -->
            <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">


            <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-tasks"></span> Size <span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><input type="checkbox" name="size[]" value="1"> &nbsp;1 Ton</a></li>
                            <li><a href="#"><input type="checkbox" name="size[]" value="2"> &nbsp;1.5 Ton</a></li>
                            <li><a href="#"><input type="checkbox" name="size[]" value="3"> &nbsp;2 Ton</a></li>
							<li><a href="#"><input type="checkbox" name="size[]" value="4"> &nbsp;3 Ton</a></li>
							<li><a href="#"><input type="checkbox" name="size[]" value="4"> &nbsp;Above 3 Ton</a></li>
                        </ul>
                    </div>
                </div>
            </li>
			<li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl2">
                    <span class="glyphicon glyphicon-th"></span> Price<span class="caret"></span>
                </a>
				<div id="dropdown-lvl2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><input type="checkbox" name="price[]" value="1"> &nbsp;Below 2K</a></li>
                            <li><a href="#"><input type="checkbox" name="price[]" value="2"> &nbsp;2K to 5K</a></li>
							<li><a href="#"><input type="checkbox" name="price[]" value="2"> &nbsp;5K to 10K</a></li>
                        </ul>
                    </div>
                </div>
            </li>
			

        </ul>
		
		
    </div><!-- /.navbar-collapse -->
    </nav>
    </div>
</div>
<script>
	$(function () {
		$('.navbar-toggle').click(function () {
			$('.navbar-nav').toggleClass('slide-in');
			$('.side-body').toggleClass('body-slide-in');
			$('#search').removeClass('in').addClass('collapse').slideUp(200);

		});
	    $('#search-trigger').click(function () {
			$('.navbar-nav').removeClass('slide-in');
			$('.side-body').removeClass('body-slide-in');
		});
	});
</script>