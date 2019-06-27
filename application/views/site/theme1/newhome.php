<div role="main" class="main">
  <?php $imgRows = $this->home_page_slider_model->get_results();

  ?>
    <div class="slider-container rev_slider_wrapper slider-container-full-height">
        <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.7" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'sliderLayout': 'fullscreen', 'gridwidth': [1140,960,720,540], 'gridheight': [900,900,900,900], 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,576], 'navigation' : {'arrows': { 'enable': true, 'hide_under': 767, 'style': 'slider-arrows-style-2' }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 35, 'h_offset': 0}}}">
            <ul>
              <?php
              if ($imgRows) {
                  foreach ($imgRows as $irows) { ?>
                    <li class="slide-overlay slide-overlay-level-4" data-transition="fade">
                        <img src="<?=base_url($irows->file_path) ?>"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             class="rev-slidebg">
                        <div class="tp-caption text-color-light font-primary font-weight-light"
                             data-x="center"
                             data-y="center" data-voffset="['-145','-145','-130','-115']"
                             data-start="1600"
                             data-fontsize="['15','15','15','15']"
                             data-transform_in="opacity:0;s:300;"
                             data-transform_out="opacity:0;s:300;">WHAT WE DO?</div>
                        <div class="tp-caption text-color-light font-primary font-weight-bold"
                             data-x="center"
                             data-y="center" data-voffset="['-75','-75','-65','-55']"
                             data-start="1300"
                             data-fontsize="['67','67','50','35']"
                             data-lineheight="['75','75','65','45']"
                             data-transform_in="y:[100%];s:500;"
                             data-transform_out="y:[100%];s:500;"
                             data-mask_in="x:0px;y:0px;">Customized solutions for</div>
                        <div class="tp-caption text-color-light font-primary font-weight-bold"
                             data-x="center"
                             data-y="center"
                             data-start="1000"
                             data-fontsize="['67','67','50','35']"
                             data-lineheight="['75','75','65','45']"
                             data-transform_in="y:[100%];s:500;"
                             data-transform_out="y:[100%];s:500;"
                             data-mask_in="x:0px;y:0px;">digital marketing</div>
                        <div class="tp-caption text-color-light font-primary font-weight-light"
                             data-x="center"
                             data-y="center" data-voffset="['120','120','90','75']"
                             data-start="1900"
                             data-fontsize="['38','38','30','21']"
                             data-transform_in="y:[100%];opacity:0;s:500;">Easier than you think</div>
                        <a class="tp-caption btn btn-rounded btn-dark font-weight-semibold"
                           href="#ourwork"
                           data-hash
                           data-hash-offset="90"
                           data-x="center"
                           data-y="center" data-voffset="['215','215','180','165']"
                           data-start="2200"
                           data-whitespace="nowrap"
                           data-fontsize="['13','13','13','13']"
                           data-paddingtop="['13','13','13','13']"
                           data-paddingbottom="['13','13','13','13']"
                           data-paddingleft="['65','65','65','45']"
                           data-paddingright="['65','65','65','45']"
                           data-transform_in="y:[100%];s:500;"
                           data-transform_out="opacity:0;s:500;"
                           data-mask_in="x:0px;y:0px;">VIEW OUR WORK</a>
                    </li>

                  <?php }
              }
              ?>


            </ul>
        </div>
    </div>

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
                            <div class="owl-carousel" data-plugin-options='{"items": 6, "singleItem": false, "autoPlay": true}'>
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
