@extends('layouts.vendor')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Varients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Varients</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div align="right">
                        <a href="{{route('vendor-product-varients-create',$product_id)}}" class="btn btn-primary">Add Product Details</a>
                        <!-- <a href="{{--route('vendor-bulk-product-create')--}}" class="btn btn-primary">Add Bulk Products</a><br> -->
                    </div>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Weight</th>
                                        <th>Gross Weight</th>
                                        <th>Dimensions</th>
                                        <th style="width: 13%; ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($product_varients)!=0)
                                    @foreach($product_varients as $row)
                                    <tr>
                                        <td>{{$row['pro_id']}}</td>
                                        <td>@if(!empty($row->relProduct['title'])) {{$row->relProduct['title']}} @endif</td>
                                        <td>{{$row['title']}}</td>
                                        <td>{{$row->gross_weight}}</td>
                                        <td>{{$row->dimensions}}</td>
                                        <!-- <td>
                                            <input type="checkbox" name="toogle" value="{{$row->id}}" data-toggle="switchbutton" {{$row['status']=='show' ? 'checked' : ''}} data-onlabel="show" data-offlabel="&nbsp; hide" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td> -->
                                        <td>
                                            <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-eye"></i></a> -->
                                            <a class="btn btn-info btn-sm" href="{{route('vendor-product-varient-edit',$row['id'])}}"><i class="fas fa-pencil-alt"></i></a>
                                            <!-- {{--<form name="myForm" method="POST" action="{{route('vendor-product-delete',$row['id'])}}" class="float-right">
                                                @csrf
                                                <input type="hidden" name="_method" value="Delete" />
                                                <a href="#" data-toggle="tooltip" title="delete" class="btn btn-danger btn-sm dltBtn" data-id="{{$row->id}}"><i class="fas fa-trash"></i></a>
                                            </form>--}} -->
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{ route('vendor-ajax-product-status-update') }}",
                method: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    mode: mode,
                    id: id
                },
                success: function(result) {
                    if (result.status) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(result.msg);
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error("Please Try Again!");
                    }
                },
                error: function(request, status, error) {
                    console.log('Error is' + request.responseText);
                }
            });
        });
    });

 </script>
@endsection