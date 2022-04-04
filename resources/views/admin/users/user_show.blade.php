@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                            <h3 class="card-title">Customers</h3>
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
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Photo</th>
                                        <th>Customer Phone No.</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $row)
                                    <tr>
                                        <td>{{$row['id']}}</td>
                                        <td><a>{{$row['name']}}</a></td>
                                        <td>{{$row['email']}}</td>
                                        <td>
                                            <img alt="Avatar" class="table-avatar" src="{{URL::to('/')}}/templates/admin/dist/img/avatar.png" height="50" width="50">
                                        </td>

                                        <td>{{$row['contact']}}</td>
                                        <!-- <td>
                                            <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a>
                                        </td> -->
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

@endsection