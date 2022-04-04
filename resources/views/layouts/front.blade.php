<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{get_setting('title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="{{get_setting('meta_description')}}">
    <meta name="keywords" content="{{get_setting('meta_description')}}">
    <meta name="robots" content="*">
    <link rel="icon" href="{{URL::to('/')}}/public/images/general_settings/{{get_setting('favicon')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{URL::to('/')}}/public/images/general_settings/{{get_setting('favicon')}}" type="image/x-icon">

    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/font-awesome.css" media="all">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/revslider.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/jquery.mobile-menu.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/front/stylesheet/responsive.css" media="all">

    <link rel="stylesheet" href="{{URL::to('/')}}/templates/front1/assets/css/font-awesome.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">

    <!--Alertify CSS -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/assets/css/alertify.min.css" />

    <!-- autosearch -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/jquery.min.js"></script> -->

    <script src="{{URL::to('/')}}/templates/front/js/jquery-1.11.1.min.js"></script>

</head>

<body>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" style="margin-top:110px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required autofocus>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember_me">
                                    <label class="form-chek-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-link">Login</button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
                <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
            </div>
        </div>
    </div>



    <div id="page">
        <header>
            <div class="header-banner">
                <div class="assetBlock">
                    <div style="height: 20px; overflow: hidden; margin-right:15px;" id="slideshow">
                        @guest
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="float:right;"><span>Register</span></a>
                        @endif
                        <a href="{{ route('login') }}" style="float:right;"><span>Login</span> &nbsp; &nbsp; &nbsp;</a>
                        @else
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="float:right;">
                            <span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @if(Auth::user()->user_type=='user')
                        <a href="{{route('front-user-account')}}" style="float:right;"><span>My Account ({{Auth::user()->name}})</span>&nbsp; &nbsp; &nbsp; </a>
                        </li>
                        @endif
                        @endguest
                    </div>
                </div>
            </div>
            <div id="header" style="background-color: #D3D3D3;">
                <div class="header-container container">
                    <div class="row">
                        <div class="logo">
                            <a href="{{route('index')}}" title="{{get_setting('title')}}">
                                <div>
                                    <img src="{{URL::to('/')}}/public/images/general_settings/{{get_setting('logo')}}" alt="{{get_setting('title')}}" style="height: 94px; width:172px;">
                                </div>
                            </a>
                        </div>

                        <div class="whatsapp_float" style="position: fixed; bottom:120px; right:20px;">
                            <div class="social1">
                                <a href="https://wa.me/91{{get_setting('whatsapp_no')}}" target="_blank">
                                <div class="whatsapp pull-left">
                                    <img src="{{URL::to('/')}}/public/assets/img/whatsapp-icon.png">
                                    <!--<a href="https://wa.me/91{{get_setting('whatsapp_no')}}" title="Whatsapp" target="_blank" rel="nofollow"></a>-->
                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="fl-nav-menu">

                            <nav>
                                <div class="mm-toggle-wrap">
                                    <div class="mm-toggle"><i class="icon-align-justify"></i><span class="mm-label">Menu</span> </div>
                                </div>
                                <div class="nav-inner">
                                    <!-- BEGIN NAV -->
                                    <ul id="nav" class="hidden-xs">
                                        <!-- <li id="nav-home" class="level0 parent drop-menu"><a class="level-top active" href="{{--route('index')--}}"><span>Home</span></a></li> -->
                                        <li id="nav-home" class="mega-menu"><a class="level-top" href="{{route('shop')}}"><span>All</span></a></li>
                                        @foreach(get_categories() as $cat)
                                        @if(count(get_child_categories($cat->id))!=0)
                                        <li class="mega-menu"> <a class="level-top" href="#"><span>{{ucfirst($cat->title)}}</span></a>
                                            <div class="level0-wrapper dropdown-6col" style="left: 0px; display: none;">
                                                <div class="container">
                                                    <div class="level0-wrapper2">
                                                        <div class="nav-block nav-block-center">
                                                            <!--mega menu-->

                                                            <ul class="level0">
                                                                <li class="level3 nav-6-1 parent item">
                                                                    <ul class="level0">
                                                                        @if(!empty(get_brands()[$cat->id]))
                                                                        @foreach(get_brands()[$cat->id] as $vendor_id=>$brand)
                                                                        <li class="level3 nav-6-1 parent item">
                                                                            <a href="{{route('product-brand')}}/{{$cat->id}}/{{$vendor_id}}"><span>{{$brand}}</span></a>
                                                                        </li>
                                                                        @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                                <!--level3 nav-6-1 parent item-->
                                                            </ul>
                                                            <!--level0-->
                                                        </div>
                                                        <!--nav-block nav-block-center-->
                                                    </div>
                                                    <!--level0-wrapper2-->
                                                </div>
                                                <!--container-->
                                            </div>
                                            <!--level0-wrapper dropdown-6col-->
                                            <!--mega menu-->
                                        </li>


                                        @else
                                        <li class="mega-menu">
                                            <a class="level-top" href="{{route('product-cat',$cat->slug)}}"><span>{{ucfirst($cat->title)}}</span></a>
                                        </li>
                                        @endif
                                        @endforeach

                                        <!-- {{--<li class="mega-menu"> <a class="level-top" href="#"><span>Multi Brands</span></a>
                                            <div class="level0-wrapper dropdown-6col" style="left: 0px; display: none;">
                                                <div class="container">
                                                    <div class="level0-wrapper2">
                                                        <div class="nav-block nav-block-center">
                                                            <ul class="level0">
                                                                @foreach(get_multi_brands() as $multi_brand)
                                                                @if(!empty($multi_brand['rel_product']))
                                                                <li class="level3 nav-6-1 parent item">
                                                                    <a href="{{route('product-multi-brand',$multi_brand['id'])}}">
                                                                        <span>{{$multi_brand['brand_name']}}</span>
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>--}} -->

                                        <li class="mega-menu">
                                            <a class="level-top" href="#"><span>Return Gifts</span></a>
                                        </li>
                                        <li class="mega-menu">
                                            <a class="level-top" href="#"><span>Books</span></a>
                                        </li>
                                        <li class="mega-menu">
                                            <a class="level-top" href="#"><span>Home Decor</span></a>
                                        </li>
                                    </ul>
                                    <!--nav-->
                                </div>
                            </nav>
                        </div>
                        <!--row-->
                    </div>
                    <div class="fl-header-right">
                        <div class="fl-links">
                            <div class="no-js"> <a title="Company" class="clicker"></a>
                                <div class="fl-nav-links">
                                    <!-- <div class="language-currency"> -->
                                    <!-- <div class="fl-language">
                                            <ul class="lang">
                                                <li><a href="#"> <img src="{{URL::to('/')}}/templates/front/images/english.png" alt="English"> <span>English</span> </a></li>
                                                <li><a href="#"> <img src="{{URL::to('/')}}/templates/front/images/francais.png" alt="French"> <span>French</span> </a></li>
                                                <li><a href="#"> <img src="{{URL::to('/')}}/templates/front/images/german.png" alt="German"> <span>German</span> </a></li>
                                            </ul>
                                        </div> -->
                                    <!--fl-language-->
                                    <!-- END For version 1,2,3,4,6 -->
                                    <!-- For version 1,2,3,4,6 -->
                                    <!-- <div class="fl-currency">
                                            <ul class="currencies_list">
                                                <li><a href="#" title="EGP"> £</a></li>
                                                <li><a href="#" title="EUR"> €</a></li>
                                                <li><a href="#" title="USD"> $</a></li>
                                            </ul>
                                        </div> -->
                                    <!--fl-currency-->
                                    <!-- END For version 1,2,3,4,6 -->
                                    <!-- </div> -->
                                    <ul class="links">

                                        <li><a href="#" title="About Us">About Us</a></li>
                                        <li><a href="#" title="Contact Us">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="fl-cart-contain">
                            <div class="mini-cart">
                                <div class="basket"> <a href="{{route('cart')}}" class="basket-item-count"><span> 0 </span></a> </div>
                                {{--<div class="fl-mini-cart-content" style="display: none;">
                                    <div class="block-subtitle">
                                        <div class="top-subtotal">2 items, <span class="price">$259.99</span> </div>
                                        <!--top-subtotal-->
                                        <!--pull-right-->
                                    </div>
                                    <!--block-subtitle-->
                                    <ul class="mini-products-list" id="cart-sidebar">
                                        <li class="item first">
                                            <div class="item-inner"><a class="product-image" title="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" href="#l"><img alt="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" src="{{URL::to('/')}}/templates/front/images/product-img.jpg"></a>
                                <div class="product-details">
                                    <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                                    <!--access-->
                                    <strong>1</strong> x <span class="price">$179.99</span>
                                    <p class="product-name"><a href="product-detail.html">timi &amp; leslie Sophia Diaper Bag...</a></p>
                                </div>
                            </div>
                            </li>
                            <li class="item last">
                                <div class="item-inner"><a class="product-image" title="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" href="#"><img alt="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" src="{{URL::to('/')}}/templates/front/images/product-img.jpg"></a>
                                    <div class="product-details">
                                        <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                                        <!--access-->
                                        <strong>1</strong> x <span class="price">$80.00</span>
                                        <p class="product-name"><a href="product-detail.html">JP Lizzy Satchel Designer Diaper Ba...</a></p>
                                    </div>
                                </div>
                            </li>
                            </ul>
                            <div class="actions">
                                <button class="btn-checkout" title="Checkout" type="button" onClick="window.location=checkout.html"><span>Checkout</span></button>
                            </div>
                            <!--actions-->
                        </div>--}}
                        <!--fl-mini-cart-content-->
                    </div>
                </div>
                <!--mini-cart-->
                <div class="collapse navbar-collapse">
                    <form class="navbar-form" role="search" id="search-form" action="{{route('searching')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_product" id="search_text" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" name="searchbtn" class="search-btn">
                                    <span class="glyphicon glyphicon-search">
                                        <span class="sr-only">Search</span>
                                    </span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <!--links-->
            </div>
    </div>
    </div>
    </header>


    @yield('content')


    <footer>
        <!-- BEGIN INFORMATIVE FOOTER -->
        <div class="footer-inner">
            <div class="newsletter-row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col">
                            <!-- Footer Payment Link -->
                            <div class="payment-accept">
                                <div>
                                    <!-- <img src="{{URL::to('/')}}/templates/front/images/payment-1.png" alt="payment1"> -->
                                    <img src="{{URL::to('/')}}/templates/front/images/payment-2.png" alt="payment2">
                                    <!-- <img src="{{URL::to('/')}}/templates/front/images/payment-3.png" alt="payment3"> -->
                                    <img src="{{URL::to('/')}}/templates/front/images/payment-4.png" alt="payment4">
                                </div>
                            </div>
                        </div>
                        <!-- Footer Newsletter -->
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col1">
                            <div class="newsletter-wrap">
                                <h4>Sign up for emails</h4>
                                
                                @if($message=Session::get('success'))
                                <p class="alert alert-success">{{ $message }}</p>
                                @endif<br>
                                
                                <form method="post" action="{{route('email-subscriber-create-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                <div id="container_form_news">
                                    <div id="container_form_news2">
                                        <input type="text" name="email" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" value="{{old('email')}}">
                                        <button type="submit" title="Subscribe" class="button subscribe"><span>Subscribe</span></button>
                                    </div>
                                    <!--container_form_news2-->
                                </div>
                                <!--container_form_news-->
                                 </form> 

                            </div>
                            <!--newsletter-wrap-->
                        </div>

                    </div>
                </div>
                <!--footer-column-last-->
            </div>
            <div class="">
                <div class="row">
                    <div class="col-sm-4 col-xs-12 col-lg-4">
                        <div class="co-info">
                            <div><a href="{{route('index')}}"><img src="{{URL::to('/')}}/public/images/general_settings/{{get_setting('logo')}}" alt="footer logo" style="height: 94px; width:172px;"></a></div>
                            <address>
                                <div><em class="icon-location-arrow"></em> <span><b>{{get_setting('address')}}</b></span></div>
                                <div> <em class="icon-mobile-phone"></em><span><b> Phone: + {{get_setting('phone')}} @if(!empty(get_setting('fax'))) / Fax: + {{get_setting('fax')}} @endif</b></span></div>
                                <div> <em class="icon-envelope"></em><span><b>{{get_setting('email')}}</b></span></div>
                            </address>
                            <div class="social">
                                <ul class="link">
                                    <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{get_setting('facebook_url')}}" title="Facebook"></a></li>
                                    <!-- <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li> -->
                                    <!-- <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li> -->
                                    <!-- <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li> -->
                                    <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="{{get_setting('pinterest_url')}}" title="PInterest"></a></li>
                                    <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{get_setting('linkedin_url')}}" title="Linkedin"></a></li>
                                    <li class="instagram pull-left"><a target="_blank" rel="nofollow" href="{{get_setting('instagram_url')}}" title="Instagram"></a></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8 col-xs-12 col-lg-8">
                        <div class="footer-column" style="margin-top:0px;">

                            <h4><b><a title="Your Account" href="#">Your Account</a></b></h4>
                            <h4><b><a title="History" href="#">About Us</a></b></h4>
                            <h4><b><a title="History" href="#">Contact Us</a></b></h4>
                            <h4><b><a title="History" href="#">Cancellation Policy </a></b></h4><br>
                            <!-- <h4>Quick Links</h4>
                                <ul class="links">
                                    <li class="first"><a title="How to buy" href="/blog/">Blog</a></li>
                                    <li><a title="FAQs" href="#">FAQs</a></li>
                                    <li><a title="Payment" href="#">Payment</a></li>
                                    <li><a title="Shipment" href="#">Shipment</a></li>
                                    <li><a title="Where is my order?" href="#">Where is my order?</a></li>
                                    <li class="last"><a title="Return policy" href="#">Return policy</a></li>
                                </ul> -->
                        </div>
                        <!-- <div class="footer-column">
                                <h4>Style Advisor</h4>
                                <ul class="links">
                                    <li class="first"><a title="Your Account" href="#">Your Account</a></li>
                                    <li><a title="Information" href="#">Information</a></li>
                                    <li><a title="Addresses" href="#">Addresses</a></li>
                                    <li><a title="Addresses" href="#">Discount</a></li>
                                    <li><a title="Orders History" href="#">Orders History</a></li>
                                    <li class="last"><a title=" Additional Information" href="#"> Additional Information</a></li>
                                </ul>
                            </div>
                            <div class="footer-column">
                                <h4>Information</h4>
                                <ul class="links">
                                    <li class="first"><a title="Site Map" href="#">Site Map</a></li>
                                    <li><a title="Search Terms" href="#">Search Terms</a></li>
                                    <li><a title="Advanced Search" href="#">Advanced Search</a></li>
                                    <li><a title="History" href="#">About Us</a></li>
                                    <li><a title="History" href="#">Contact Us</a></li>
                                    <li><a title="Suppliers" href="#">Suppliers</a></li>
                                </ul>
                            </div> -->

                        <div class="footer-column">

                            <img src="{{URL::to('/')}}/public/assets/img/eco-friendly-seal-green.png" alt="">
                        </div>
                        <!-- <div class="footer-column">
                            <h4>Style Advisor</h4>
                            <ul class="links">
                                <li class="first"><a title="Your Account" href="#">Your Account</a></li>
                                <li><a title="Information" href="#">Information</a></li>
                                <li><a title="Addresses" href="#">Addresses</a></li>
                                <li><a title="Addresses" href="#">Discount</a></li>
                                <li><a title="Orders History" href="#">Orders History</a></li>
                                <li class="last"><a title=" Additional Information" href="#"> Additional Information</a></li>
                            </ul>
                        </div> -->


                    </div>

                    <!-- col-sm-12 col-xs-12 col-lg-8 -->
                    <!--col-xs-12 col-lg-4-->
                </div>
                <!--row-->

            </div>

            <!--container-->
        </div>
        <!--footer-inner-->

        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="row"> </div>
                </div>
                <!--row-->
            </div>
            <!--container-->
        </div>
        <!--footer-middle-->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <!--<div class="col-sm-12 col-xs-12 coppyright">© 2015 Flavours. All Rights Reserved.</div>-->

                </div>
                <!--row-->
            </div>
            <!--container-->
        </div>
        <!--footer-bottom-->
        <!-- BEGIN SIMPLE FOOTER -->
    </footer>
    <!-- End For version 1,2,3,4,6 -->

    </div>
    <!--page-->
    <!-- Mobile Menu-->
    <div id="mobile-menu">

        <ul>
            <li>
                <div class="home"><a href="#"><i class="icon-home"></i>Home</a> </div>
            </li>
            <li><a href="{{route('shop')}}">All</a></li>

            @foreach(get_categories() as $cat)
            @if(count(get_child_categories($cat->id))!=0)
            <li><a href="#">{{ucfirst($cat->title)}}</a>
                <ul>
                    @if(!empty(get_brands()[$cat->id]))
                    @foreach(get_brands()[$cat->id] as $vendor_id=>$brand)
                    <li><a href="{{route('product-brand')}}/{{$cat->id}}/{{$vendor_id}}"><span>{{$brand}}</span></a></li>
                    @endforeach
                    @endif
                </ul>
            </li>
            @else
            <li><a href="{{route('product-cat',$cat->slug)}}">{{ucfirst($cat->title)}}</a></li>
            @endif
            @endforeach

            <li><a href="#">Brand 2</a></li>
        </ul>
    </div>



    <!-- JavaScript -->
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/parallax.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/revslider.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/common.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/templates/front/js/jquery.mobile-menu.min.js"></script>

    <!-- autosearch -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{URL::to('/')}}/public/assets/js/sweetalert.min.js"></script>
    <!--Alertify JavaScript -->
    <script src="{{URL::to('/')}}/public/assets/js/alertify.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#thm-rev-slider').show().revolution({
                dottedOverlay: 'none',
                delay: 5000,
                startwidth: 0,
                startheight: 900,

                hideThumbs: 200,
                thumbWidth: 200,
                thumbHeight: 50,
                thumbAmount: 2,

                navigationType: 'thumb',
                navigationArrows: 'solo',
                navigationStyle: 'round',

                touchenabled: 'on',
                onHoverStop: 'on',

                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,

                spinner: 'spinner0',
                keyboardNavigation: 'off',

                navigationHAlign: 'center',
                navigationVAlign: 'bottom',
                navigationHOffset: 0,
                navigationVOffset: 20,

                soloArrowLeftHalign: 'left',
                soloArrowLeftValign: 'center',
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,

                soloArrowRightHalign: 'right',
                soloArrowRightValign: 'center',
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,

                shadow: 0,
                fullWidth: 'on',
                fullScreen: 'on',

                stopLoop: 'off',
                stopAfterLoops: -1,
                stopAtSlide: -1,

                shuffle: 'off',

                autoHeight: 'on',
                forceFullWidth: 'off',
                fullScreenAlignForce: 'off',
                minFullScreenHeight: 0,
                hideNavDelayOnMobile: 1500,

                hideThumbsOnMobile: 'off',
                hideBulletsOnMobile: 'off',
                hideArrowsOnMobile: 'off',
                hideThumbsUnderResolution: 0,

                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0,
                fullScreenOffsetContainer: ''
            });
        });
    </script>
    <script type="text/javascript">
        function HideMe() {
            jQuery('.popup1').hide();
            jQuery('#fade').hide();
        }
    </script>


    <script>
        $(document).ready(function() {
            var path = "{{route('autosearch')}}";
            $('#search_text').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path,
                        dataType: "JSON",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);

                            // var keyVar;
                            // for (keyVar in data) {
                            //     if (data.hasOwnProperty(keyVar)) {
                            //         response(data[keyVar]);
                            //     }
                            // }
                        }
                    });
                },
                minLength: 1,
            });
            $(document).on('click', '.ui-menu-item', function() {
                $('#search-form').submit();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            cartload();
        });

        function cartload() {
            var _token = "{{csrf_token()}}";

            $.ajax({
                url: "{{ route('ajax-load-cart-data') }}",
                method: "GET",
                success: function(response) {
                    $('.basket-item-count').html('');
                    var parsed = jQuery.parseJSON(response)
                    var value = parsed; //Single Data Viewing
                    // $('.basket-item-count').append($('<span class="count">' + value['totalcart'] + '</span>'));
                    $('.basket-item-count').append($('<span>' + value['totalcart'] + '</span>'));
                }
            });
        }


        function addCart(id) {
            var _token = "{{csrf_token()}}";
            var quantity = document.getElementById('quantityId').value;
            var id = document.getElementById('varient_id').value;
            var qs = {
                id: id,
                quantity: quantity,
                _token: _token
            };
            //  alert(JSON.stringify(qs));
            $.ajax({
                url: "{{ route('ajax-add-to-cart') }}",
                method: "POST",
                data: qs,
                success: function(response) {
                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success(response.status);
                    cartload();
                },
                error: function(request, status, error) {
                    console.log('Error is' + request.responseText);
                }
            });
        }


        function updateQuantity(id) {
            // alert(id);
            var _token = "{{csrf_token()}}";

            var quantity = document.getElementById('quantity' + id).value;
            var price = document.getElementById('salePrice' + id).value;
            //var varient_id = document.getElementById('varient_id' + id).value;
            //alert(price);
            var qs = {
                id: id,
                quantity: quantity,
                _token: _token
            };
            // alert(JSON.stringify(qs));
            $.ajax({
                url: "{{ route('ajax-update-cart') }}",
                method: "POST",
                data: qs,
                success: function(result) {
                    //   alert(JSON.stringify(result));
                    if (result.weight == "") {
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success(result.status);

                        document.getElementById('amount' + id).innerHTML = '₹' + quantity * result.price;
                        $('#total').load(location.href + ' #total');

                        document.getElementById('amount' + id).innerHTML = '₹' + quantity * result.price;
                        $('#total_price').load(location.href + ' #total_price');
                    } else {
                        if (result.weight == '250gm') {
                            var sub_weight = 250;
                        }
                        if (result.weight == '500gm') {
                            var sub_weight = 500;
                        }
                        if (result.weight == '1kg') {
                            var sub_weight = 1000;
                        }
                        if (result.weight == '') {
                            var sub_weight = 0;
                        }
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success(result.status);

                        document.getElementById('amount' + id).innerHTML = '₹' + quantity * result.price;
                        $('#total').load(location.href + ' #total');
                        $('#total_price').load(location.href + ' #total_price');

                        document.getElementById('amount' + id).innerHTML = '₹' + quantity * result.price;
                        document.getElementById('sub_weight' + id).innerHTML = (quantity * sub_weight)/1000 + 'kg';
                        $('#total_price').load(location.href + ' #total_price');
                        $('#total_weight').load(location.href + ' #total_weight');
                        $('#session_weight').load(location.href + ' #session_weight');

                    }

                },
                error: function(request, status, error) {
                    console.log('Error is' + request.responseText);
                }
            });
        }


        function deleteCart(id) {
            // alert(id);
            var _token = "{{csrf_token()}}";
            var qs = {
                id: id,
                _token: _token
            };
            //  alert(JSON.stringify(qs));
            $.ajax({
                url: "{{ route('ajax-delete-cart') }}",
                method: "DELETE",
                data: qs,
                success: function(result) {
                    // alert(JSON.stringify(result));  
                    window.location.reload();
                    document.getElementById('cartpage').remove()
                    $('#total').load(location.href + ' #total');

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success(result.status);
                    
                },
                error: function(request, status, error) {
                    console.log('Error is' + request.responseText);
                }
            });
        }

        function clearCart(id) {
            // alert(id);
            var _token = "{{csrf_token()}}";
            var qs = {
                id: id,
                _token: _token
            };
            $.ajax({
                url: "{{ route('ajax-clear-cart') }}",
                type: 'GET',
                data: qs,
                success: function(response) {
                    // alert(JSON.stringify(response));
                    window.location.reload();
                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success(response.status);
                }
            });
        }
    </script>
    <script>
        $('.slider-range-price').each(function() {
            var min = $(this).data('min'),
                max = $(this).data('max');
            unit = $(this).data('unit'),
                value_min = $(this).data('value-min'),
                value_max = $(this).data('value-max'),
                label_result = $(this).data('label-result'),
                t = $(this);
            $(this).slider({
                range: true,
                min: min,
                max: max,
                values: [value_min, value_max],
                slide: function(event, ui) {
                    var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                    t.closest('.slider-range').find('.range-price').html(result);
                }
            });
        });
    </script>

</body>

</html>