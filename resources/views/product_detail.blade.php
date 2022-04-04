@extends('layouts.front')
@section('content')

<div class="page-heading" style="background-image: url(/sweet/public/images/categories/{{$product_detail->relChildCategory->image_url2}});">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home"> <a href="{{route('index')}}" title="Go to Home Page">Home</a> <span>—› </span> </li>
                        @if(!empty($product_detail->relCategory->title))
                        <li class="category1599">
                            <a href="{{route('product-cat',$product_detail->relCategory->slug)}}" title="">
                                {{$product_detail->relCategory->title}}
                            </a>
                        </li>
                        @endif
                        <span>—› </span> </li>
                        @if(!empty($product_detail->relChildCategory->title))
                        <li class="category1599">
                            <a href="{{route('product-cat',$product_detail->relChildCategory->slug)}}" title="">
                                {{$product_detail->relChildCategory->title}}
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-title">
        <h2>{{$product_detail->relChildCategory->title}}</h2>
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
                @if($product_detail->cat_id==1)
                <div class="product-essential container">
                    <div class="row">
                        <form action="" method="post" id="product_addtocart_form">
                            <div class="product-img-box col-sm-6 col-xs-12">
                                <div class="product-image">
                                    <div class="large-image">
                                        <a href="{{URL::to('/')}}/public/images/products/{{$product_detail->relProduct->image_url1}}" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
                                            @if(!empty($product_detail->relProduct->image_url1))
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product_detail->relProduct->image_url1}}" style="height:100%; width:100%;">
                                            @else
                                            <img src="{{URL::to('/')}}/public/assets/img/no_image.jpg" style="height:100%; width:100%;">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-shop col-sm-6 col-xs-12">
                                <div class="product-name">
                                    <h1 itemprop="name">{{ucfirst($product_detail->relProduct->title)}}</h1>
                                </div>
                                <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                    <div class="rating">
                                        <div class="ratings" style="color: #696969 !important;">
                                            @for($i=1; $i<=5; $i++) @if($i<=$product_detail->relProduct->avg_rating)
                                                <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                @else
                                                <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                @endif
                                                @endfor
                                        </div>
                                    </div>
                                </span>
                                <div class="price-block">
                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-123">
                                            <span class="price">₹{{$product_detail->sale_price}}</span>
                                        </span>
                                    </div>
                                    @if($product_detail->quantity > 0)
                                    <p class="availability in-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>In stock</span>
                                    </p>
                                    @else
                                    <p class="availability out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>Out of stock</span>
                                    </p>
                                    @endif
                                </div>

                                <!--price-block-->
                                <div class="short-description">
                                    <h2>Description</h2>
                                    <!-- <h2>Quick Overview</h2> -->
                                    {!!$product_detail->short_description!!}
                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <input type="number" id="quantityId" class="input-text qty" value="1" min="1" max="{{$product_detail->quantity}}" style="width: 100px;">
                                                <select id="varient_id" onchange="changeWeight(this.selectedIndex)" class="input-text qty" style="width: 100px;">
                                                    @foreach($product_varient_detail as $row)
                                                    <option value="{{$row->id}}">{{$row->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        @if(Auth::check())
                                        <button type="button" title="Add to Cart" class="button btn-cart" onclick="addCart()">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        @else
                                        <button type="button" title="Add to Cart" class="button btn-cart" data-toggle="modal" data-target="#loginModal">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        @endif
                                    </div>
                                    <div class="email-addto-box">
                                    </div>
                                </div>
                                <div class="social">
                                    <ul class="link">
                                        <li class="fb"> <a href="{{get_setting('facebook_url')}}" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="linkedin"> <a href="{{get_setting('linkedin_url')}}" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="instagram"> <a href="{{get_setting('instagram_url')}}" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                        <li class="pintrest"> <a href="{{get_setting('pinterest_url')}}" rel="nofollow" target="_blank" style="text-decoration:none;"> </a> </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="{{ route('shop') }}" class="button btn-continue" title="Continue Shopping" style="background-color:#88be4c"><span><span>Continue Shopping</span></span></a>
                        </form>
                    </div>
                </div>
                @else
                <div class="product-essential container">
                    <div class="row">
                        <form action="" method="post" id="product_addtocart_form">
                            <div class="product-img-box col-sm-6 col-xs-12">
                                <div class="product-image">
                                    <div class="large-image">
                                        <a href="{{URL::to('/')}}/public/images/products/{{$product_detail->relProduct->image_url1}}" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
                                            @if(!empty($product_detail->relProduct->image_url1))
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product_detail->relProduct->image_url1}}" style="height:100%; width:100%;">
                                            @else
                                            <img src="{{URL::to('/')}}/public/assets/img/no_image.jpg" style="height:100%; width:100%;">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-shop col-sm-6 col-xs-12">
                                <div class="product-name">
                                    <h1 itemprop="name">{{ucfirst($product_detail->relProduct->title)}}</h1>
                                </div>
                                <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                    <div class="rating">
                                        <div class="ratings" style="color: #696969 !important;">
                                            @for($i=1; $i<=5; $i++) @if($i<=$product_detail->relProduct->avg_rating)
                                                <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                @else
                                                <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                @endif
                                                @endfor
                                        </div>
                                    </div>
                                </span>
                                <div class="price-block">
                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-123">
                                            <span class="price">₹{{$product_detail->sale_price}}</span>
                                        </span>
                                    </div>
                                    @if($product_detail->quantity > 0)
                                    <p class="availability in-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>In stock</span>
                                    </p>
                                    @else
                                    <p class="availability out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <span>Out of stock</span>
                                    </p>
                                    @endif
                                </div>

                                <!--price-block-->
                                <div class="short-description">
                                    <h2>Description</h2>
                                    <!-- <h2>Quick Overview</h2> -->
                                    {!!$product_detail->short_description!!}
                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <input type="hidden" id="varient_id" value="{{$product_detail->id}}">
                                                <input type="number" id="quantityId" class="input-text qty" value="1" min="1" max="{{$product_detail->quantity}}" style="width: 100px;">
                                            </div>
                                        </div>


                                        @if(Auth::check())
                                        <button type="button" title="Add to Cart" class="button btn-cart" onclick="addCart({{$product_detail->id}})">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        @else
                                        <button type="button" title="Add to Cart" class="button btn-cart" data-toggle="modal" data-target="#loginModal">
                                            <span><i class="icon-basket"></i>Add to Cart</span>
                                        </button>
                                        @endif
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
                            <a href="{{ route('shop') }}" class="button btn-continue" title="Continue Shopping" style="background-color:#88be4c"><span><span>Continue Shopping</span></span></a>
                        </form>
                    </div>
                </div>
                @endif
                <!--product-essential-->
                <div class="product-collateral container">
                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                        <li class="active"> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                        <li> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                    </ul>
                    <div id="productTabContent" class="tab-content">
                        <div class="tab-pane fade" id="product_tabs_description">
                            <div class="std">
                                {!!$product_detail->short_description!!}
                            </div>
                        </div>
                        {{--<div class="tab-pane fade" id="product_tabs_tags">
                            <div class="box-collateral box-tags">
                                <div class="tags">
                                    <form id="addTagForm" action="#" method="get">
                                        <div class="form-add-tags">
                                            <label for="productTagName">Add Tags:</label>
                                            <div class="input-box">
                                                <input class="input-text" name="productTagName" id="productTagName" type="text">
                                                <button type="button" title="Add Tags" class=" button btn-add" onClick="submitTagForm()"> <span>Add Tags</span> </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--tags-->
                                <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                            </div>
                        </div>--}}
                        <div class="tab-pane fade in active" id="reviews_tabs">
                            <div class="box-collateral box-reviews" id="customer-reviews">
                                <div class="box-reviews2">
                                    <h3>Customer Reviews</h3>
                                    <div class="box visible">
                                        <ul>
                                            @foreach($reviews as $review)
                                            <li>
                                                <table class="ratings-table">
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="rating-box">
                                                                    <!--<div class="rating" style="width:100%;"></div>-->
                                                                     @for($i=1; $i<=5; $i++) @if($i<=$review->avg_rating)
                                                                    <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                                    @else
                                                                    <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                                    @endif
                                                                    @endfor
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="review">
                                                    <!--<h6><a href="#">Excellent</a></h6>-->
                                                    <small>Review by <span>{{$review->relReview->customer_name}} </span>on {{$review->relReview->created_at->format('Y-m-d')}} </small>
                                                    <div class="review-txt"> {{$review->relReview->comment}} </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="actions"> 
                                    {{ $reviews->links() }}
                                        <!--<a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> -->
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                    </div>
                </div>


                <!--product-collateral-->

                @if(count($related_products)!=0)
                <div class="box-additional">
                    <!-- BEGIN RELATED PRODUCTS -->
                    <div class="related-pro container">
                        <div class="slider-items-products">
                            <div class="new_title center">
                                <h2>Related Products</h2>
                            </div>
                            <div id="related-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4 products-grid">
                                    @foreach($related_products as $related_product)
                                    @if(!empty($related_product->relProductVarient->slug) && $related_product->status=='show')
                                    <div class="item">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info">
                                                    <a href="{{route('product-detail', $related_product->relProductVarient->slug)}}" title="{{ucfirst($related_product->title)}}" class="product-image">
                                                        <img src="{{URL::to('/')}}/public/images/products/{{$related_product->image_url1}}" alt="{{ucfirst($related_product->title)}}" style="height: 100%; width:100%;">

                                                        <div class="item-box-hover">
                                                            <div class="box-inner">
                                                                {{--<div class="product-detail-bnt">
                                                                @if(Auth::check())
                                                                <input type="hidden" class="product_id" value="{{$related_product->relProductVarient->id}}">
                                                                <input type="hidden" id="quantity{{$related_product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                                                <a class="button detail-bnt" type="button" onclick="addCart({{$related_product->relProductVarient->id}})" title="Add To Cart"><span>Quick View</span></a>
                                                                @else
                                                                <a class="button detail-bnt" type="button" data-toggle="modal" data-target="#loginModal" title="Add To Cart"><span>Quick View</span></a>
                                                                @endif
                                                            </div>--}}

                                                        </div>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="info-inner">
                                                <div class="item-title">
                                                    <a href="{{route('product-detail', $related_product->relProductVarient->slug)}}" title="{{ucfirst($related_product->title)}}">
                                                        <b>{{ucfirst($related_product->title)}}</b>
                                                    </a>
                                                </div>
                                                <div class="item-content">
                                                    <div class="rating">
                                                        <div class="rating">
                                                            <div class="ratings" style="color: #696969 !important;">
                                                                @for($i=1; $i<=5; $i++) @if($i<=$related_product->avg_rating)
                                                                    <i class="fa fa-star" aria-hidden="true" style="color: #ffff00 !important;"></i>
                                                                    @else
                                                                    <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                                                    @endif
                                                                    @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item-price">
                                                        <div class="price-box"><span class="regular-price" id="product-price-1">
                                                                <span class="price">₹{{$related_product->relProductVarient->sale_price}}</span> </span>
                                                        </div>
                                                    </div>
                                                    {{--<div class="add_cart">
                                                            @if(Auth::check())
                                                            <input type="hidden" class="product_id" value="{{$related_product->relProductVarient->id}}">
                                                    <input type="hidden" id="quantity{{$related_product->relProductVarient->id}}" class="qty-input form-control" value="1" min="1">
                                                    <button type="submit" class="button btn-cart icon" onclick="addCart({{$related_product->relProductVarient->id}})"><span>Add to Cart</span></button>
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
                            <!-- End Item -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end related product -->

        </div>
        @endif
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
            '_token': "{{csrf_token()}}",
            'varient_id': varient_id
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "{{ route('ajax-update-weight') }}",
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

@endsection