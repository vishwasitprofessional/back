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
                                <!-- <div class="item"><img src="{{URL::to('/')}}/templates/front/images/blog-banner.png" alt="slide1">
                                    <div class="carousel-caption">
                                        <h3><a title=" Sample Product" href="#">Hot collection</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                                <div class="item"><img src="{{URL::to('/')}}/templates/front/images/blog-banner.png" alt="slide2">
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


            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="col-md-12">

                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Order Details: <br><br>
                            <b>Order Id: </b>{{$order->id}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{route('user-generate-invoice', $order->id)}}" class="button btn-continue float-right py-1" style="background-color:#88be4c">Generate Invoice</a>
                        </h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Total Amount: </b>{{$order->total_amount}}</td>
                                        <td colspan='2'><b>Total Weight: </b>{{$order->weight}}Kg</td>
                                        <td colspan='2'><b>Date: </b>{{date('d-M-Y', strtotime($order['created_at']))}}</td>
                                        <td colspan='2'><b>Customer Name: </b>{{$order->relUser->name}}</td>
                                        <td colspan='2'><b>Contact No: </b>{{$order->relUser->contact}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Tracking No: </b>{{$order->tracking_no}}</td>
                                        <td colspan='2'><b>Payment Mode: </b>{{$order->payment_mode}}</td>
                                        <td colspan='2'><b>Payment Id: </b>{{$order->payment_id}}</td>
                                        <td colspan='2'><b>Cancel Reason: </b>{{$order->cancel_reason}}</td>
                                        <td colspan='2'><b>Payment Status: </b>{{$order->payment_status}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Order Status: </b>{{$order->order_status}}</td>
                                        <td colspan='2'><b>Delivery Charges: </b>{{$order->shipping_cost}}</td>
                                         <td colspan='2'><b>GST: </b>{{$order->total_gst}}</td> 
                                         <td colspan='2'><b>CGST: </b>{{$order->total_cgst}}</td> 
                                         <td colspan='2'><b>SGST: </b>{{$order->total_sgst}}</td> 
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Order Items Details</h4>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Brand</th>
                                        <th>Per Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Weight</th>
                                        <th>Total Amount</th>
                                        <th>Total Weight</th>
                                        <th>GST</th>
                                        <th>Review</th>
                                        <!-- <th>tax_amount</th>
                                        <th>discount</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_items as $row)
                                    <tr>
                                        <td>{{$row['order_id']}}</td>
                                        <td>{{$row->relProductVarient->relProduct->title}}</td>
                                        <td>{{$row->relVendor->brand_name}}</td>
                                        <td>{{$row['price']}}</td>
                                        <td>{{$row['quantity']}}</td>
                                        <td>{{$row->relProductVarient->title}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['weight']/1000}}Kg</td>
                                        <td>{{$row['gst']}}</td>
                                        @if($order->order_status == 'completed' && $row->rstatus == false)
                                        <td><a href="{{route('user-order-review',$row['id'])}}" class="button btn-continue" style="background-color:#88be4c">Write Review</a></td>
                                        @endif
                                        <!-- <td>{{--$row['tax_amount']--}}</td>
                                        <td>{{--$row['discount']--}}</td> -->
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Billing Address Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Customer Name: </b>{{$order->relUser->name}}</td>
                                        <td colspan='2'><b>Billing Name: </b>{{$order->relShippingAddress->b_name}}</td>
                                        <td colspan='2'><b>Contact: </b>{{$order->relShippingAddress->b_contact}}</td>
                                        <td colspan='2'><b>Pincode: </b>{{$order->relShippingAddress->b_pincode}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Locality: </b>{{$order->relShippingAddress->b_locality}}</td>
                                        <td colspan='2'><b>Address: </b>{{$order->relShippingAddress->b_address}}</td>
                                        <td colspan='2'><b>Landmark: </b>{{$order->relShippingAddress->b_landmark}}</td>
                                        <td colspan='2'><b>Alternate Contact no: </b>{{$order->relShippingAddress->b_contact2}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Country: </b>@if(!empty($order->relShippingAddress->relBCountry->name)) 
                                        {{$order->relShippingAddress->relBCountry->name}} @endif</td>
                                        <td colspan='2'><b>State: </b>@if(!empty($order->relShippingAddress->relBState->name)) 
                                        {{$order->relShippingAddress->relBState->name}} @endif</td>
                                        <td colspan='2'><b>City: </b>{{$order->relShippingAddress->b_city}}</td>
                                        <td colspan='2'><b>Address Type: </b>{{$order->relShippingAddress->b_address_type}}</td>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Shipping Address Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Customer Name: </b>{{$order->relUser->name}}</td>
                                        <td colspan='2'><b>Shipping Name: </b>{{$order->relShippingAddress->name}}</td>
                                        <td colspan='2'><b>Contact: </b>{{$order->relShippingAddress->contact}}</td>
                                        <td colspan='2'><b>Pincode: </b>{{$order->relShippingAddress->pincode}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Locality: </b>{{$order->relShippingAddress->locality}}</td>
                                        <td colspan='2'><b>Address: </b>{{$order->relShippingAddress->address}}</td>
                                        <td colspan='2'><b>Landmark: </b>{{$order->relShippingAddress->landmark}}</td>
                                        <td colspan='2'><b>Alternate Contact no: </b>{{$order->relShippingAddress->contact2}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Country: </b>@if(!empty($order->relShippingAddress->relCountry->name)) 
                                        {{$order->relShippingAddress->relCountry->name}} @endif</td>
                                        <td colspan='2'><b>State: </b>@if(!empty($order->relShippingAddress->relState->name)) 
                                        {{$order->relShippingAddress->relState->name}} @endif</td>
                                        <td colspan='2'><b>City: </b>{{$order->relShippingAddress->city}}</td>
                                        <td colspan='2'><b>Address Type: </b>{{$order->relShippingAddress->address_type}}</td>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
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