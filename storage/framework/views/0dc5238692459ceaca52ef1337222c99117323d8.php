
<?php $__env->startSection('content'); ?>

<!--container-->
<div class="content">
    <div id="thm-mart-slideshow" class="thm-mart-slideshow">
        <div class="container">
            <div id='thm_slider_wrapper' class='thm_slider_wrapper fullwidthbanner-container'>
                <div id='thm-rev-slider' class='rev_slider fullwidthabanner'>
                    <ul>
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='<?php echo e(URL::to('/')); ?>/public/images/sliders/<?php echo e($slider->image_url); ?>'><img src='<?php echo e(URL::to('/')); ?>/public/images/sliders/<?php echo e($slider->image_url); ?>' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt="<?php echo e($slider->title); ?>" />
                            <div class="info">
                                <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0' data-y='210' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;'><span><?php echo e($slider->title); ?></span></div>
                                <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0' data-y='300' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'><span><?php echo e($slider->sub_title); ?></span></div>
                                <div class='tp-caption sfb  tp-resizeme ' data-x='0' data-y='550' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href="<?php echo e(route('shop')); ?>" class="buy-btn">Shop Now</a></div>
                                <div class='tp-caption Title sft  tp-resizeme ' data-x='0' data-y='420' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><?php echo substr($slider->short_description,0,60); ?></div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <div id="top">
        <div class="container">
            <div class="row">
                <ul>
                    <?php $x = 1; ?>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if ($x == 7) $x = 1; ?>
                    <li>
                        <div>
                            <a href="#" data-scroll-goto="<?php echo e($x); ?>">
                                <img src="<?php echo e(URL::to('/')); ?>/public/images/banners/<?php echo e($banner->image_url); ?>" alt="<?php echo e($banner->title); ?>" style="height: 100%; width:100%;">
                            </a>
                        </div>
                    </li>
                    <?php $x++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <!--Category slider Start-->
    <div class="top-cate">
        <div class="featured-pro container">
            <div class="row">
                <div class="slider-items-products">
                    <div class="new_title">
                        <h2>Top Brands</h2>

                    </div>
                    <div id="top-categories" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col4 products-grid">
                            <?php $__currentLoopData = get_multi_brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multi_brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($multi_brand['rel_product'])): ?>
                            <div class="item">
                                <div class="pro-img">
                                    <a href="<?php echo e(route('product-multi-brand',$multi_brand['id'])); ?>">
                                        <img src="<?php echo e(URL::to('/')); ?>/public/images/brands/logo/<?php echo e($multi_brand['brand_logo']); ?>" alt="<?php echo e($multi_brand['brand_name']); ?>">
                                    </a>
                                    <div class="pro-info"><?php echo e($multi_brand['brand_name']); ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- End Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Category silder End-->




    <!-- best Pro Slider -->
    <?php if(!empty($sub_categories[0])): ?>
    <section class=" wow bounceInUp animated">
        <div class="best-pro slider-items-products container">
            <div class="new_title" style="background-color: #ed6663;">
                <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[0]['title']); ?> </h2>
            </div>
            <div class="cate-banner-img">
                <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[0]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
            </div>
            <div id="best-seller" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid">
                    <?php $__currentLoopData = $sub_categories[0]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                    <div class="item">
                        <div class="item-inner">
                            <div class="item-img">
                                <div class="item-img-info">
                                    <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                        <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                        <!-- <div class="new-label new-top-left">New</div> -->
                                        <div class="item-box-hover">
                                            <div class="box-inner">
                                                
                                            <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                            <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title">
                                    <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                        <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                                </div>
                                <!-- <h4></h4> -->
                                <div class="item-content">
                                    <div class="rating">
                                        <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                    </div>
                                    <div class="item-price">
                                        <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</div>
</div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[1])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[1]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[1]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[1]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[2])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[2]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[2]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[2]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[3])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[3]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[3]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[3]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[4])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[4]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[4]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[4]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[5])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[5]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[5]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[5]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[6])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[6]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[6]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[6]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($sub_categories[7])): ?>
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller <?php echo e($sub_categories[7]['title']); ?> </h2>
        </div>
        <div class="cate-banner-img">
            <img src="<?php echo e(URL::to('/')); ?>/public/images/categories/<?php echo e($sub_categories[7]['image_url1']); ?>" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php $__currentLoopData = $sub_categories[7]['relProductChild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>" class="product-image">
                                    <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product['image_url1']); ?>" alt="<?php echo e($product['title']); ?>" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            
                                        <!-- <div class="product-detail-bnt"><a class="button detail-bnt"><span>Quick View</span></a></div> -->
                                        <!-- <div class="actions">
                                                <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                                    <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                            </div> -->

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e($product['title']); ?>">
                                    <b><?php if(strlen($product['title'])>20): ?> <?php echo e(substr($product['title'], 0,20)); ?>... <?php else: ?> <?php echo e($product['title']); ?> <?php endif; ?></b></a>
                            </div>
                            <!-- <h4></h4> -->
                            <div class="item-content">
                                <div class="rating">
                                    <!-- <div class="ratings">
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%"></div>
                                            </div>
                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                        </div> -->
                                </div>
                                <div class="item-price">
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ <?php echo e($product->relProductVarient->sale_price); ?></span> </span> </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>







<!-- Logo Brand Block -->
<div class="brand-logo wow bounceInUp animated">
    <div class="container">
        <div class="row">
            
<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 testimonials-section">
    <div class="offer-slider parallax parallax-2">
        <ul class="bxslider">
            <?php $__currentLoopData = $google_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="testimonials">
                    <h5 style="font-style: italic;"><?php echo e($review->comment); ?></h5>
                </div>
                <div class="testimonials">
                    <h2><?php echo e($review->customer_name); ?></h2>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>
</div>
</div>
</div>
</div>


<div class="brand-logo wow bounceInUp animated">
    <div class="container">
        <div class="row">
            <div class="logo-brand col-lg-12 col-md-6 col-sm-6 col-xs-12">
                <div class="new_title">
                    <h2>Videos</h2>
                </div>
                <div class="slider-items-products">
                    <div id="brand-slider" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col6" style="height: 250px;">
                            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="logo-item" style="height: 250px; ">
                                    <video style="height: 250px; width:380px;" controls>
                                        <source src="<?php echo e(URL::to('public/videos')); ?>/<?php echo e($row->video_url); ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

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


<div class="popup1" style="display: block;" id="contactPopup">
    <div class="newsletter-sign-box">
        <div class="newsletter">
            <img src="<?php echo e(URL::to('/')); ?>/templates/front/images/close-icon.png" alt="close" class="x" onClick="HideMe();">
            <!-- <div class="newsletter_img">
                    <img alt="newsletter" src="<?php echo e(URL::to('/')); ?>/templates/front/images/newsletter_img.png">
                </div> -->
            <h3>Contact Us</h3>
            <h4>Contact us for more informations.</h4>

            <?php if($message=Session::get('success')): ?>
            <p class="alert alert-success"><?php echo e($message); ?></p>
            <?php endif; ?><br>
            <div class="newsletter-form">
                <form method="post" action="<?php echo e(route('contact-form-create-action')); ?>" name="popup-newsletter" class="email-form">
                    <?php echo csrf_field(); ?>
                    <div class="input-box">
                        <input type="text" name="name" placeholder="Enter your name" class="form-control" value="<?php echo e(old('name')); ?>" required><br>
                        <input type="text" name="email" placeholder="Enter your email address" class="form-control" value="<?php echo e(old('email')); ?>" required><br>
                        <input type="text" name="contact" placeholder="Enter your contact number" class="form-control" value="<?php echo e(old('contact')); ?>" required>
                        <button type="submit" title="Subscribe" class="button subscribe"><span>Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!--newsletter-->

    </div>
    <!--newsletter-sign-box-->
</div>
<div id="fade" style="display: block;"></div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/index.blade.php ENDPATH**/ ?>