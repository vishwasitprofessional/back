@extends('layouts.vendor')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                        <!-- /.card-header -->

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
                                <form method="post" action="{{route('vendor-product-update-action')}}" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="_method" value="Patch" />
                                    <input type="hidden" name="id" class="form-control {{ $errors->has('body')? 'is-invalid':''}} " value="{{old('id',$product->id)}}">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Main Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cat_id" name="cat_id" onChange="getChildCategory(this.selectedIndex)" required>
                                                <option value="">Select a Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($category->id==$product->cat_id) selected @endif>{{$category->title}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="child_cat_id" class="col-sm-2 col-form-label">Sub Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="child_cat_id" name="child_cat_id">
                                                <option value="">Select a Sub Category</option>
                                                @foreach($sub_categories as $row)
                                                <option value="{{$row->id}}" @if($row->id==$product->child_cat_id) selected @endif>{{$row->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{old('title',$product->title)}}">
                                        </div>
                                        <label for="" class="col-sm-1 col-form-label">Code</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="code" class="form-control" placeholder="Product Code" value="{{old('code',$product->code)}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">GST(in %)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gst_in_percentage" class="form-control" placeholder="GST(in %)" value="{{old('gst_in_percentage',$product->gst_in_percentage)}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Short Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="short_description" id="short_description" class="form-control" placeholder="Short Description">{{$product->short_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control" placeholder="Description">{{$product->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Image 1</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="{{ URL::to('/') }}/public/images/products/{{$product->image_url1}}" id="output1" alt="..." height="100" width="100">
                                            <input type="hidden" name="old_image_url1" value="{{$product->image_url1}}" class="form-control">
                                            <input type="file" name="new_image_url1" id="image1" accept="image/*" class="form-control" onchange="loadFile1(event)">
                                            <script>
                                                var loadFile1 = function(event) {
                                                    var image1 = document.getElementById('output1');
                                                    image1.src = URL.createObjectURL(event.target.files[0]);
                                                    $('#output1').slideDown();
                                                };
                                            </script>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Next</button>
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
<script>
    function getChildCategory(id) {
        var cat_id=document.getElementById('cat_id').options[id].value; 
        var queryString={'_token':"{{csrf_token()}}",'cat_id':cat_id};
        // alert(JSON.stringify(queryString));
        jQuery.ajax({
            url: "{{ route('ajax-category-get-child') }}",
            data:queryString,
            type: "POST",
            success:function(data){
                //alert(JSON.stringify(data));
                var html="<option value=''>Select one</option>";
                $.each(data, function(i, item) {
                    html=html+"<option value='"+data[i].id+"'>"+data[i].title+"</option>";
                });
                $("#child_cat_id").html(html);
            },
            error: function(request, status, error)
            {
                document.getElementById("loader").style.display = "none";
                console.log("Error is: "+request.responseText);
            }
        });
    }
</script>
@endsection