@extends('layouts.front')
@section('content')

<!--container-->
<div class="content">
    <div id="thm-mart-slideshow" class="thm-mart-slideshow">
        <div class="container">
            <div id='thm_slider_wrapper' class='thm_slider_wrapper fullwidthbanner-container'>
                <div id='thm-rev-slider' class='rev_slider fullwidthabanner'>
                    <ul>
                        @foreach($sliders as $slider)
                        <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='{{URL::to('/')}}/public/images/sliders/{{$slider->image_url}}'><img src='{{URL::to('/')}}/public/images/sliders/{{$slider->image_url}}' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt="{{$slider->title}}" />
                            <div class="info">
                                <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0' data-y='210' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;'><span>{{$slider->title}}</span></div>
                                <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0' data-y='300' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'><span>{{$slider->sub_title}}</span></div>
                                <div class='tp-caption sfb  tp-resizeme ' data-x='0' data-y='550' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href="{{route('shop')}}" class="buy-btn">Shop Now</a></div>
                                <div class='tp-caption Title sft  tp-resizeme ' data-x='0' data-y='420' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'>{!!substr($slider->short_description,0,60)!!}</div>
                            </div>
                        </li>
                        @endforeach
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
                    @foreach($banners as $banner)
                    <?php if ($x == 7) $x = 1; ?>
                    <li>
                        <div>
                            <a href="#" data-scroll-goto="{{$x}}">
                                <img src="{{URL::to('/')}}/public/images/banners/{{$banner->image_url}}" alt="{{$banner->title}}" style="height: 100%; width:100%;">
                            </a>
                        </div>
                    </li>
                    <?php $x++; ?>
                    @endforeach
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
                            @foreach(get_multi_brands() as $multi_brand)
                            @if(!empty($multi_brand['rel_product']))
                            <div class="item">
                                <div class="pro-img">
                                    <a href="{{route('product-multi-brand',$multi_brand['id'])}}">
                                        <img src="{{URL::to('/')}}/public/images/brands/logo/{{$multi_brand['brand_logo']}}" alt="{{$multi_brand['brand_name']}}">
                                    </a>
                                    <div class="pro-info">{{$multi_brand['brand_name']}}</div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <!-- End Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Category silder End-->




    <!-- best Pro Slider -->
    @if(!empty($sub_categories[0]))
    <section class=" wow bounceInUp animated">
        <div class="best-pro slider-items-products container">
            <div class="new_title" style="background-color: #ed6663;">
                <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[0]['title']}} </h2>
            </div>
            <div class="cate-banner-img">
                <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[0]['image_url1']}}" alt="" style="width: 100%; height:100%;">
            </div>
            <div id="best-seller" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid">
                    @foreach($sub_categories[0]['relProductChild'] as $product)
                    @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                    <div class="item">
                        <div class="item-inner">
                            <div class="item-img">
                                <div class="item-img-info">
                                    <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                        <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                        <!-- <div class="new-label new-top-left">New</div> -->
                                        <div class="item-box-hover">
                                            <div class="box-inner">
                                                {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                                <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                                @else
                                                <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                                @endif
                                            </div>--}}
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
                                    <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                        <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                                </div>
                                <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                        <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                    </div>
                                    {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                    <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                    <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                    @else
                                    <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
</div>
</div>
</section>
@endif

@if(!empty($sub_categories[1]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[1]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[1]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[1]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[2]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[2]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[2]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[2]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[3]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[3]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[3]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[3]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[4]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[4]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[4]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[4]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[5]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[5]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[5]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[5]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[6]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[6]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[6]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[6]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif

@if(!empty($sub_categories[7]))
<section class=" wow bounceInUp animated">
    <div class="best-pro slider-items-products container">
        <div class="new_title" style="background-color: #ed6663;">
            <h2 style="background-color: #ed6663;">Best Seller {{$sub_categories[7]['title']}} </h2>
        </div>
        <div class="cate-banner-img">
            <img src="{{URL::to('/')}}/public/images/categories/{{$sub_categories[7]['image_url1']}}" alt="" style="width: 100%; height:100%;">
        </div>
        <div id="best-seller" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                @foreach($sub_categories[7]['relProductChild'] as $product)
                @if(!empty($product->relProductVarient->slug) && $product->status=='show')
                <div class="item">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}" class="product-image">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="{{$product['title']}}" style="height: 100%; width:100%;">

                                    <!-- <div class="new-label new-top-left">New</div> -->
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            {{--<div class="product-detail-bnt">
                                                @if(Auth::check())
                                                <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                            <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                            <a class="button detail-bnt" type="button" onclick="addCart({{$product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                            @else
                                            <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                            @endif
                                        </div>--}}
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
                                <a href="{{route('product-detail', $product->relProductVarient->slug)}}" title="{{$product['title']}}">
                                    <b>@if(strlen($product['title'])>20) {{substr($product['title'], 0,20)}}... @else {{$product['title']}} @endif</b></a>
                            </div>
                            <!-- <h4>{{--$product->relProductVarient->title--}}</h4> -->
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
                                    <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProductVarient->sale_price}}</span> </span> </div>
                                </div>
                                {{--<div class="add_cart">
                                            @if(Auth::check())
                                            <input type="hidden" class="product_id" value="{{$product->relProductVarient->id}}">
                                <input type="hidden" id="quantity{{$product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product->relProductVarient->id}})"><span>Add to Cart</span></button>
                                @else
                                <button type="submit" class="button btn-cart icon" data-toggle="modal" data-target="#loginModal"><span>Add to Cart</span></button>@endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    </div>
</section>
@endif


{{--<section class=" wow bounceInUp animated">
        <div class="best-pro slider-items-products container">
            <div class="new_title">
                <h2>Popular Products</h2>
            </div>
            <!-- <div class="cate-banner-img">
                <img src="{{URL::to('/')}}/templates/front/images/category-banner.jpg" alt="Retis lapen casen">
</div> -->
<div id="best-seller" class="product-flexslider hidden-buttons">
    <div class="slider-items slider-width-col4 products-grid">
        @foreach($popular_products as $product)
        <div class="item">
            <div class="item-inner">
                <div class="item-img">
                    <div class="item-img-info">
                        <a href="{{route('product-detail', $product->relProduct->slug)}}" title="{{ucfirst($product->relProduct->title)}}" class="product-image">
                            <img src="{{URL::to('/')}}/public/images/products/{{$product->relProduct->image_url1}}" alt="{{ucfirst($product->relProduct->title)}}" style="height: 100%; width:100%;">
                        </a>
                        <!-- <div class="new-label new-top-left">New</div> -->
                        <div class="item-box-hover">
                            <div class="box-inner">
                                <div class="product-detail-bnt">
                                    <input type="hidden" class="product_id" value="{{$product->pro_id}}">
                                    <input type="hidden" id="quantity{{$product->pro_id}}" class="qty-input form-control" value="1" min="1">
                                    <a class="button detail-bnt" type="button" onclick="addCart({{$product['pro_id']}})" title="Add To Cart"><span>Quick View</span></a>
                                </div>
                                <!-- <div class="product-detail-bnt"><a class="button detail-bnt" title="Add To Cart"><span>Quick View</span></a></div> -->
                                <div class="actions">
                                    <span class="add-to-links"><a href="#" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a>
                                        <a href="#" class="link-compare add_to_compare" title="Add to Compare"><span>Add to Compare</span></a></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-info">
                    <div class="info-inner">
                        <div class="item-title">
                            <a href="{{route('product-detail', $product->relProduct->slug)}}" title="{{ucfirst($product->relProduct->title)}}">
                                {{ucfirst($product->relProduct->title)}}
                            </a>
                        </div>
                        <div class="item-content">
                            <div class="rating">
                                <div class="ratings">
                                    <div class="rating-box">
                                        <div class="rating" style="width:80%"></div>
                                    </div>
                                    <p class="rating-links"><a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                            </div>
                            <div class="item-price">
                                <div class="price-box"><span class="regular-price"><span class="price">₹ {{$product->relProduct->sale_price}}</span> </span> </div>
                            </div>
                            <div class="add_cart">
                                <input type="hidden" class="product_id" value="{{$product->pro_id}}">
                                <input type="hidden" id="quantity{{$product->pro_id}}" class="qty-input form-control" value="1" min="1">
                                <button type="submit" class="button btn-cart icon" onclick="addCart({{$product['pro_id']}})"><span>Add to Cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- End Item -->
    </div>
</div>
</div>
</section>--}}


{{--@if(count($blogs)!=0)
<!-- Home Lastest Blog Block -->
<div class="latest-blog wow bounceInUp animated animated container">
    <!--exclude For version 6 -->
    <div class="new_title">
        <h2>Latest Blog</h2>
    </div>
    <!--blog-title-->
    <!--For version 1,2,3,4,5,6,8 -->

    @foreach($blogs as $blog)
    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4 blog-post">
        <div class="blog_inner">
            <div class="blog-img">
                <a href="blog-detail.html">
                    <img src="{{URL::to('/')}}/public/images/blogs/{{$blog->image_url}}" alt="{{$blog->title}}" style="height: 100%; width: 100%;">
</a>
<div class="mask"> <a class="info" href="blog-detail.html">Read More</a> </div>
</div>
<!--blog-img-->
<div class="blog-info">
    <div class="post-date">
        <time class="entry-date" datetime="2015-05-11T11:07:27+00:00">{{date('d', strtotime($blog['created_at']))}} <br> {{date('M', strtotime($blog['created_at']))}}</time>
    </div>
    <h3><a href="blog-detail.html">@if(strlen($blog->title)>30) {{substr($blog->title, 0,30)}}... @else {{$blog->title}} @endif</a></h3>
    <p>{!!substr($blog->description,0,150)!!}</p>
    <a class="readmore" href="blog-detail.html">Read More</a>
</div>
</div>
<!--blog_inner-->
</div>
@endforeach
</div>
@endif--}}

<!-- Logo Brand Block -->
<div class="brand-logo wow bounceInUp animated">
    <div class="container">
        <div class="row">
            {{--<div class="logo-brand col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="new_title">
                        <h2>Brand Logo</h2>
                    </div>
                    <div class="slider-items-products">
                        <div id="brand-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col6">
                                <!-- Item -->
                                <div class="item">
                                    <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a>
        </div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->
    <!-- Item -->
    <div class="item">
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->
    <!-- Item -->
    <div class="item">
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->
    <!-- Item -->
    <div class="item">
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->
    <!-- Item -->
    <div class="item">
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->
    <!-- Item -->
    <div class="item">
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
        <div class="logo-item"><a href="#"><img src="{{URL::to('/')}}/templates/front/images/brand-logo.jpg" alt="Image"></a></div>
    </div>
    <!-- End Item -->

</div>
</div>
</div>
</div>--}}
<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 testimonials-section">
    <div class="offer-slider parallax parallax-2">
        <ul class="bxslider">
            @foreach($google_reviews as $review)
            <li>
                <div class="testimonials">
                    <h5 style="font-style: italic;">{{$review->comment}}</h5>
                </div>
                <div class="testimonials">
                    <h2>{{$review->customer_name}}</h2>
                </div>
            </li>
            @endforeach

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
                            @foreach($videos as $row)
                            <div class="item">
                                <div class="logo-item" style="height: 250px; ">
                                    <video style="height: 250px; width:380px;" controls>
                                        <source src="{{URL::to('public/videos')}}/{{$row->video_url}}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            @endforeach

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
            <img src="{{URL::to('/')}}/templates/front/images/close-icon.png" alt="close" class="x" onClick="HideMe();">
            <!-- <div class="newsletter_img">
                    <img alt="newsletter" src="{{URL::to('/')}}/templates/front/images/newsletter_img.png">
                </div> -->
            <h3>Contact Us</h3>
            <h4>Contact us for more informations.</h4>

            @if($message=Session::get('success'))
            <p class="alert alert-success">{{ $message }}</p>
            @endif<br>
            <div class="newsletter-form">
                <form method="post" action="{{route('contact-form-create-action')}}" name="popup-newsletter" class="email-form">
                    @csrf
                    <div class="input-box">
                        <input type="text" name="name" placeholder="Enter your name" class="form-control" value="{{old('name')}}" required><br>
                        <input type="text" name="email" placeholder="Enter your email address" class="form-control" value="{{old('email')}}" required><br>
                        <input type="text" name="contact" placeholder="Enter your contact number" class="form-control" value="{{old('contact')}}" required>
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

@endsection