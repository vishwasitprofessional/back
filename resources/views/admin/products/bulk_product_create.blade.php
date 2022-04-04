@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bulk Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Bulk Products</li>
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
                            @if($error=Session::get('error'))
                            <div class="alert bg-red alert-dismissible" role="alert" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ $error }}
                            </div>

                            @endif
                            @if($message=Session::get('success'))
                            <div class="alert bg-green alert-dismissible" role="alert" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ $message }}
                            </div>

                            @endif<br>
                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{route('bulk-product-create-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <a href="{{URL::to('/')}}/public/images/bulk_products/dummy_products.xlsx" class="btn btn-warning">Download Sample File</a><br>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Vendor</label>
                                        <div class="col-sm-10">
                                            <select name="vendor_id" class="form-control">
                                                <option value="">Select a Vendor</option>
                                                <option value="{{Auth::user()->id}}">My Products</option>
                                                @foreach($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Upload Excel File</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="excel_file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Upload Multiple Images</label>
                                        <div class="col-sm-10">
                                            <input type="file" multiple name="imgs[]" class="form-control">
                                            <br><p class="text text-danger">*Number of images must be same as number of products in excel file</p>
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
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection