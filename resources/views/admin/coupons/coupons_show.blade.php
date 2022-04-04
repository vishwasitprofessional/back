@extends('layouts.admin')
@section('content')


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
                        <li class="breadcrumb-item active">Coupon</li>
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
                        <a href="{{route('coupon-create')}}" class="btn btn-primary">Add New Coupon</a><br>
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
                            <h3 class="card-title">Coupon</h3>
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
                                        <th>ID</th>
                                        <th>Offer Name</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon Price</th>
                                        <th>Start date</th>
                                        <th>Status</th>
                                        <th>Visibility Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $row)
                                    <tr>
                                        <td>{{$row['id']}}</td>
                                        <td>{{$row->offer_name}} 
                                            @if(!empty($row->product_id)) 
                                            @foreach($pro_title as $key => $value) 
                                                {{$value}} 
                                            @endforeach 
                                            @endif
                                        </td>
                                        <td>{{$row->coupon_code}}</td>
                                        <td>{{$row->coupon_price}}</td>
                                        <td>{{date('d-M-Y, H:i', strtotime($row['start_datetime']))}}</td>
                                        <td>
                                            @if($row->status == "disabled") 
                                            <span class="badge badge-pill badge-danger px-3 py-2">{{$row->status}}</span>
                                            @else
                                            <span class="badge badge-pill badge-success px-3 py-2">{{$row->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{$row->id}}" data-toggle="switchbutton" {{$row['visibility_status']=='show' ? 'checked' : ''}} data-onlabel="show" data-offlabel="&nbsp; hide" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('coupon-edit',$row['id'])}}"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
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
                url: "{{ route('ajax-coupon-visibility-status-update') }}",
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