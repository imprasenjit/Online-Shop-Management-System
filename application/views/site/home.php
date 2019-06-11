<script>
    $(document).ready(function() {
        $('#home').addClass('active');
    });
</script>
<a href="https://api.whatsapp.com/send?phone=+919707333490&text=We Have some requirement for Steel" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
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
<a href="<?php echo base_url("view-all-sub-category"); ?>" id="myBtn" title="Go to Quotes">Get Quotes</a>
<div class="slider">
    <div class="owl-carousel owl-theme" id="banner-carousel">
        <?php $imgRows = $this->home_page_slider_model->get_results();
        if ($imgRows) {
            foreach ($imgRows as $irows) {
                echo '<div class="item"><img class="" src="' . base_url($irows->file_path) . '" /></div>';
            }
        } else {
            echo '<img class="" src="' . base_url("assets/images/banner8.png") . '" />';
        }
        ?>
    </div>
    <div class="owl-theme">
        <div class="owl-controls">
            <div class="custom-nav owl-nav"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#banner-carousel').owlCarousel({
            autoplay: true,
            margin: 1,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 500,
            loop: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsiveClass: true,
            dots: false,
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
                    items: 1
                }
            }
        });
    });
</script>
</div>
<div class="about">
    <div class="container">
        <h2 class="header-title">SupplyOrigin</h2>
        <div class="w3l-about-grids">
            <div class="col-md-6 w3ls-about-left">
                <div class="w3ls-about-right-img">
                </div>
            </div>
            <div class="col-md-6 w3ls-about-right">
                <p align="justify">
                    SupplyOrigin is the only digital platform dedicated to serve and resolve the challenges of SMEs in
                    the Eastern part of the country.Our research team works relentlessly in identifying the challenges related
                    to sourcing for SMEs and sets up robust channels & processes to plug these gaps.
                    We play an important role in sourcing quality raw materials and finished products from trusted
                    sources at the most economical price points. We eliminate intermediaries which brings down the costs.
                    SMEs get the advantage of hassle-free sourcing, best pricing, quality product and freedom from transportation woes.
                </p><br><br>

            </div>
            <div class="clearfix"> </div>
        </div>
        <br />
        <br />
        <br />
        <div class="row">
            <div class="col-md-2">
                <div class="agileits-icon-grid">
                    <div class="icon-left hvr-radial-out">
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>WIDE RANGE OF PRODUCTS</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="agileits-icon-grid">
                    <div class="icon-left hvr-radial-out">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>QUALITY GUARANTEED</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="agileits-icon-grid">
                    <div class="icon-left hvr-radial-out">
                        <i class="fa fa-inr" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>AFFORDABLE PRICE</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="agileits-icon-grid">
                    <div class="icon-left hvr-radial-out">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>PROCUREMENT FROM TRUSTED SOURCES</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="agileits-icon-grid">
                    <div class="icon-left hvr-radial-out">
                        <i class="fa fa-car" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>HASSLE-FREE TRANSPORTATION</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br />
<br />
<div class="container">
    <h2 class="header-title">Our Products</h2>
    <div class="owl-carousel owl-theme" id="products-carousel">
        <?php $products = $this->sub_category_model->get_all();
        foreach ($products as $product) { ?>
            <div class="item">
                <a href="<?= base_url("view-all-products-by-category/$product->id"); ?>"> <img class="" src="<?= base_url($product->picture); ?>"></a>
                <h4 class="text-center"><?= $product->sub_category ?></h4>
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
<div class="different" style="background: url('<?= base_url("assets/images/loan.jpg"); ?>')no-repeat center 0px fixed !important;background-size: cover !important;">
    <div class="container">

        <p class="w3layouts_dummy_para"><small>Coming Soon</small><br>Quick & Easy <br />Working
            Capital Loan</p>
        <div class="container">
        </div>
    </div>
</div>
<br />
<div class="clearfix"></div>
<div class="container content">
    <div class="owl-carousel owl-theme" id="testimonials-carousel">
        <?php
        $testimonials = $this->feedback_model->get_all_active_feedbacks();
        $i = 1;
        if ($testimonials) {
            foreach ($testimonials as $feedback) {
                ?>
                <div class="testimonials item">
                        <blockquote>
                            <p><?=$feedback->message?></p>
                        </blockquote>
                        <div class="carousel-info">
                            <div class="pull-left">
                                <span class="testimonials-name"><?=$feedback->name?></span>
                                <span class="testimonials-post"><?=$feedback->email?></span>
                            </div>
                        </div>
                </div>
                <?php
                $i++;
            }
        }
        ?>
    </div>
</div>
<div class="clearfix"></div>
<br /><br />
<div class="two-grids">
    <div class="container">
        <h2 class="header-title">Our Associated Brands</h2>
        <div class="col-md-12 col-centered">
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
                        <div class="item"><img src="<?php echo base_url($picture); ?>"></div>
                        <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- //Slider -->
<script>
    $(document).ready(function() {
          $('#testimonials-carousel').owlCarousel({
            autoplay: true,
            margin: 10,
            autoplayTimeout: 2000,
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
                    items: 2
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
</div>
</div>