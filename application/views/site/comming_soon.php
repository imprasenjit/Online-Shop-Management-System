<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Supply Origin - Coming Soon</title>
    <meta name="description" content="Laaris - Coming Soon">
    <meta name="author" content="laaris.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/fav.png" />

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:700|Lobster+Two" rel="stylesheet">

    <!-- ICON FONTS -->
    <link rel="stylesheet" href="css/font-awesome.css">

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link href="<?= base_url(); ?>assets/css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=base_url()?>assets/comming_soon/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/comming_soon/css/style.css">
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-71483603-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body>
<div class="wrapper">

    <div class="home">
        <div class="background_youtube">
            <!-- YouTube link -->
            <img src="img/poster.png" class="img-responsive" alt="">
            <a class="player" data-property="{videoURL:'https://youtu.be/0pXYp72dwl0'}"></a>
        </div>
        <div class="content">
            <h1 class="big-title font_serif ssa js-spanize">Coming Soon...</h1>
            <br>

            <br>
            <div class="countdown fadeInUpBig animated3">
                <h5>Launching in :</h5>
                <ul id="countdown"></ul>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=base_url()?>assets/comming_soon/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/comming_soon/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="js/contact.js"></script> -->
<!-- <script type="text/javascript" src="js/validator.js"></script> -->
<script type="text/javascript" src="<?=base_url()?>assets/comming_soon/js/countdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/comming_soon/js/jquery.mb.YTPlayer.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/comming_soon/js/script.js"></script>
</body>

</html>
