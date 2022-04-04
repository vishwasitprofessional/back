
<?php $__env->startSection('content'); ?>


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
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($row['order_id']); ?></td>
                                        <td><?php echo e(date('d-M-Y', strtotime($row['created_at']))); ?></td>
                                        <td><?php echo e($row->relOrder->tracking_no); ?></td>
                                        <td><?php echo e($row->relProductVarient->relProduct->title); ?> 
                                        <?php if(!empty($row->relProductVarient->title)): ?> (<?php echo e($row->relProductVarient->title); ?>) <?php endif; ?></td>
                                        <td><?php echo e($row->price); ?></td>
                                        <td><?php echo e($row->quantity); ?></td>
                                        <td><?php echo e($row->amount); ?></td>
                                        <td>
                                            <?php if($row->relOrder->status=='accepted'): ?> 
                                                <select id="order_status" onchange="updateStatus(<?php echo e($row['id']); ?>,this.selectedIndex)" name="order_status">
                                                    <option value="" <?php if ($row['order_status'] == '') echo "Selected"; ?>>Select</option>
                                                    <option value="completed" <?php if ($row['order_status'] == 'completed') echo "Selected"; ?>>accepted</option>
                                                    <option value="canceled" <?php if ($row['order_status'] == 'canceled') echo "Selected"; ?>>Canceled</option>
                                                </select> 
                                               
                                            <?php else: ?> 
                                            <?php echo e($row->relOrder->order_status); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        var _token = "<?php echo e(csrf_token()); ?>";
        var order_status = document.getElementById('order_status').options[selectedId].value;
        var qs = {
            id: id,
            order_status: order_status,
            _token: _token
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "<?php echo e(route('ajax-orderItem-update-status')); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/vendor/orders/orders_show.blade.php ENDPATH**/ ?>