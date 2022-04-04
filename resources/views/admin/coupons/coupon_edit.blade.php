@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Coupon</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="tab-content"> -->
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
                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{route('coupon-update-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="_method" value="Patch" />
                                    <input type="hidden" name="id" class="form-control {{ $errors->has('body')? 'is-invalid':''}} " value="{{old('id',$coupon->id)}}">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select name="product_id" class="form-control">
                                                <option value="">Product (Optional)</option>
                                                @foreach($products as $row)
                                                    <option value="{{$row['id']}}" @if($row['id']==$coupon->product_id) selected @endif >{{$row['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="offer_name" class="form-control" placeholder="Offer Name" value="{{old('offer_name',$coupon->offer_name)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" value="{{old('coupon_code',$coupon->coupon_code)}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="coupon_limit" class="form-control" placeholder="Coupon Limit" value="{{old('coupon_limit',$coupon->coupon_limit)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select name="coupon_type" class="form-control">
                                                <option value="">-- Select --</option>
                                                <option value="fixed" <?php if($coupon['coupon_type']=='fixed') echo "Selected"; ?>>Fixed</option>
                                                <option value="percent" <?php if($coupon['coupon_type']=='percent') echo "Selected"; ?>>Percent</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="coupon_price" class="form-control" placeholder="Coupon Price" value="{{old('coupon_price',$coupon->coupon_price)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="datetime-local" name="start_datetime" class="form-control" placeholder="Start DateTime" value="{{date('Y-m-d\TH:i', strtotime($coupon->start_datetime))}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="datetime-local" name="end_datetime" class="form-control" placeholder="End DateTime" value="{{date('Y-m-d\TH:i', strtotime($coupon->end_datetime))}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="radio-button guest-check" for="guest">Status:</label>
                                        <div class="col-sm-3">
                                            <input id="guest" type="radio" name="status" value="active" <?php if ($coupon->status == 'active') echo "checked"; ?>>
                                            <label class="radio-button guest-check" for="guest">Active</label>
                                            <input id="guest" type="radio" name="status" value="disabled" <?php if ($coupon->status == 'disabled') echo "checked"; ?>>
                                            <label class="radio-button guest-check" for="guest">Disabled</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="radio-button guest-check" for="guest">Visibility Status:</label>
                                        <div class="col-sm-3">
                                            <input id="guest" type="radio" name="visibility_status" value="show" <?php if ($coupon->visibility_status == 'show') echo "checked"; ?>>
                                            <label class="radio-button guest-check" for="guest">Show</label>
                                            <input id="guest" type="radio" name="visibility_status" value="hide" <?php if ($coupon->visibility_status == 'hide') echo "checked"; ?>>
                                            <label class="radio-button guest-check" for="guest">Hide</label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Save</button>
                                        </div>
                                    </div>
                                </form>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection