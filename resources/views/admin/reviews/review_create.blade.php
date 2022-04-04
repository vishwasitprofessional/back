@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Review</li>
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
                                <form method="post" action="{{route('review-create-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <div class="form-group">
                                        <h4>Your Rating</h4>
                                        <div class="col-sm-10">
                                            <select name="order_item_id" class="form-control">
                                                <option value="">Select a Product</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        
                                        
                                        
                                        <input class="fa fa-star-o" value="1" id="star-1" type="radio" name="rating" />
                                        <label class="star star-1" for="star-1"></label>
                                        <input class="fa fa-star-o" value="2" id="star-2" type="radio" name="rating" />
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="fa fa-star-o" value="3" id="star-3" type="radio" name="rating" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="fa fa-star-o" value="4" id="star-4" type="radio" name="rating" />
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="fa fa-star-o" value="5" id="star-5" type="radio" name="rating" />
                                        <label class="star star-5" for="star-5"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Title*</label>
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Review*</label>
                                        <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" id="saveReview">Save Review</button>
                                        <button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
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