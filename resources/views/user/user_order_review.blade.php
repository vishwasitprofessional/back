@extends('layouts.front')
@section('content')

<!-- ============================================== HEADER : END ============================================== -->
<div class="page-heading">
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
<section class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <!--col-main col-sm-9 wow bounceInUp animated-->
            <aside class="col-left sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="block block-account">
                    <div class="block-title"> My Account </div>
                    <div class="block-content">

                        <ul>
                            <li><a href="{{route('front-user-orders-show')}}"><span> My orders</span></a></li>
                            <li><a href="{{route('cart')}}"><span> My Cart</span></a></li>
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
                                <!--<div class="item active"><img src="{{URL::to('/')}}/public/assets/img/makrand_logo.jpg" alt="slide3" style="width:295px; height:350px;">-->
                                    <!-- <div class="carousel-caption">
                                        <h3><a title=" Sample Product" href="#">50% OFF</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <a class="link" href="#">Buy Now</a>
                                    </div> -->
                                <!--</div>-->
                            </div>
                            <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span>
                            </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar col-sm-3 wow bounceInUp animated-->


            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="col-md-12">

                    <div class="card">
                        <!-- /.card-header -->
                        <h4>Add Review For this product</h4>
                        @if(count($errors)>0)
                        <div class='alert alert-danger'>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if($message=Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif<br>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{URL::to('/')}}/public/images/products/{{$order_item->relProductVarient->relProduct->image_url1}}" alt="" height="100" width="100">
                                </div>
                                <div class="col-sm-6">
                                    <h2>{{$order_item->relProductVarient->relProduct->title}}-({{$order_item->relProductVarient->title}})</h2>
                                </div>
                            </div>
                        </div>
                        <form id="ratingForm" method="POST" action="{{route('user-add-review')}}">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order_item->order_id}}">
                            <div class="form-group">
                                <h4>Your Rating</h4>
                                <input type="hidden" name="order_item_id" value="{{$order_item->id}}">
                                <input class="fa fa-star-o" value="1" id="star-1" type="radio" name="rating" />
                                <label class="star star-1" for="star-1"></label>
                                <input class="fa fa-star-o" value="2" id="star-2" type="radio" name="rating" />
                                <label class="star star-2" for="star-2"></label>
                                <input class="fa fa-star-o" value="3" id="star-3" type="radio" name="rating" />
                                <label class="star star-3" for="star-3"></label>
                                <input class="fa fa-star-o" value="4" id="star-4" type="radio" name="rating" />
                                <label class="star star-4" for="star-4"></label>
                                <input class="fa fa-star-o" value="5" id="star-5" type="radio" name="rating" />
                                <label class="star star-5" for="star-5"></label>
                            </div>
                            <!-- <div class="form-group">
                                <label for="comment">Title*</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            </div> -->
                            <div class="form-group">
                                <label for="comment">Customer Name*</label>
                                <input type="text" name="customer_name" class="form-control" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Comment*</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-link" id="saveReview">Submit Review</button>
                                <button type="button" class="button button-link" id="cancelReview">Cancel</button>
                            </div>
                        </form>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>


            </section>
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
<!-- ============================================== HEADER : END ============================================== -->


@endsection