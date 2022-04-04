@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
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
                        <h4 class="mt-2 ml-3">Product Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='3'><b>Vendor Name: </b> @if(!empty($product->relVendor['name'])) {{$product->relVendor['name']}} @endif </td>
                                        <td></td>
                                        <td colspan='3'><b>Product Name: </b> {{$product['title']}} </td>
                                    </tr>
                                    @if($product->relCategory['status']=='active' || $product->relChildCategory['status']=='active')
                                    <tr>
                                        <td colspan='3'><b>Category: </b> {{$product->relCategory['title']}} </td>
                                        <td></td>
                                        <td colspan='3'><b>Sub Category: </b>@if(!empty($product->relChildCategory['title'])) {{$product->relChildCategory['title']}} @endif</td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td colspan='3'><b>Product Price: </b> {{$product['sale_price']}} </td>
                                        <td></td>
                                        <td colspan='3'><b>Product Discount in %: </b> {{$product['discount']}} </td>
                                    </tr>

                                    <tr>
                                        <td colspan='3'><b>Product Quantity: </b> {{$product['quantity']}} </td>
                                        <td></td>
                                        <td colspan='3'><b>Product Code: </b> {{$product['code']}} </td>
                                    </tr>

                                    <tr>
                                        @if(!empty($product->image_url1))
                                        <td colspan='3'><b>Product Photo1: </b>
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url1']}}" alt="" height="100" width="100">
                                        </td>
                                        @endif
                                        <td></td>
                                        @if(!empty($product->image_url2))
                                        <td colspan='3'><b>Product Photo2: </b>
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url2']}}" alt="" height="100" width="100">
                                        </td>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if(!empty($product->image_url3))
                                        <td colspan='3'><b>Product Photo3: </b>
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url3']}}" alt="" height="100" width="100">
                                        </td>
                                        @endif
                                        <td></td>
                                        @if(!empty($product->image_url4))
                                        <td colspan='3'><b>Product Photo4: </b>
                                            <img src="{{URL::to('/')}}/public/images/products/{{$product['image_url4']}}" alt="" height="100" width="100">
                                        </td>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td colspan="5"><b>Short Description: </b> {!!$product['short_description']!!} </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"><b>Description: </b> {!!$product['description']!!} </td>
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