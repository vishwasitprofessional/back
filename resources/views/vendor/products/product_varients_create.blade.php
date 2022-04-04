@extends('layouts.vendor')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Varientions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Product Varientions</li>
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
                                <form method="post" action="{{route('vendor-product-varients-create-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="pro_id" class="form-control" value="{{old('id',$product->id)}}">
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Net Weight</label>
                                        <div class="col-sm-10">
                                            <select name="title" class="form-control">
                                                <option value="">Select Weight</option>
                                                @foreach($varient_filters as $varient_filter)
                                                <option value="{{$varient_filter->id}}">{{$varient_filter->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Gross Weight</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gross_weight" class="form-control" placeholder="Gross Weight" value="{{old('gross_weight')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="price" class="form-control" placeholder="Price" value="{{old('price')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Sale Price</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" value="{{old('sale_price')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{old('quantity')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Dimensions</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="dimensions" class="form-control" placeholder="Dimensions" value="{{old('dimensions')}}">
                                        </div>
                                    </div>
                                    
                                    {{--<div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Image 1</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="" id="output1" alt="..." height="100" width="100">
                                            <input type="file" name="image_url" id="image1" accept="image/*" class="form-control" onchange="loadFile1(event)">
                                            <script>
                                                var loadFile1 = function(event) {
                                                    var image1 = document.getElementById('output1');
                                                    image1.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output1').slideDown();
                                                };
                                            </script>
                                        </div>
                                    </div>--}}
                                    
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
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
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection