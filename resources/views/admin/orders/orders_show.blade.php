@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
                            <h3 class="card-title">Order</h3>
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
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Tracking No</th>
                                        <th>Customer Name</th>
                                        <th>Phone No</th>
                                        <th>Status</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{$row['id']}}</td>
                                        <td>{{date('d-M-Y', strtotime($row['created_at']))}}</td>
                                        <td>{{$row['tracking_no']}}</td>
                                        <td><a>{{$row->relUser->name}}</a></td>
                                        <td><a>{{$row->relUser->contact}}</a></td>
                                        <td>
                                            @if($row['status']=='accepted') {{$row['status']}} @endif
                                            @if($row['status']=='canceled') {{$row['status']}} @endif
                                            @if($row['status']=='pending')
                                            <select id="status" onchange="updateStatus({{$row['id']}},this.selectedIndex)" name="status">
                                                <option value="pending" <?php if ($row['status'] == 'pending') echo "Selected"; ?>>Pending</option>
                                                <option value="accepted" <?php if ($row['status'] == 'accepted') echo "Selected"; ?>>Accepted</option>
                                                <option value="canceled" <?php if ($row['status'] == 'canceled') echo "Selected"; ?>>Cancelled</option>
                                            </select>
                                            @endif
                                        </td>
                                        <td>{{$row['order_status']}}</td>
                                        <td>
                                            <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-folder"></i>View</a> -->
                                            <a class="btn btn-info btn-sm" href="{{route('order-view',$row['id'])}}"><i class="fas fa-eye"></i></a>
                                            <!-- <a class="btn btn-success btn-sm" href="{{--route('order-edit',$row['id'])--}}"><i class="fas fa-edit"></i></a> -->
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
    function updateStatus(id, selectedId) {
        var _token = "{{csrf_token()}}";
        var status = document.getElementById('status').options[selectedId].value;
        var qs = {
            id: id,
            status: status,
            _token: _token
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "{{route('ajax-order-update-status')}}",
            method: "POST",
            data: qs,
            success: function(result) {
                //alert(result.message);
                // alertify.set('notifier', 'position', 'top-right');
                //     alertify.success(result.message);

                alert("Status changed to " + status);
                // alert(JSON.stringify(result));
            },
            error: function(request, status, error) {
                console.log('Error is' + request.responseText);
            }
        });
    }
</script>
@endsection