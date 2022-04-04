
<?php $__env->startSection('content'); ?>

<div class="page-heading" style="background-image: url(/sweet/public/assets/img/shopping_cart.png);">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home"> <a href="index.html" title="Go to Home Page">Home</a>
                            <!-- <span>—› </span>  -->
                        </li>
                        <!-- <li class="category1599"> <a href="grid.html" title="">Salad</a> <span>—› </span> </li>
                        <li class="category1600"> <a href="grid.html" title="">Bread Salad</a> <span>—› </span> </li>
                        <li class="category1601"> <strong>Dakos</strong> </li> -->
                    </ul>
                </div>
                <!--col-xs-12-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </div>
    <div class="page-title">
        <h2>ALL CATEGORIES</h2>
    </div>
</div>
<!--breadcrumbs-->
<!-- BEGIN Main Container col2-left -->
<section class="main-container col2-left-layout bounceInUp animated">
    <!-- For version 1, 2, 3, 8 -->
    <!-- For version 1, 2, 3 -->
    <div class="container">
        <div class="row">
            <form action="<?php echo e(route('shop-filter')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="col-main col-sm-9 col-sm-push-3 product-grid">
                    <div class="pro-coloumn">
                        <article class="col-main">
                            <div class="toolbar">
                                <div class="sorter">
                                    <div class="view-mode">
                                        <span title="Grid" class="button button-active button-grid">&nbsp;</span>
                                        <!-- <a href="list.html" title="List" class="button-list">&nbsp;</a>  -->
                                    </div>
                                </div>
                                <div id="sort-by">
                                    <label class="left">Sort By: </label>
                                    <select name="sortBy" class="btn dropdown-toggle" onchange="this.form.submit();" style="width: 80%;">
                                        <option class="right-arrow">Default Sort</option>
                                        <option value="priceAsc" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc' ): ?> selected <?php endif; ?>>Price - Lower To Higher</option>
                                        <option value="priceDesc" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc' ): ?> selected <?php endif; ?>>Price - Higher To Lower</option>
                                        <!--  -->
                                    </select>
                                    <!-- <ul>
                                    <li><a href="#">Position<span class="right-arrow"></span></a>
                                        <ul>
                                            <li><a href="#">Name</a></li>
                                            <li><a href="#">Price</a></li>
                                            <li><a href="#">Position</a></li>
                                        </ul>
                                    </li>
                                </ul> -->
                                    <!-- <a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a> -->
                                </div>
                                <!-- <div class="pager">
                                <div id="limiter">
                                    <label>View: </label>
                                    <ul>
                                        <li><a href="#">15<span class="right-arrow"></span></a>
                                            <ul>
                                                <li><a href="#">20</a></li>
                                                <li><a href="#">30</a></li>
                                                <li><a href="#">35</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pages">
                                    <label>Page:</label>
                                    <ul class="pagination">
                                        <li><a href="#">&laquo;</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div> -->
                            </div>
                            <div class="category-products">
                                <ul class="products-grid">
                                    <?php if(count($products)!=0): ?>

                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($product->relProductVarient->slug) && $product->status=='show'): ?>
                                    <li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info">
                                                    <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e(ucfirst($product->title)); ?>" class="product-image">
                                                        <?php if(!empty($product->image_url1)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product->image_url1); ?>" alt="<?php echo e(ucfirst($product->title)); ?>" style="height: 100%; width:100%;">
                                                        <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/public/assets/img/no_image.jpg" alt="<?php echo e(ucfirst($product->title)); ?>" style="height: 100%; width:100%;">
                                                        <?php endif; ?>
                                                        <div class="item-box-hover">
                                                            <div class="box-inner">
                                                                
                                                            <!-- <div class="actions"><span class="add-to-links">
                                                                    <a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
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
                                                    <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e(ucfirst($product->title)); ?>">
                                                        <b><?php echo e(ucfirst($product->title)); ?></b></a>
                                                </div>
                                                <!-- <h5></h5> -->
                                                <div class="item-content">
                                                    <!-- <div class="rating">
                                                        <div class="ratings">
                                                            <div class="rating-box">
                                                                <div class="rating" style="width:80%"></div>
                                                            </div>
                                                            <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                        </div>
                                                    </div> -->
                                                    <div class="item-price">
                                                        <div class="price-box"><span class="regular-price" id="product-price-1">
                                                                <span class="price">₹<?php echo e($product->relProductVarient->sale_price); ?></span> </span>
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                        </div>
                            </div>
                    </div>

                    </li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <h4>NO PRODUCT FOUND IN THIS CATEGORY</h4>
                    <?php endif; ?>
                    </ul>
                </div>
                </article>
        </div>
        <!--	///*///======    End article  ========= //*/// -->
    </div>
    <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated">
        <!-- BEGIN SIDE-NAV-CATEGORY -->
        <div class="side-nav-categories">
            <div class="block-title"> Categories </div>
            <!--block-title-->
            <!-- BEGIN BOX-CATEGORY -->
            <div class="box-content box-category">
                <ul>
                    <?php $__currentLoopData = get_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count(get_child_categories($cat->id))!=0): ?>
                    <li> <a class="active" href="#"><?php echo e(ucfirst($cat->title)); ?></a> <span class="subDropdown minus"></span>
                        <ul class="level0_415" style="display:block">
                            <!-- <li> <a href="grid.html"> Bread Salads </a> <span class="subDropdown plus"></span> -->
                            <!-- <ul class="level1" style="display:none"> -->
                            <?php $__currentLoopData = get_child_categories($cat->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li> <a href="<?php echo e(route('product-cat',$child_cat->slug)); ?>"><span><?php echo e(ucfirst($child_cat->title)); ?></span></a> </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- </ul> -->
                            <!--level1-->
                            <!-- </li> -->
                            <!--level1-->

                        </ul>
                        <!--level0-->
                    </li>
                    <?php else: ?>
                    <li><a href="<?php echo e(route('product-cat',$cat->slug)); ?>"><?php echo e(ucfirst($cat->title)); ?></a></li>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- <li> <a href="grid.html">Sandwiches‎</a> </li> -->
                    <!--level 0-->

                </ul>
            </div>
            <!--box-content box-category-->

        </div>
        <!--side-nav-categories-->



        <div class="block block-layered-nav">
            <div class="block-title"> Shop By </div>
            <div class="block-content">
                <p class="block-subtitle">Shopping Options</p>
                <dl id="narrow-by-list">
                    <?php if(count(get_categories())>0): ?>
                    <dt class="odd">Category</dt>
                    <?php if(!empty($_GET['brand'])): ?>
                    <?php
                    $filter_brands = explode(',',$_GET['brand']);
                    ?>
                    <?php endif; ?>
                    <?php $__currentLoopData = get_multi_brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12">
                        <input type="checkbox" <?php if(!empty($filter_brands) && in_array($brand['id'], $filter_brands)): ?> checked <?php endif; ?> class="custom-control-input" id="<?php echo e($brand['id']); ?>" name="brand[]" onchange="this.form.submit();" value="<?php echo e($brand['id']); ?>">
                        <label for="<?php echo e($brand['id']); ?>" class="custom-control-label">&nbsp;&nbsp;&nbsp; <?php echo e(ucfirst($brand['brand_name'])); ?><span class="text-muted">(<?php echo e(count($brand['rel_product'])); ?>)</span></label>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
            </div>
        </div>

        <div class="custom-slider">
            <div>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <!--<div class="item active"><img src="<?php echo e(URL::to('/')); ?>/public/assets/img/makrand_logo.jpg" alt="slide3" style="width:100%; height:100%;">-->
                            <!-- <div class="carousel-caption">
                                <h3><a title=" Sample Product" href="product-detail.html">50% OFF</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a class="link" href="#">Buy Now</a>
                            </div> -->
                        <!--</div>-->
                        <!-- <div class="item"><img src="<?php echo e(URL::to('/')); ?>/templates/front/images/blog-banner.png" alt="slide1">
                            <div class="carousel-caption">
                                <h3><a title=" Sample Product" href="product-detail.html">Hot collection</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item"><img src="<?php echo e(URL::to('/')); ?>/templates/front/images/blog-banner.png" alt="slide2">
                            <div class="carousel-caption">
                                <h3><a title=" Sample Product" href="product-detail.html">Summer collection</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div> -->
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only">Next</span> </a>
                </div>
            </div>
        </div>

        
    </aside>
    <!--col-right sidebar-->
    </form>
    </div>
    <!--row-->
    </div>
    <!--container-->
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
<script>
    $(document).ready(function() {
        if ($('#slider-range').length > 0) {
            const max_value = parseInt($('#slider-range').data('max'));
            const min_value = parseInt($('#slider-range').data('min'));
            let price_range = min_value + '-' + max_value;

            if ($('#price_range').length > 0 && $('#price_range').val()) {
                price_range = $('#price_range').val().trim();
            }
            let price = price_range.split('-');

            $('#slider-range').slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function(event, ui) {
                    $('#amount').val('₹' + ui.values[0] + "-" + '₹' + ui.values[1]);
                    $('#price_range').val(ui.values[0] + "-" + ui.values[1]);
                }
            })
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/shop.blade.php ENDPATH**/ ?>