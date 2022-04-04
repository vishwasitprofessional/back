
<?php $__env->startSection('content'); ?>


<div class="page-heading" style="background-image: url(/sweet/public/images/categories/<?php echo e($categories->image_url2); ?>);">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home"> <a href="<?php echo e(route('index')); ?>" title="Go to Home Page">Home</a>
                        </li>
                    </ul>
                </div>
                <!--col-xs-12-->
            </div>
            <!--row-->
        </div>
        <!--container-->
    </div>
    <div class="page-title">
        <h2><?php echo e($categories->title); ?></h2>
    </div>
</div>
<!--breadcrumbs-->
<!-- BEGIN Main Container col2-left -->
<section class="main-container col2-left-layout bounceInUp animated">
    <!-- For version 1, 2, 3, 8 -->
    <!-- For version 1, 2, 3 -->
    <div class="container">
        <div class="row">
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
                                <select name="" id="sortBy" style="width: 80%;">
                                    <option class="right-arrow">Default Sort</option>
                                    <option value="priceAsc" <?php echo e(old('sortBy')=='priceAsc' ? 'selected' : ''); ?>>Price - Lower To Higher</option>
                                    <option value="priceDesc">Price - Higher To Lower</option>
                                    <!-- <option value="titleAsc">A To Z Ascending</option> -->
                                    <!-- <option value="titleDesc">Z To A Descending</option> -->
                                    <!-- <option value="discAsc">Discount - Lower To Higher</option>
                                    <option value="discDesc">Discount - Higher To Lower</option> -->
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
                                <?php if($product['status']=='show'): ?>
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
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-info">
                                        <div class="info-inner">
                                            <div class="item-title">
                                                <a href="<?php echo e(route('product-detail', $product->relProductVarient->slug)); ?>" title="<?php echo e(ucfirst($product->title)); ?>">
                                                    <b><?php echo e(ucfirst($product->title)); ?></b></a>
                                            </div>
                                            <!-- <h4></h4> -->
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
                    <li> <a class="active" href="<?php echo e(route('product-cat',$cat->slug)); ?>"><?php echo e(ucfirst($cat->title)); ?></a> <span class="subDropdown minus"></span>
                        <ul class="level0_415" style="display:block">

                            <?php $__currentLoopData = get_child_categories($cat->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('product-cat',$child_cat->slug)); ?>"> <?php echo e(ucfirst($child_cat->title)); ?> </a>
                                <span class="subDropdown plus"></span>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <!--level0-->
                    </li>
                    <?php else: ?>
                    <li><a href="<?php echo e(route('product-cat',$cat->slug)); ?>"><?php echo e(ucfirst($cat->title)); ?></a></li>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <!--box-content box-category-->
        </div>
        <!--side-nav-categories-->
        <!-- <div class="block block-layered-nav">
                    <div class="block-title"> Shop By </div>
                    <div class="block-content">
                        <p class="block-subtitle">Shopping Options</p>
                        <dl id="narrow-by-list">
                            <dt class="odd">Category</dt>
                            <dd class="odd">
                                <ol>
                                    <li> <a href="#"> Salad <span class="count">(24)</span> </a> </li>
                                    <li> <a href="#"> Soups <span class="count">(24)</span> </a> </li>
                                    <li> <a href="#"> Fast Food <span class="count">(24)</span> </a> </li>
                                    <li> <a href="#"> Sandwiches <span class="count">(24)</span> </a> </li>
                                </ol>
                            </dd>
                            <dt class="last odd">Price</dt>
                            <dd class="last odd">
                                <ol>
                                    <li> <a href="#"> <span class="price">$0.00</span> - <span class="price">$99.99</span> <span class="count">(26)</span> </a> </li>
                                    <li> <a href="#"> <span class="price">$100.00</span> and above <span class="count">(3)</span> </a> </li>
                                </ol>
                            </dd>
                        </dl>
                    </div>
                </div> -->
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
    $('#sortBy').change(function() {
        var sort = $('#sortBy').val();

        window.location = "<?php echo e(url(''.$route.'')); ?>/<?php echo e($categories->slug); ?>?sort=" + sort;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/product_categories.blade.php ENDPATH**/ ?>