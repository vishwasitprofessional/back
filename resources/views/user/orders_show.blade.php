@extends('layouts.front')
@section('content')


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

            </aside>
            <!--col-right sidebar col-sm-3 wow bounceInUp animated-->


            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="my-account">

                    <!--page-title-->
                    <!-- BEGIN DASHBOARD-->
                    @if(count($orders) != 0)
                    <div class="dashboard">
                        <div class="recent-orders">
                            <div class="title-buttons">
                                <strong>Recent Orders</strong>
                                <!-- <a href="#">View All</a> -->
                            </div>
                            <div class="table-responsive">
                                <table class="data-table table-striped" id="my-orders-table">
                                    <thead>
                                        <tr class="first last">
                                            <th>Order # </th>
                                            <th>Tracking No</th>
                                            <th>Total Amount</th>
                                            <th>Grand Amount</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $row)
                                        <tr class="first odd">
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->tracking_no}}</td>
                                            <td>{{$row->total_amount}}</td>
                                            <td>{{$row->grand_amount}}</td>
                                            <td>{{$row->payment_status}}</td>
                                            <td>
                                            <?php
                                            $first_date = new \DateTime($row->created_at);
                        					$first_time = $first_date->format('Y-m-d G:i:s');
                        					$date = new \DateTime($first_time);
                        					$date->add(new \DateInterval('PT6H'));
                        					$time = $date->format('Y-m-d G:i:s');
                                            ?> 
                                            @if($time > now())
                                                @if($row->order_status != "completed" && $row->order_status != "canceled")
                                                <select id="order_status" onchange="updateStatus({{$row['id']}},this.selectedIndex)" name="order_status" style="width:120px;">
                                                    <option value="pending" <?php if ($row['order_status'] == 'pending') echo "Selected"; ?>>Pending</option>
                                                    <option value="canceled" <?php if ($row['order_status'] == 'canceled') echo "Selected"; ?>>Cancelled</option>
                                                </select>
                                                <p>You can cancel within 6 hours</p>
                                                @else
                                                {{$row->order_status}}
                                                @endif
                                            @else
                                            {{$row->order_status}}
                                            @endif
                                        </td>
                                            <td>
                                                <a class="button button-success btn-sm" href="{{route('front-order-view',$row['id'])}}" style="background-color:#88be4c"><i class="fas fa-pencil-alt"></i>View</a>
                                                <!--<a class="button button-success btn-sm" href="{{--route('front-order-edit',$row['id'])--}}" style="background-color:#ed6663"><i class="fas fa-pencil-alt"></i>Edit</a>-->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--table-responsive-->
                        </div>
                        <!--recent-orders-->
                        {{--<div class="box-account">
                            <div class="page-title">
                                <h2>Account Information</h2>
                            </div>
                            <div class="col2-set">
                                <div class="col-1">
                                    <div class="box">
                                        <div class="box-title">
                                            <h5>Contact Information</h5>
                                            <a href="#">Edit</a>
                                        </div>
                                        <!--box-title-->
                                        <div class="box-content">
                                            <p> jhon doe<br>
                                                jhon.doe@gmail.com<br>
                                                <a href="#">Change Password</a>
                                            </p>
                                        </div>
                                        <!--box-content-->
                                    </div>
                                    <!--box-->
                                </div>
                                <div class="col-2">
                                    <div class="box">
                                        <div class="box-title">
                                            <h5>Newsletters</h5>
                                            <a href="#">Edit</a>
                                        </div>
                                        <!--box-title-->
                                        <div class="box-content">
                                            <p> You are currently not subscribed to any newsletter. </p>
                                        </div>
                                        <!--box-content-->
                                    </div>
                                    <!--box-->
                                </div>
                            </div>
                            <div class="col2-set">
                                <div class="box">
                                    <div class="box-title">
                                        <h4>Address Book</h4>
                                        <a href="#">Manage Addresses</a>
                                    </div>
                                    <!--box-title-->
                                    <div class="box-content">
                                        <div class="col-1">
                                            <h5>Default Billing Address</h5>
                                            <address>
                                                jhon doe<br>
                                                Street road<br>
                                                AL, Alabama, 42136<br>
                                                United States<br>
                                                T: 4563 <br>
                                                <a href="#">Edit Address</a>
                                            </address>
                                        </div>
                                        <div class="col-2">
                                            <h5>Default Shipping Address</h5>
                                            <address>
                                                jhon doe<br>
                                                Street road<br>
                                                AL, Alabama, 42136<br>
                                                United States<br>
                                                T: 4563 <br>
                                                <a href="#">Edit Address</a>
                                            </address>
                                        </div>
                                    </div>
                                    <!--box-content-->
                                </div>
                                <!--box-->
                            </div>
                        </div>--}}
                    </div>
                    @else
                    <h1>No Orders in your order list</h1>
                    <a href="{{ route('shop') }}" class="button button-primary outer-left-xs mt-5" style="background-color:#88be4c"><b>Continue Shopping</b></a>
                    @endif
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
<!-- For version 1,2,3,4,6 -->
<script>
    function updateStatus(id, selectedId) {
        var _token = "{{csrf_token()}}";
        var order_status = document.getElementById('order_status').options[selectedId].value;
        var qs = {
            id: id,
            order_status: order_status,
            _token: _token
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "{{route('ajax-user-order-update-status')}}",
            method: "POST",
            data: qs,
            success: function(result) {
                //alert(result.message);
                // alertify.set('notifier', 'position', 'top-right');
                //     alertify.success(result.message);

                alert("Status changed to " + order_status);
                // alert(JSON.stringify(result));
            },
            error: function(request, status, error) {
                console.log('Error is' + request.responseText);
            }
        });
    }
</script>
@endsection