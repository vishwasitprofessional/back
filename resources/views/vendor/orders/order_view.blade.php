@extends('layouts.vendor')
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
                            <a href="{{route('vendor-generate-invoice', $order->id)}}" class="btn btn-success float-right py-1">Generate Invoice</a>
                        </h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='5'><b>Total Amount: </b>{{$order->total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='3'><b>Order Id: </b>{{$order->id}}</td>
                                        <td></td>
                                        <td><b>Date: </b>{{date('d-M-Y', strtotime($order['created_at']))}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Customer Name: </b>{{$order->relUser->name}}</td>
                                        <td></td>
                                        <td><b>Contact No: </b>{{$order->relUser->contact}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Tracking No: </b>{{$order->tracking_no}}</td>
                                        <td></td>
                                        <td><b>Tracking Message: </b>{{$order->tracking_msg}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Payment Mode: </b>{{$order->payment_mode}}</td>
                                        <td></td>
                                        <td><b>Payment Id: </b>{{$order->payment_id}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Payment Status: </b>{{$order->payment_status}}</td>
                                        <td></td>
                                        <td><b>Order Status: </b>{{$order->order_status}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Cancel Reason: </b>{{$order->cancel_reason}}</td>
                                        <td></td>
                                        <td><b>Notify: </b>{{$order->notify}}</td>
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
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>amount</th>
                                        <th>tax_amount</th>
                                        <th>discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->relOrderItem as $row)
                                    <tr>
                                        <td>{{$row['order_id']}}</td>
                                        <td>{{$row->relProduct->title}}</td>
                                        <td>{{$row['price']}}</td>
                                        <td>{{$row['quantity']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['tax_amount']}}</td>
                                        <td>{{$row['discount']}}</td>
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
                        <h4 class="mt-2 ml-3">Shipping Address Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='5'><b>Customer Name: </b>{{$order->relUser->name}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='3'><b>Shipping Name: </b>{{$order->relShippingAddress->name}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Contact: </b>{{$order->relShippingAddress->contact}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Pincode: </b>{{$order->relShippingAddress->pincode}}</td>
                                        <td></td>
                                        <td colspan='3'><b>Locality: </b>{{$order->relShippingAddress->locality}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='5'><b>Address: </b>{{$order->relShippingAddress->address}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>City: </b>{{$order->relShippingAddress->city}}</td>
                                        <td></td>
                                        <td colspan='3'><b>State: </b>{{$order->relShippingAddress->state}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='5'><b>Landmark: </b>{{$order->relShippingAddress->landmark}}</td>
                                        <td></td>
                                        <td colspan='5'><b>Alternate Contact no: </b>{{$order->relShippingAddress->contact2}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan='5'><b>Address Type: </b>{{$order->relShippingAddress->address_type}}</td>
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