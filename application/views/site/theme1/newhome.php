<div role="main" class="main">
  <?php $imgRows = $this->home_page_slider_model->get_results();

  ?>
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

    <div class="v-page-wrap no-bottom-spacing no-top-spacing">

        <div class="v-parallax v-bg-stylish" id="intro">
            <div class="container">

                <div class="row center">
                    <div class="col-sm-12">
                        <p class="v-smash-text-large">
                            <span>Supply Origin</span>
                        </p>
                        <div class="horizontal-break"></div>

                        <p class="mb-8 v-lead">
                          SupplyOrigin is the only digital platform dedicated to serve and resolve the challenges of SMEs in
                          the Eastern part of the country.Our research team works relentlessly in identifying the challenges related
                          to sourcing for SMEs and sets up robust channels & processes to plug these gaps.
                          We play an important role in sourcing quality raw materials and finished products from trusted
                          sources at the most economical price points. We eliminate intermediaries which brings down the costs.
                          SMEs get the advantage of hassle-free sourcing, best pricing, quality product and freedom from transportation woes.
                        </p>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-sm-3">
                        <div class="text-center">
                            <img src="<?=base_url()?>assets/template/img/mix/animate_images.png" class="mb-3" />
                            <h6>ANIMATE: IMAGES</h6>
                            <p class="mb-4">Choose from 12 different animations to apply to your images</p>
                            <a class="btn v-btn standard btn-primary" href="#" target="_self">
                                <span class="text">See More</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-center">
                            <img src="<?=base_url()?>assets/template/img/mix/animate_icons.png" class="mb-3" />
                            <h6>ANIMATE: ICON BOXES</h6>
                            <p class="mb-4">Choose from 12 different animations to apply to your icon boxes.</p>
                            <a class="btn v-btn btn-primary" href="#" target="_self">
                                <span class="text">See More</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-center">
                            <img src="<?=base_url()?>assets/template/img/mix/animate_charts.png" class="mb-3" />
                            <h6>COUNTERS, CHARTS & PROGRESS BARS</h6>
                            <p class="mb-4">Vertex lets you put an end to boring statistics!</p>
                            <a class="btn v-btn btn-primary" href="#" target="_self">
                                <span class="text">See More</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-center">
                            <img src="<?=base_url()?>assets/template/img/mix/native_video.png" class="mb-3" />
                            <h6>FULL-SCREEN VIDEO PLAYBACK</h6>
                            <p class="mb-4">Finally you can let users experience your videos in a way that does them justice</p>
                            <a class="btn v-btn btn-primary" href="#" target="_self">
                                <span class="text">See More</span>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="v-parallax v-bg-stylish v-bg-stylish-v4" id="facts">

            <div class="container">
                <div class="row center">
                    <div class="col-sm-12">
                        <p class="v-smash-text-large">
                            <span>Services</span>
                        </p>
                        <div class="horizontal-break"></div>
<!--
                        <p class="mb-8 v-lead">

                        </p> -->
                    </div>
                </div>

                <div class="row center">
                    <div class="col-sm-3">
                        <div class="v-circle-chart v-circle-x" data-linewidth="5" data-percent="0" data-animatepercent="85" data-size="170" data-barcolor="#2484da" data-trackcolor="#d4d4d4">
                            <span>
                              <!-- <i class="icon-star-1"></i> -->
                              <i class="fa fa-smile-o" aria-hidden="true"></i>
                            </span>
                        </div>

                        <h3>WIDE RANGE OF PRODUCTS</h3>
                        <!-- <p>
                            Mauris malesuada elementum mauris, in posuere justo ornare nec. Nam ornare,
                            nulla nec venenatis posuere.
                        </p> -->
                        <!-- <a href="#" class="read-more">Read More</a> -->
                    </div>

                    <div class="col-sm-3">
                        <div class="v-circle-chart v-circle-x" data-linewidth="5" data-percent="0" data-animatepercent="85" data-size="170" data-barcolor="#2484da" data-trackcolor="#d4d4d4">
                            <span>
                              <i class="fa fa-cubes" aria-hidden="true"></i>
                              <!-- <i class="icon-hand-like-2"></i> -->
                            </span>
                        </div>
                        <h3>QUALITY GUARANTEED</h3>
                        <!-- <p>
                            Mauris malesuada elementum mauris, nare,
                            nulla nec venenatis posuere, libero nunc tellus mi, mollis at.
                        </p>
                        <a href="#" class="read-more">Read More</a> -->
                    </div>

                    <div class="col-sm-3">
                        <div class="v-circle-chart v-circle-x" data-linewidth="5" data-percent="0" data-animatepercent="85" data-size="170" data-barcolor="#2484da" data-trackcolor="#d4d4d4">
                            <span>
                              <i class="fa fa-inr" aria-hidden="true"></i>
                              <!-- <i class="icon-setting-gear"></i> -->
                            </span>
                        </div>

                        <h3>AFFORDABLE PRICE</h3>
                        <!-- <p>
                            Mauris malesuada elementum mauris, in posuere justo ornare nec. Nam ornare,
                            nunc tellus mi, mollis at.
                        </p>
                        <a href="#" class="read-more">Read More</a> -->
                    </div>

                    <div class="col-sm-3">
                        <div class="v-circle-chart v-circle-x" data-linewidth="5" data-percent="0" data-animatepercent="85" data-size="170" data-barcolor="#2484da" data-trackcolor="#d4d4d4">
                            <span>
                              <i class="fa fa-users" aria-hidden="true"></i>
                            </span>
                        </div>

                        <h3>PROCUREMENT FROM TRUSTED SOURCES</h3>
                        <!-- <p>
                            Mauris justo ornare nec. Nam ornare,
                            nulla nec venenatis posuere, libero nunc tellus mi, mollis at.
                        </p>
                        <a href="#" class="read-more">Read More</a> -->
                    </div>
                    <div class="col-sm-3">
                        <div class="v-circle-chart v-circle-x" data-linewidth="5" data-percent="0" data-animatepercent="85" data-size="170" data-barcolor="#2484da" data-trackcolor="#d4d4d4">
                            <span>
                              <i class="fa fa-car" aria-hidden="true"></i>
                            </span>
                        </div>

                        <h3>HASSLE-FREE TRANSPORTATION</h3>
                        <!-- <p>
                            Mauris justo ornare nec. Nam ornare,
                            nulla nec venenatis posuere, libero nunc tellus mi, mollis at.
                        </p>
                        <a href="#" class="read-more">Read More</a> -->
                    </div>
                </div>
            </div>
        </div>
        <?php $products = $this->sub_category_model->get_all();?>
     <?php if($products){ ?>
       <div class="v-parallax v-bg-stylish" id="our-work">
           <div class="container">
               <div class="row center">
                   <div class="col-sm-12">
                       <p class="v-smash-text-large">
                           <span>Our Products</span>
                       </p>
                       <div class="horizontal-break"></div>
                   </div>
               </div>

               <div class="row">
                   <div class="col-sm-12">
                       <div class="v-portfolio-widget">
                           <div class="v-portfolio-wrap">

                               <ul class="v-portfolio-items v-portfolio-standard filterable-items column-3 row clearfix center">

                                 <?php
                                   foreach ($products as $product) { ?>

                                       <li class="clearfix v-portfolio-item col-sm-4 standard   business">
                                           <figure class="animated-overlay overlay-alt">
                                               <img src="<?= base_url($product->picture); ?>" />
                                               <a href="<?= base_url("view-all-products-by-category/$product->id"); ?>" class="link-to-post"></a>
                                               <figcaption>
                                                   <div class="thumb-info thumb-info-v2"><i class="fa fa-angle-right"></i></div>
                                               </figcaption>
                                           </figure>
                                           <div class="v-portfolio-item-info">
                                               <h3 class="v-portfolio-item-title">
                                                   <a href="<?= base_url("view-all-products-by-category/$product->id"); ?>" class="link-to-post"><?= $product->sub_category ?></a>
                                               </h3>
                                           </div>
                                       </li>
                                   <?php
                                    }
                                  ?>


                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    <?php }?>
    <div class="different" style="background: url('<?= base_url("assets/images/loan.jpg"); ?>')no-repeat center 0px fixed !important;background-size: cover !important;">
        <div class="container">

            <p class="w3layouts_dummy_para"><small>Coming Soon</small><br>Quick & Easy <br />Working
                Capital Loan</p>
            <div class="container">
            </div>
        </div>
    </div>

        <div class="v-parallax v-bg-stylish padding-70" style="background-image: url(img/slider/04.jpg);" id="services">
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
        </div>



        <!--Client Carousel v2-->
        <div class="v-clients-widget-v2 v-bg-stylish v-bg-stylish-v4">
            <div class="container">
              <div class="row center">
                  <div class="col-sm-12">
                      <p class="v-smash-text-large">
                          <span>Our Associated Brands</span>
                      </p>
                      <div class="horizontal-break"></div>
                  </div>
              </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="v-clients-wrap-v2 carousel-wrap">
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
                                      <div class="item">
                                          <figure>
                                              <a href="#!">
                                                  <img src="<?php echo base_url($picture); ?>">
                                              </a>
                                          </figure>
                                      </div>
                                      <?php
                                      $i++;
                                  }
                              }
                              ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Client Carousel v2-->
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
