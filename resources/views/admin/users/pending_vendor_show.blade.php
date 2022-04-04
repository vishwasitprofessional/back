@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pending Vendors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pending Vendors</li>
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
                            <h3 class="card-title">Pending Vendors</h3>
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
                                        <th>Vendor Name</th>
                                        <th>Vendor Email</th>
                                        <th>Vendor Photo</th>
                                        <th>Vendor Phone No.</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pending_vendors as $row)
                                    <tr>
                                        <td>{{$row['id']}}</td>
                                        <td><a>{{$row['name']}}</a></td>
                                        <td>{{$row['email']}}</td>
                                        <td>
                                            <img alt="Avatar" class="table-avatar" src="{{URL::to('/')}}/templates/admin/dist/img/avatar.png" height="50" width="50">
                                        </td>

                                        <td>{{$row['contact']}}</td>
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{$row->id}}" data-toggle="switchbutton" {{$row['approved_status']=='approved' ? 'checked' : ''}} data-onlabel="approved" data-offlabel="un-approved" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route('pending-vendor-view',$row['id'])}}"><i class="fas fa-eye"></i></a>
                                            <!-- <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a> -->
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
                url: "{{ route('ajax-vendor-status-update') }}",
                method: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    mode: mode,
                    id: id
                },
                success: function(result) {
                    if (result.status) {
                        if(result.msg=='Not Successfully'){
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error("Not Successfully");
                        }else{
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(result.msg);
                        }
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