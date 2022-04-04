@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
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
                                <form method="post" action="{{route('banner-create-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="inputPrice" placeholder="Title" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Sub Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="sub_title" class="form-control" id="inputPrice" placeholder="Sub Title" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Link Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="link_title" class="form-control" id="inputPrice" placeholder="Link Title" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Link Url</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="link_url" class="form-control" id="inputPrice" placeholder="Link Url" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPrice" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="" id="output" alt="..." height="100" width="100">
                                            <input type="file" name="image_url" id="image" accept="image/*" class="form-control" onchange="loadFile(event)">
                                            <script>
                                                var loadFile = function(event) {
                                                    var image = document.getElementById('output');
                                                    image.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output').slideDown();
                                                };
                                            </script>
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