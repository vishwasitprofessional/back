
<?php $__env->startSection('content'); ?>


<div class="page-heading" style="background-color: #88be4c !important;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title">
          <h2>Dashboard</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- BEGIN Main Container col2-right -->
<section class="main-container col2-left-layout">
  <div class="main container">
    <div class="row">

      <!--col-main col-sm-9 wow bounceInUp animated-->
      <aside class="col-right sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
        <div class="block block-account">
          <div class="block-title"> My Account </div>
          <div class="block-content">
            <ul>
              <li><a href="<?php echo e(route('front-user-orders-show')); ?>"><span> My orders</span></a></li>
              <li><a href="<?php echo e(route('cart')); ?>"><span> My Cart</span></a></li>
            </ul>
          </div>
          <!--block-content-->
        </div>
        <!--block block-account-->

        <div class="custom-slider">
          <div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
              </ol>
              <div class="carousel-inner">
                <!--<div class="item active"><img src="<?php echo e(URL::to('/')); ?>/public/assets/img/makrand_logo.jpg" alt="slide3" style="width:295px; height:350px;">-->
                  <!-- <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">50% OFF</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a class="link" href="#">Buy Now</a>
                      </div> -->
                <!--</div>-->
                <!-- <div class="item"><img src="<?php echo e(URL::to('/')); ?>/templates/front/images/blog-banner.png" alt="slide1">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Hot collection</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                    </div>
                    <div class="item"><img src="<?php echo e(URL::to('/')); ?>/templates/front/images/blog-banner.png" alt="slide2">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Summer collection</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                    </div> -->
              </div>
              <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span>
              </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </aside>
      <!--col-right sidebar col-sm-3 wow bounceInUp animated-->
    </div>
    <!--row-->
  </div>
  <!--main container-->
</section>
<!--main-container col2-left-layout-->


<div class="our-features-box wow bounceInUp animated animated">
  <div class="container">
    <ul>
      <li>
        <div class="feature-box free-shipping">
          <div class="icon-truck"></div>
          <div class="content">We Deliver Across The Globe</div>
        </div>
      </li>
      <li>
        <div class="feature-box need-help">
          <div class="icon-support"></div>
          <div class="content">Contact Us +91-9642392222</div>
        </div>
      </li>
      <li>
        <div class="feature-box money-back">
          <div class="icon-money"></div>
          <div class="content">Money Back Guarantee</div>
        </div>
      </li>
      <li class="last">
        <div class="feature-box return-policy">
          <div class="icon-return"></div>
          <div class="content">Premium Quality Assurance</div>
        </div>
      </li>
    </ul>
  </div>
</div>
<!-- For version 1,2,3,4,6 -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/user/my_account.blade.php ENDPATH**/ ?>