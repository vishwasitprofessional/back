@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Setting</li>
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
                            <h3 class="card-title">General Setting</h3>
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
                                        <th>Email</th>
                                        <th>Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keywords</th>
                                        <th>Phone</th>
                                        <th>Whats App</th>
                                        <th>Category For Front</th>
                                        <th>Logo</th>
                                        <th style="width: 10%; ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($general_settings as $row)
                                    <tr>
                                        <td><a>{{$row->email}}</a></td>
                                        <td><a>{{$row->title}}</a></td>
                                        <td><a>{{$row->meta_description}}</a></td>
                                        <td><a>{{$row->meta_keywords}}</a></td>
                                        <td><a>{{$row->phone}}</a></td>
                                        <td><a>{{$row->whatsapp_no}}</a></td>
                                        <td><a>{{$row->relCategory->title}}</a></td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    @if(!empty($row->logo))
                                                        <img alt="Avatar" class="table-avatar" src="{{URL::to('/')}}/public/images/general_settings/{{$row->logo}}" height="50" width="50">
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-eye"></i></a> -->
                                            <a class="btn btn-info btn-sm" href="{{route('general-setting-edit',$row['id'])}}"><i class="fas fa-pencil-alt"></i></a>
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

@endsection