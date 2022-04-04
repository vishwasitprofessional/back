@extends('layouts.vendor')
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
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{$row['order_id']}}</td>
                                        <td>{{date('d-M-Y', strtotime($row['created_at']))}}</td>
                                        <td>{{$row->relOrder->tracking_no}}</td>
                                        <td>{{$row->relProductVarient->relProduct->title}} 
                                        @if(!empty($row->relProductVarient->title)) ({{$row->relProductVarient->title}}) @endif</td>
                                        <td>{{$row->price}}</td>
                                        <td>{{$row->quantity}}</td>
                                        <td>{{$row->amount}}</td>
                                        <td>
                                            @if($row->relOrder->status=='accepted') 
                                                <select id="order_status" onchange="updateStatus({{$row['id']}},this.selectedIndex)" name="order_status">
                                                    <option value="" <?php if ($row['order_status'] == '') echo "Selected"; ?>>Select</option>
                                                    <option value="completed" <?php if ($row['order_status'] == 'completed') echo "Selected"; ?>>Accepted</option>
                                                    <option value="canceled" <?php if ($row['order_status'] == 'canceled') echo "Selected"; ?>>Cancelled</option>
                                                </select> 
                                               
                                            @else 
                                            {{$row->relOrder->order_status}}
                                            @endif
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
        var order_status = document.getElementById('order_status').options[selectedId].value;
        var qs = {
            id: id,
            order_status: order_status,
            _token: _token
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "{{route('ajax-orderItem-update-status')}}",
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