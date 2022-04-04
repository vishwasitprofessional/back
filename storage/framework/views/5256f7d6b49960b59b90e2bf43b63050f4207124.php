
<?php $__env->startSection('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Varients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Varients</li>
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
                        <a href="<?php echo e(route('vendor-product-varients-create',$product_id)); ?>" class="btn btn-primary">Add Product Details</a>
                        <!-- <a href="" class="btn btn-primary">Add Bulk Products</a><br> -->
                    </div>
                    <?php if($error=Session::get('error')): ?>
                    <div class="alert bg-red alert-dismissible" role="alert" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?php echo e($error); ?>

                    </div>

                    <?php endif; ?>
                    <?php if($message=Session::get('success')): ?>
                    <div class="alert bg-green alert-dismissible" role="alert" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?php echo e($message); ?>

                    </div>

                    <?php endif; ?><br>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
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
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Weight</th>
                                        <th>Gross Weight</th>
                                        <th>Dimensions</th>
                                        <th style="width: 13%; ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($product_varients)!=0): ?>
                                    <?php $__currentLoopData = $product_varients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($row['pro_id']); ?></td>
                                        <td><?php if(!empty($row->relProduct['title'])): ?> <?php echo e($row->relProduct['title']); ?> <?php endif; ?></td>
                                        <td><?php echo e($row['title']); ?></td>
                                        <td><?php echo e($row->gross_weight); ?></td>
                                        <td><?php echo e($row->dimensions); ?></td>
                                        <!-- <td>
                                            <input type="checkbox" name="toogle" value="<?php echo e($row->id); ?>" data-toggle="switchbutton" <?php echo e($row['status']=='show' ? 'checked' : ''); ?> data-onlabel="show" data-offlabel="&nbsp; hide" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td> -->
                                        <td>
                                            <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-eye"></i></a> -->
                                            <a class="btn btn-info btn-sm" href="<?php echo e(route('vendor-product-varient-edit',$row['id'])); ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <!--  -->
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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
                url: "<?php echo e(route('vendor-ajax-product-status-update')); ?>",
                method: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
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

 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/vendor/products/product_varients_show.blade.php ENDPATH**/ ?>