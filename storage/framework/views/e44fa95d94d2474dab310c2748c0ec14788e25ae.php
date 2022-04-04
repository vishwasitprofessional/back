
<?php $__env->startSection('content'); ?>

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
                            <?php if(count($errors)>0): ?>
                            <div class='alert alert-danger'>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <?php if($message=Session::get('success')): ?>
                            <div class="alert alert-success">
                                <p><?php echo e($message); ?></p>
                            </div>
                            <?php endif; ?><br>
                            <div class="tab-pane" id="settings">
                                <form method="post" action="<?php echo e(route('vendor-product-update-action')); ?>" enctype="multipart/form-data" class="form-horizontal">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="_method" value="Patch" />
                                    <input type="hidden" name="id" class="form-control <?php echo e($errors->has('body')? 'is-invalid':''); ?> " value="<?php echo e(old('id',$product->id)); ?>">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Main Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cat_id" name="cat_id" onChange="getChildCategory(this.selectedIndex)" required>
                                                <option value="">Select a Category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>" <?php if($category->id==$product->cat_id): ?> selected <?php endif; ?>><?php echo e($category->title); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="child_cat_id" class="col-sm-2 col-form-label">Sub Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="child_cat_id" name="child_cat_id">
                                                <option value="">Select a Sub Category</option>
                                                <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->id); ?>" <?php if($row->id==$product->child_cat_id): ?> selected <?php endif; ?>><?php echo e($row->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo e(old('title',$product->title)); ?>">
                                        </div>
                                        <label for="" class="col-sm-1 col-form-label">Code</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="code" class="form-control" placeholder="Product Code" value="<?php echo e(old('code',$product->code)); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">GST(in %)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gst_in_percentage" class="form-control" placeholder="GST(in %)" value="<?php echo e(old('gst_in_percentage',$product->gst_in_percentage)); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Short Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="short_description" id="short_description" class="form-control" placeholder="Short Description"><?php echo e($product->short_description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control" placeholder="Description"><?php echo e($product->description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Image 1</label>
                                        <div class="col-sm-10">
                                            <img class="img-thumbnail" src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($product->image_url1); ?>" id="output1" alt="..." height="100" width="100">
                                            <input type="hidden" name="old_image_url1" value="<?php echo e($product->image_url1); ?>" class="form-control">
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
        var queryString={'_token':"<?php echo e(csrf_token()); ?>",'cat_id':cat_id};
        // alert(JSON.stringify(queryString));
        jQuery.ajax({
            url: "<?php echo e(route('ajax-category-get-child')); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/vendor/products/product_edit.blade.php ENDPATH**/ ?>