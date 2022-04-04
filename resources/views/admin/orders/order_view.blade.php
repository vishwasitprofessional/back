@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Order Details
                            <a href="{{route('generate-invoice', $order->id)}}" class="btn btn-success float-right py-1 ml-2">Generate Invoice</a>
                            <a href="{{route('orders-show')}}" class="btn btn-success float-right py-1">Back</a>
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
                <!-- /.card -->


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
                                       <!-- <td>{{--$row['discount']--}}</td> -->
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->


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
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div><!-- /.container-fluid -->

<!-- /.content-wrapper -->


@endsection