
<?php $__env->startSection('content'); ?>

<div class="page-heading" style="background-image: url(/sweet/public/images/categories/<?php echo e($product_detail->relChildCategory->image_url2); ?>);">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home"> <a href="<?php echo e(route('index')); ?>" title="Go to Home Page">Home</a> <span>—› </span> </li>
                        <?php if(!empty($product_detail->relCategory->title)): ?>
                        <li class="category1599">
                            <a href="<?php echo e(route('product-cat',$product_detail->relCategory->slug)); ?>" title="">
                                <?php echo e($product_detail->relCategory->title); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <span>—› </span> </li>
                        <?php if(!empty($product_detail->relChildCategory->title)): ?>
                        <li class="category1599">
                            <a href="<?php echo e(route('product-cat',$product_detail->relChildCategory->slug)); ?>" title="">
                                <?php echo e($product_detail->relChildCategory->title); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-title">
        <h2><?php echo e($product_detail->relChildCategory->title); ?></h2>
    </div>
</div>
<!-- BEGIN Main Container -->
<div class="main-container col1-layout wow bounceInUp animated">
    <div class="main">
        <div class="col-main">
            <!-- Endif Next Previous Product -->
            <div class="product-view wow bounceInUp animated" itemscope="" itemtype="http://schema.org/Product" itemid="#product_base">
                <div id="messages_product_view"></div>
                <!--product-next-prev-->
                <?php if($product_detail->cat_id==1): ?>
                <div class="product-essential container">
                    <div class="row">
                        <form action="" method="post" id="product_addtocart_form">
                            <div class="product-img-box col-sm-6 col-xs-12">
                                <div class="product-image">
                                    <div class="large-image">
                                        <a href="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product_detail->relProduct->image_url1); ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
                                            <?php if(!empty($product_detail->relProduct->image_url1)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product_detail->relProduct->image_url1); ?>" style="height:100%; width:100%;">
                                            <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/public/assets/img/no_image.jpg" style="height:100%; width:100%;">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-shop col-sm-6 col-xs-12">
                                <div class="product-name">
                                    <h1 itemprop="name"><?php echo e(ucfirst($product_detail->relProduct->title)); ?></h1>
                                </div>
                                <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                    <div class="rating">
                                        <div class="ratings" style="color: #696969 !important;">
                                            <?php for($i=1; $i<=5; $i++): ?> <?php if($i<=$product_detail->relProduct->avg_rating): ?>
                                                <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                <?php else: ?>
                                                <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                <?php endif; ?>
                                                <?php endfor; ?>
                                        </div>
                                    </div>
                                </span>
                                <div class="price-block">
                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-123">
                                            <span class="price">₹<?php echo e($product_detail->sale_price); ?></span>
                                        </span>
                                    </div>
                                    <?php if($product_detail->quantity > 0): ?>
                                    <p class="availability in-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>In stock</span>
                                    </p>
                                    <?php else: ?>
                                    <p class="availability out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>Out of stock</span>
                                    </p>
                                    <?php endif; ?>
                                </div>

                                <!--price-block-->
                                <div class="short-description">
                                    <h2>Description</h2>
                                    <!-- <h2>Quick Overview</h2> -->
                                    <?php echo $product_detail->short_description; ?>

                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <input type="number" id="quantityId" class="input-text qty" value="1" min="1" max="<?php echo e($product_detail->quantity); ?>" style="width: 100px;">
                                                <select id="varient_id" onchange="changeWeight(this.selectedIndex)" class="input-text qty" style="width: 100px;">
                                                    <?php $__currentLoopData = $product_varient_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>


                                        <?php if(Auth::check()): ?>
                                        <button type="button" title="Add to Cart" class="button btn-cart" onclick="addCart()">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        <?php else: ?>
                                        <button type="button" title="Add to Cart" class="button btn-cart" data-toggle="modal" data-target="#loginModal">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="email-addto-box">
                                    </div>
                                </div>
                                <div class="social">
                                    <ul class="link">
                                        <li class="fb"> <a href="<?php echo e(get_setting('facebook_url')); ?>" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="linkedin"> <a href="<?php echo e(get_setting('linkedin_url')); ?>" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="instagram"> <a href="<?php echo e(get_setting('instagram_url')); ?>" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="pintrest"> <a href="<?php echo e(get_setting('pinterest_url')); ?>" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="<?php echo e(route('shop')); ?>" class="button btn-continue" title="Continue Shopping" style="background-color:#88be4c"><span><span>Continue Shopping</span></span></a>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="product-essential container">
                    <div class="row">
                        <form action="" method="post" id="product_addtocart_form">
                            <div class="product-img-box col-sm-6 col-xs-12">
                                <div class="product-image">
                                    <div class="large-image">
                                        <a href="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product_detail->relProduct->image_url1); ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
                                            <?php if(!empty($product_detail->relProduct->image_url1)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product_detail->relProduct->image_url1); ?>" style="height:100%; width:100%;">
                                            <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/public/assets/img/no_image.jpg" style="height:100%; width:100%;">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-shop col-sm-6 col-xs-12">
                                <div class="product-name">
                                    <h1 itemprop="name"><?php echo e(ucfirst($product_detail->relProduct->title)); ?></h1>
                                </div>
                                <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                    <div class="rating">
                                        <div class="ratings" style="color: #696969 !important;">
                                            <?php for($i=1; $i<=5; $i++): ?> <?php if($i<=$product_detail->relProduct->avg_rating): ?>
                                                <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                <?php else: ?>
                                                <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                <?php endif; ?>
                                                <?php endfor; ?>
                                        </div>
                                    </div>
                                </span>
                                <div class="price-block">
                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-123">
                                            <span class="price">₹<?php echo e($product_detail->sale_price); ?></span>
                                        </span>
                                    </div>
                                    <?php if($product_detail->quantity > 0): ?>
                                    <p class="availability in-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>In stock</span>
                                    </p>
                                    <?php else: ?>
                                    <p class="availability out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>Out of stock</span>
                                    </p>
                                    <?php endif; ?>
                                </div>

                                <!--price-block-->
                                <div class="short-description">
                                    <h2>Description</h2>
                                    <!-- <h2>Quick Overview</h2> -->
                                    <?php echo $product_detail->short_description; ?>

                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <input type="hidden" id="varient_id" value="<?php echo e($product_detail->id); ?>">
                                                <input type="number" id="quantityId" class="input-text qty" value="1" min="1" max="<?php echo e($product_detail->quantity); ?>" style="width: 100px;">
                                            </div>
                                        </div>


                                        <?php if(Auth::check()): ?>
                                        <button type="button" title="Add to Cart" class="button btn-cart" onclick="addCart(<?php echo e($product_detail->id); ?>)">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        <?php else: ?>
                                        <button type="button" title="Add to Cart" class="button btn-cart" data-toggle="modal" data-target="#loginModal">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="email-addto-box">
                                    </div>
                                </div>
                                <div class="social">
                                    <ul class="link">
                                        <li class="fb"> <a href="http://www.facebook.com/" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="linkedin"> <a href="http://www.linkedin.com/" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="tw"> <a href="http://twitter.com/" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="pintrest"> <a href="http://pinterest.com/" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="googleplus"> <a href="https://plus.google.com/" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="<?php echo e(route('shop')); ?>" class="button btn-continue" title="Continue Shopping" style="background-color:#88be4c"><span><span>Continue Shopping</span></span></a>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
                <!--product-essential-->
                <div class="product-collateral container">
                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                        <li class="active"> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                        <li> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                    </ul>
                    <div id="productTabContent" class="tab-content">
                        <div class="tab-pane fade" id="product_tabs_description">
                            <div class="std">
                                <?php echo $product_detail->short_description; ?>

                            </div>
                        </div>
                        
                        <div class="tab-pane fade in active" id="reviews_tabs">
                            <div class="box-collateral box-reviews" id="customer-reviews">
                                <div class="box-reviews2">
                                    <h3>Customer Reviews</h3>
                                    <div class="box visible">
                                        <ul>
                                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <table class="ratings-table">
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="rating-box">
                                                                    <!--<div class="rating" style="width:100%;"></div>-->
                                                                     <?php for($i=1; $i<=5; $i++): ?> <?php if($i<=$review->avg_rating): ?>
                                                                    <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                                    <?php else: ?>
                                                                    <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                                    <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="review">
                                                    <!--<h6><a href="#">Excellent</a></h6>-->
                                                    <small>Review by <span><?php echo e($review->relReview->customer_name); ?> </span>on <?php echo e($review->relReview->created_at->format('Y-m-d')); ?> </small>
                                                    <div class="review-txt"> <?php echo e($review->relReview->comment); ?> </div>
                                                </div>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <div class="actions"> 
                                    <?php echo e($reviews->links()); ?>

                                        <!--<a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> -->
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                    </div>
                </div>


                <!--product-collateral-->

                <?php if(count($related_products)!=0): ?>
                <div class="box-additional">
                    <!-- BEGIN RELATED PRODUCTS -->
                    <div class="related-pro container">
                        <div class="slider-items-products">
                            <div class="new_title center">
                                <h2>Related Products</h2>
                            </div>
                            <div id="related-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4 products-grid">
                                    <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($related_product->relProductVarient->slug) && $related_product->status=='show'): ?>
                                    <div class="item">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info">
                                                    <a href="<?php echo e(route('product-detail', $related_product->relProductVarient->slug)); ?>" title="<?php echo e(ucfirst($related_product->title)); ?>" class="product-image">
                                                        <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($related_product->image_url1); ?>" alt="<?php echo e(ucfirst($related_product->title)); ?>" style="height: 100%; width:100%;">

                                                        <div class="item-box-hover">
                                                            <div class="box-inner">
                                                                

                                                        </div>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="info-inner">
                                                <div class="item-title">
                                                    <a href="<?php echo e(route('product-detail', $related_product->relProductVarient->slug)); ?>" title="<?php echo e(ucfirst($related_product->title)); ?>">
                                                        <b><?php echo e(ucfirst($related_product->title)); ?></b>
                                                    </a>
                                                </div>
                                                <div class="item-content">
                                                    <div class="rating">
                                                        <div class="rating">
                                                            <div class="ratings" style="color: #696969 !important;">
                                                                <?php for($i=1; $i<=5; $i++): ?> <?php if($i<=$related_product->avg_rating): ?>
                                                                    <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                                    <?php else: ?>
                                                                    <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                                    <?php endif; ?>
                                                                    <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item-price">
                                                        <div class="price-box"><span class="regular-price" id="product-price-1">
                                                                <span class="price">₹<?php echo e($related_product->relProductVarient->sale_price); ?></span> </span>
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- End Item -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end related product -->

        </div>
        <?php endif; ?>
        <!-- end related product -->
    </div>
</div>
</div>
<!--col-main-->
</div>
<!--main-container-->
</div>
<!--col1-layout-->
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

<script>
    function changeWeight(id) {
        var varient_id = document.getElementById('varient_id').options[id].value;
        var qs = {
            '_token': "<?php echo e(csrf_token()); ?>",
            'varient_id': varient_id
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "<?php echo e(route('ajax-update-weight')); ?>",
            method: "POST",
            data: qs,
            success: function(result) {
                $('.regular-price').html('');
                var parsed = JSON.parse(result.sale_price)
                var value = parsed; //Single Data Viewing
                $('.regular-price').append($('<span class="price">' + '₹' + value + '</span>'));
            },
            error: function(request, status, error) {
                console.log('Error is' + request.responseText);
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/product_detail.blade.php ENDPATH**/ ?>