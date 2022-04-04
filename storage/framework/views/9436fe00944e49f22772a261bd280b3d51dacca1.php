
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Order Details
                            <a href="<?php echo e(route('generate-invoice', $order->id)); ?>" class="btn btn-success float-right py-1 ml-2">Generate Invoice</a>
                            <a href="<?php echo e(route('orders-show')); ?>" class="btn btn-success float-right py-1">Back</a>
                        </h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                            <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Total Amount: </b><?php echo e($order->total_amount); ?></td>
                                        <td colspan='2'><b>Total Weight: </b><?php echo e($order->weight); ?>Kg</td>
                                        <td colspan='2'><b>Date: </b><?php echo e(date('d-M-Y', strtotime($order['created_at']))); ?></td>
                                        <td colspan='2'><b>Customer Name: </b><?php echo e($order->relUser->name); ?></td>
                                        <td colspan='2'><b>Contact No: </b><?php echo e($order->relUser->contact); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Tracking No: </b><?php echo e($order->tracking_no); ?></td>
                                        <td colspan='2'><b>Payment Mode: </b><?php echo e($order->payment_mode); ?></td>
                                        <td colspan='2'><b>Payment Id: </b><?php echo e($order->payment_id); ?></td>
                                        <td colspan='2'><b>Cancel Reason: </b><?php echo e($order->cancel_reason); ?></td>
                                        <td colspan='2'><b>Payment Status: </b><?php echo e($order->payment_status); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Order Status: </b><?php echo e($order->order_status); ?></td>
                                        <td colspan='2'><b>Delivery Charges: </b><?php echo e($order->shipping_cost); ?></td>
                                         <td colspan='2'><b>GST: </b><?php echo e($order->total_gst); ?></td> 
                                         <td colspan='2'><b>CGST: </b><?php echo e($order->total_cgst); ?></td> 
                                         <td colspan='2'><b>SGST: </b><?php echo e($order->total_sgst); ?></td> 
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->


                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Order Items Details</h4>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Brand</th>
                                        <th>Per Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Weight</th>
                                        <th>Total Amount</th>
                                        <th>Total Weight</th>
                                        <th>GST</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($row['order_id']); ?></td>
                                        <td><?php echo e($row->relProductVarient->relProduct->title); ?></td>
                                        <td><?php echo e($row->relVendor->brand_name); ?></td>
                                        <td><?php echo e($row['price']); ?></td>
                                        <td><?php echo e($row['quantity']); ?></td>
                                        <td><?php echo e($row->relProductVarient->title); ?></td>
                                        <td><?php echo e($row['amount']); ?></td>
                                        <td><?php echo e($row['weight']/1000); ?>Kg</td>
                                        <td><?php echo e($row['gst']); ?></td>
                                       <!-- <td></td> -->
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->


                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Billing Address Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Customer Name: </b><?php echo e($order->relUser->name); ?></td>
                                        <td colspan='2'><b>Billing Name: </b><?php echo e($order->relShippingAddress->b_name); ?></td>
                                        <td colspan='2'><b>Contact: </b><?php echo e($order->relShippingAddress->b_contact); ?></td>
                                        <td colspan='2'><b>Pincode: </b><?php echo e($order->relShippingAddress->b_pincode); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Locality: </b><?php echo e($order->relShippingAddress->b_locality); ?></td>
                                        <td colspan='2'><b>Address: </b><?php echo e($order->relShippingAddress->b_address); ?></td>
                                        <td colspan='2'><b>Landmark: </b><?php echo e($order->relShippingAddress->b_landmark); ?></td>
                                        <td colspan='2'><b>Alternate Contact no: </b><?php echo e($order->relShippingAddress->b_contact2); ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Country: </b><?php if(!empty($order->relShippingAddress->relBCountry->name)): ?> 
                                        <?php echo e($order->relShippingAddress->relBCountry->name); ?> <?php endif; ?></td>
                                        <td colspan='2'><b>State: </b><?php if(!empty($order->relShippingAddress->relBState->name)): ?> 
                                        <?php echo e($order->relShippingAddress->relBState->name); ?> <?php endif; ?></td>
                                        <td colspan='2'><b>City: </b><?php echo e($order->relShippingAddress->b_city); ?></td>
                                        <td colspan='2'><b>Address Type: </b><?php echo e($order->relShippingAddress->b_address_type); ?></td>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <h4 class="mt-2 ml-3">Shipping Address Details</h4>
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <table class="table table-striped table-hover responsive">
                                    <tr>
                                        <td colspan='2'><b>Customer Name: </b><?php echo e($order->relUser->name); ?></td>
                                        <td colspan='2'><b>Shipping Name: </b><?php echo e($order->relShippingAddress->name); ?></td>
                                        <td colspan='2'><b>Contact: </b><?php echo e($order->relShippingAddress->contact); ?></td>
                                        <td colspan='2'><b>Pincode: </b><?php echo e($order->relShippingAddress->pincode); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Locality: </b><?php echo e($order->relShippingAddress->locality); ?></td>
                                        <td colspan='2'><b>Address: </b><?php echo e($order->relShippingAddress->address); ?></td>
                                        <td colspan='2'><b>Landmark: </b><?php echo e($order->relShippingAddress->landmark); ?></td>
                                        <td colspan='2'><b>Alternate Contact no: </b><?php echo e($order->relShippingAddress->contact2); ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan='2'><b>Country: </b><?php if(!empty($order->relShippingAddress->relCountry->name)): ?> 
                                        <?php echo e($order->relShippingAddress->relCountry->name); ?> <?php endif; ?></td>
                                        <td colspan='2'><b>State: </b><?php if(!empty($order->relShippingAddress->relState->name)): ?> 
                                        <?php echo e($order->relShippingAddress->relState->name); ?> <?php endif; ?></td>
                                        <td colspan='2'><b>City: </b><?php echo e($order->relShippingAddress->city); ?></td>
                                        <td colspan='2'><b>Address Type: </b><?php echo e($order->relShippingAddress->address_type); ?></td>
                                    </tr>

                                </table>
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
    </section>
</div><!-- /.container-fluid -->

<!-- /.content-wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/admin/orders/order_view.blade.php ENDPATH**/ ?>