@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deal Of Day</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Deal Of Day</li>
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
                        <a href="{{route('deal-of-day-create')}}" class="btn btn-primary">Add New Deal Of Day</a><br>
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
                            <h3 class="card-title">Deal Of Day</h3>
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
                                        <th>Product Title</th>
                                        <th>Status</th>
                                        <th style="width: 10%; ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deal_of_days as $row)
                                    <tr>
                                        <td>{{$row['id']}}</td>
                                        <td><a>{{$row->relProduct->title}}</a></td>
                                        
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{$row->id}}" data-toggle="switchbutton" {{$row['status']=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-eye"></i></a> -->
                                            <a class="btn btn-info btn-sm" href="{{route('deal-of-day-edit',$row['id'])}}"><i class="fas fa-pencil-alt"></i></a>
                                            <form name="myForm" method="POST" action="{{route('deal-of-day-delete',$row['id'])}}" class="float-right">
                                                @csrf
                                                <input type="hidden" name="_method" value="Delete" />
                                                <a href="#" data-toggle="tooltip" title="delete" class="btn btn-danger btn-sm dltBtn" data-id="{{$row->id}}"><i class="fas fa-trash"></i></a>
                                            </form>
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
                url: "{{ route('ajax-deal-of-day-status-update') }}",
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

    // $('.dltBtn').click(function(e){
    //     var form = $(this).closest('form');
    //     var dataID = $(this).data('id');
    //     e.preventDefault();
    //     swal({
    //             title: "Are you sure?",
    //             text: "Once deleted, you will not be able to recover this Record!",
    //             icon: "warning",
    //             buttons: true,
    //             dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 form.submit();
    //                 swal("Poof! Your Record has been deleted!", {
    //                     icon: "success",
    //                 });
    //             } else {
    //                 swal("Your Record is safe!");
    //             }
    //         });
    // });
</script>
@endsection