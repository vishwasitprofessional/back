@extends('layouts.front')
@section('content')

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
            <form action="{{route('shop-filter')}}" method="post">
                @csrf
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
                                        <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc' ) selected @endif>Price - Lower To Higher</option>
                                        <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc' ) selected @endif>Price - Higher To Lower</option>
                                        <!-- {{--<option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleAsc' ) selected @endif>A To Z Ascending</option>
                                        <option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleDesc' ) selected @endif>Z To A Descending</option>
                                        <option value="discAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discAsc' ) selected @endif>Discount - Lower To Higher</option>
                                        <option value="discDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discDesc' ) selected @endif>Discount - Higher To Lower</option>--}} -->
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
                                    @if(count($products)!=0)

                                    @foreach($products as $product)
                                    @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                                    <li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info">
                                                    <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{ucfirst($product->title)}}" class="product-image">
                                                        @if(!empty($product->image_url1))
                                                        <img src="{{URL::to('/')}}/public/images/products/{{$product->image_url1}}" alt="{{ucfirst($product->title)}}" style="height: 100%; width:100%;">
                                                        @else
                                                        <img src="{{URL::to('/')}}/public/assets/img/no_image.jpg" alt="{{ucfirst($product->title)}}" style="height: 100%; width:100%;">
                                                        @endif
                                                        <div class="item-box-hover">
                                                            <div class="box-inner">
                                                                {{--<div class="product-detail-bnt">
                                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                                                <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                                                <!-- <a class="button detail-bnt" type="button"><span>Quick View</span></a> -->
                                                            </div>--}}
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
                                                    <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{ucfirst($product->title)}}">
                                                        <b>{{ucfirst($product->title)}}</b></a>
                                                </div>
                                                <!-- <h5>{{--$product->relProductVarient->title--}}</h5> -->
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
                                                                <span class="price">₹{{$product->relProductVarient->sale_price}}</span> </span>
                                                        </div>
                                                    </div>
                                                    {{--<div class="add_cart">
                                                            <button type="button" title="Add to Cart" class="button btn-cart" onclick="addCart({{$product->relProductVarient->id}})">
                                                    <span><i class="icon-basket"></i>Add to Cart</span>
                                                    </button>
                                                    <!-- <button class="button btn-cart" type="button"><span>Add to Cart</span></button> -->
                                                </div>--}}
                                            </div>
                                        </div>
                            </div>
                    </div>

                    </li>
                    @endif
                    @endforeach
                    @else
                    <h4>NO PRODUCT FOUND IN THIS CATEGORY</h4>
                    @endif
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
                    @foreach(get_categories() as $cat)
                    @if(count(get_child_categories($cat->id))!=0)
                    <li> <a class="active" href="#">{{ucfirst($cat->title)}}</a> <span class="subDropdown minus"></span>
                        <ul class="level0_415" style="display:block">
                            <!-- <li> <a href="grid.html"> Bread Salads </a> <span class="subDropdown plus"></span> -->
                            <!-- <ul class="level1" style="display:none"> -->
                            @foreach(get_child_categories($cat->id) as $child_cat)
                            <li> <a href="{{route('product-cat',$child_cat->slug)}}"><span>{{ucfirst($child_cat->title)}}</span></a> </li>
                            @endforeach
                            <!-- </ul> -->
                            <!--level1-->
                            <!-- </li> -->
                            <!--level1-->

                        </ul>
                        <!--level0-->
                    </li>
                    @else
                    <li><a href="{{route('product-cat',$cat->slug)}}">{{ucfirst($cat->title)}}</a></li>

                    @endif
                    @endforeach

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
                    @if(count(get_categories())>0)
                    <dt class="odd">Category</dt>
                    @if(!empty($_GET['brand']))
                    @php
                    $filter_brands = explode(',',$_GET['brand']);
                    @endphp
                    @endif
                    @foreach(get_multi_brands() as $brand)
                    <div class="col-sm-12">
                        <input type="checkbox" @if(!empty($filter_brands) && in_array($brand['id'], $filter_brands)) checked @endif class="custom-control-input" id="{{$brand['id']}}" name="brand[]" onchange="this.form.submit();" value="{{$brand['id']}}">
                        <label for="{{$brand['id']}}" class="custom-control-label">&nbsp;&nbsp;&nbsp; {{ucfirst($brand['brand_name'])}}<span class="text-muted">({{count($brand['rel_product'])}})</span></label>
                    </div>

                    @endforeach

                    @endif
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
                        <!--<div class="item active"><img src="{{URL::to('/')}}/public/assets/img/makrand_logo.jpg" alt="slide3" style="width:100%; height:100%;">-->
                            <!-- <div class="carousel-caption">
                                <h3><a title=" Sample Product" href="product-detail.html">50% OFF</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a class="link" href="#">Buy Now</a>
                            </div> -->
                        <!--</div>-->
                        <!-- <div class="item"><img src="{{URL::to('/')}}/templates/front/images/blog-banner.png" alt="slide1">
                            <div class="carousel-caption">
                                <h3><a title=" Sample Product" href="product-detail.html">Hot collection</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item"><img src="{{URL::to('/')}}/templates/front/images/blog-banner.png" alt="slide2">
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

        {{--<div class="block block-list block-cart">
                        <div class="block-title"> My Cart </div>
                        <div class="block-content">
                            <div class="summary">
                                <p class="amount">There is <a href="#">1 item</a> in your cart.</p>
                                <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$299.00</span> </p>
                            </div>
                            <div class="ajax-checkout">
                                <button type="button" title="Checkout" class="button button-checkout" onClick="#"> <span>Checkout</span> </button>
                            </div>
                            <p class="block-subtitle">Recently added item(s)</p>
                            <ul id="cart-sidebar" class="mini-products-list">
                                <li class="item">
                                    <div class="item-inner"> <a href="#" class="product-image"><img src="{{URL::to('/')}}/templates/front/images/product-img.jpg" width="80" alt="product"></a>
        <div class="product-details">
            <div class="access"> <a href="#" class="btn-remove1">Remove</a>
                <a href="" title="Edit item" class="btn-edit">
                    <i class="icon-pencil"></i><span class="hidden">Edit item</span></a>
            </div>
            <!--access-->

            <strong>1</strong> x <span class="price">$299.00</span>
            <p class="product-name"><a href="#">RETIS LAPEN CASEN</a></p>
        </div>
        <!--product-details-bottoms-->
        </div>
        </li>
        <li class="item  last1">
            <div class="item-inner"> <a href="#" class="product-image"><img src="{{URL::to('/')}}/templates/front/images/product-img.jpg" width="80" alt="product"></a>
                <div class="product-details">
                    <div class="access"> <a href="#" class="btn-remove1">Remove</a>
                        <a href="" title="Edit item" class="btn-edit">
                            <i class="icon-pencil"></i><span class="hidden">Edit item</span></a>
                    </div>
                    <!--access-->

                    <strong>1</strong> x <span class="price">$299.00</span>
                    <p class="product-name"><a href="#">RETIS LAPEN CASEN</a></p>
                </div>
                <!--product-details-bottoms-->
            </div>
        </li>
        </ul>
        </div>
        </div>
        <div class="block block-compare">
            <div class="block-title"> Compare Products </div>
            <div class="block-content">
                <ol id="compare-items">
                    <li class="item odd">
                        <a href="#" class="btn-remove1" onClick="#"></a>
                        <a class="product-name" href="#">RETIS LAPEN CASEN</a>
                    </li>
                    <li class="item odd">
                        <a href="#" class="btn-remove1" onClick="#"></a>
                        <a class="product-name" href="#">RETIS LAPEN CASEN</a>
                    </li>
                    <li class="item odd">
                        <a href="#" class="btn-remove1" onClick="#"></a>
                        <a class="product-name" href="#">RETIS LAPEN CASEN</a>
                    </li>
                    <li class="item odd">
                        <a href="#" class="btn-remove1" onClick="#"></a>
                        <a class="product-name" href="#">RETIS LAPEN CASEN</a>
                    </li>
                </ol>

                <div class="ajax-checkout">
                    <button type="button" title="Compare" class="button button-compare" onClick="#"><span>Compare</span></button>
                    <button class="button button-clear" href="#"><span>Clear</span></button>
                </div>
                <!--ajax-checkout-->
            </div>
            <!--block-content-->
        </div>
        <!--block block-list block-compare-->


        <div class="block block-poll">
            <div class="block-title"> Community Poll </div>
            <form id="pollForm" action="#" method="post" onSubmit="return validatePollAnswerIsSelected();">
                <div class="block-content">
                    <p class="block-subtitle">What is your favorite color</p>
                    <ul id="poll-answers">
                        <li class="odd">
                            <input type="radio" name="vote" class="radio poll_vote" id="vote_1" value="1">
                            <span class="label">
                                <label for="vote_1">Green</label>
                            </span>
                        </li>
                        <li class="even">
                            <input type="radio" name="vote" class="radio poll_vote" id="vote_2" value="2">
                            <span class="label">
                                <label for="vote_2">Red</label>
                            </span>
                        </li>
                        <li class="odd">
                            <input type="radio" name="vote" class="radio poll_vote" id="vote_3" value="3">
                            <span class="label">
                                <label for="vote_3">Black</label>
                            </span>
                        </li>
                        <li class="last even">
                            <input type="radio" name="vote" class="radio poll_vote" id="vote_4" value="4">
                            <span class="label">
                                <label for="vote_4">Magenta</label>
                            </span>
                        </li>
                    </ul>
                    <div class="actions">
                        <button type="submit" title="Vote" class="button button-vote"><span>Vote</span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="hot-banner"><img src="{{URL::to('/')}}/templates/front/images/hot-trends-banner.png" alt="banner"></div>--}}
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
@endsection