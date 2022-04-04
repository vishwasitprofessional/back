
<?php $__env->startSection('content'); ?>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN Main Container -->

<div class="main-container col1-layout wow bounceInUp animated">

    <div class="main">


        <?php if(!empty($carts) && Auth::check()): ?>
        <?php $session_total="0";$total="0";$total_gst="0"; $total_weight=0; ?>

        <div class="cart wow bounceInUp animated">

            <div class="table-responsive shopping-cart-tbl  container">
                <form action="" method="post">
                    <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
                    <fieldset>
                        <table id="shopping-cart-table" class="data-table cart-table table-striped">
                            <thead>
                                <tr class="first last">
                                    <th>&nbsp;</th>
                                    <th><span class="nobr">Product Name</span></th>
                                    <th><span class="nobr">Brand Name</span></th>
                                    <th>Weight</th>
                                    <th><span class="nobr">Unit Price</span></th>
                                    <th>Qty</th>
                                    <th>SubWeight</th>
                                    <th>Subtotal</th>
                                    <th>GST</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="first last">
                                    <td colspan="50" class="a-right last">
                                       <a href="<?php echo e(route('shop')); ?>" class="button btn-continue" title="Continue Shopping" style="background-color:#88be4c"><span><span>Continue Shopping</span></span></a>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($cart['weight'])): ?>
                                <tr class="first last odd" id="cartpage">
                                    <td class="image hidden-table">
                                        <a href="<?php echo e(route('product-detail', $cart->slug)); ?>" title="<?php echo e($cart['title']); ?>" class="product-image">
                                            <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($cart['image_url1']); ?>" width="75" alt="<?php echo e($cart['title']); ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <h2 class="product-name">
                                            <a href="<?php echo e(route('product-detail', $cart->slug)); ?>">
                                                <?php if(strlen($cart['title'])>20): ?> <?php echo e(substr($cart['title'], 0,20)); ?>... <?php else: ?> <?php echo e($cart['title']); ?> <?php endif; ?>
                                            </a>
                                        </h2>
                                    </td>
                                    <td>
                                        <h2 class="product-name">
                                            <?php echo e($cart['brand_name']); ?>

                                        </h2>
                                    </td>


                                    <td>
                                        <?php $weight = \App\Models\ProductVarient::where('pro_id', $cart['id'])->get(); //echo $weight;
                                        ?>
                                        <?php $per_weight = 0; ?>
                                        <select name="varient_id" id="varient_id<?php echo e($cart['cart_id']); ?>" style="width: 100px;" onchange="updateWeight(this.selectedIndex,<?php echo e($cart['cart_id']); ?>,<?php echo e($cart['id']); ?>)">
                                            <?php $__currentLoopData = $weight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row['id']); ?>" <?php if($cart['cart_varient_id']==$row['id']): ?> selected <?php endif; ?>><?php echo e($row['title']); ?></option>
                                            <?php if($cart['cart_varient_id']==$row['id']): ?>
                                            <?php if ($row['title'] == '250gm') {
                                                echo $per_weight = 250;
                                            }
                                            if ($row['title'] == '500gm') {
                                                echo $per_weight = 500;
                                            }
                                            if ($row['title'] == '1kg') {
                                                echo $per_weight = 1000;
                                            } ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>

                                    <td>
                                        <span class="cart-price">
                                            <span class="price" id="price<?php echo e($cart['cart_id']); ?>">₹<?php echo e($cart->sale_price); ?></span>
                                        </span>
                                    </td>

                                    <td>
                                        <input type="hidden" id="salePrice<?php echo e($cart['cart_id']); ?>" value="<?php echo e($cart->sale_price); ?>" min="1" class="input-text qty">
                                        <input type="number" id="quantity<?php echo e($cart['cart_id']); ?>" onchange="updateQuantity(<?php echo e($cart['cart_id']); ?>)" value="<?php echo e($cart['cart_quantity']); ?>" min="1" class="input-text qty" style="width: 70px;">
                                    </td>

                                    <td>
                                        <span class="cart-price">
                                            <span class="weight" id="sub_weight<?php echo e($cart['cart_id']); ?>">
                                                <?php echo $sub_weight = ($per_weight *  $cart->cart_quantity)/1000;?>kg
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="cart-price">
                                            <span class="price" id="amount<?php echo e($cart['cart_id']); ?>">
                                                ₹ <?php echo $amount1 = $cart->sale_price * $cart->cart_quantity;
                                                    $gst = ($amount1 * $cart['gst_in_percentage']) / 100;
                                                    $amount = ($amount1 + $gst);
                                                ?>
                                                <?php echo e(Session()->put('amount',$amount)); ?>

                                            </span>
                                            <!--<span class="amount" id="session_amount<?php echo e($cart['cart_id']); ?>"></span>-->
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="cart-price">
                                            <span class="gst" id="gst<?php echo e($cart['id']); ?>">
                                                <?php echo e($cart['gst_in_percentage']); ?>%
                                            </span>
                                        </span>
                                    </td>
                                    <td>

                                        <a href="#" title="cancel" class="button remove-item" onclick="deleteCart(<?php echo e($cart['cart_id']); ?>)"><span><span>Remove item</span></span>
                                    </td>

                                </tr>
                                <?php $session_total += Session()->get('amount') ?>
                                <?php $total += $cart->sale_price * $cart->cart_quantity ?>
                                <?php $total_gst += $gst ?>
                                <?php $total_weight += ($per_weight *  $cart->cart_quantity)/1000; ?>
                                <?php else: ?>
                                <tr class="first last odd" id="cartpage">
                                    <td class="image hidden-table">
                                        <a href="<?php echo e(route('product-detail', $cart->slug)); ?>" title="<?php echo e($cart['title']); ?>" class="product-image">
                                            <img src="<?php echo e(URL::to('/')); ?>/public/images/products/<?php echo e($cart['image_url1']); ?>" width="75" alt="<?php echo e($cart['title']); ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <h2 class="product-name">
                                            <a href="<?php echo e(route('product-detail', $cart->slug)); ?>">
                                                <?php if(strlen($cart['title'])>20): ?> <?php echo e(substr($cart['title'], 0,20)); ?>... <?php else: ?> <?php echo e($cart['title']); ?> <?php endif; ?>
                                            </a>
                                        </h2>
                                    </td>
                                    <td>
                                        <h2 class="product-name">
                                            <?php echo e($cart['brand_name']); ?>

                                        </h2>
                                    </td>

                                    <td></td>

                                    <td>
                                        <span class="cart-price">
                                            <span class="price" id="price<?php echo e($cart['cart_id']); ?>">₹<?php echo e($cart->sale_price); ?></span>
                                        </span>
                                    </td>

                                    <td>
                                        <input type="hidden" id="salePrice<?php echo e($cart['cart_id']); ?>" value="<?php echo e($cart->sale_price); ?>" min="1" class="input-text qty">
                                        <input type="number" id="quantity<?php echo e($cart['cart_id']); ?>" onchange="updateQuantity(<?php echo e($cart['cart_id']); ?>)" value="<?php echo e($cart['cart_quantity']); ?>" min="1" class="input-text qty" style="width: 70px;">
                                    </td>

                                    <td></td>
                                    <td>
                                        <span class="cart-price">
                                            <span class="price" id="amount<?php echo e($cart['cart_id']); ?>">
                                                ₹ <?php echo $amount1 = $cart->sale_price * $cart->cart_quantity;
                                                    $gst = ($amount1 * $cart['gst_in_percentage']) / 100;
                                                    $amount = ($amount1 + $gst);
                                                ?>
                                                <?php echo e(Session()->put('amount',$amount)); ?>

                                            </span>
                                            <!--<span class="amount" id="session_amount<?php echo e($cart['cart_id']); ?>"></span>-->
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="cart-price">
                                            <span class="gst" id="gst<?php echo e($cart['id']); ?>">
                                                <?php echo e($cart['gst_in_percentage']); ?>%
                                            </span>
                                        </span>
                                    </td>

                                    <td>

                                        <a href="#" title="cancel" class="button remove-item" onclick="deleteCart(<?php echo e($cart['cart_id']); ?>)"><span><span>Remove item</span></span>
                                    </td>

                                </tr>
                                <?php $session_total += Session()->get('amount') ?>
                                <?php $total += $cart->sale_price * $cart->cart_quantity ?>
                                <?php $total_gst += $gst ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>

                    </fieldset>
                </form>


                <div class="col-sm-12">
                    <div class="totals" style="float: right;">
                        <!-- <h3>Shopping Cart Total</h3> -->
                        <div class="inner">

                            <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                                <colgroup>
                                    <col>
                                    <col width="1">
                                </colgroup>
                                <tfoot>
                                    <tr>
                                        <td class="a-right" colspan="1">
                                            <strong>Grand Weight</strong>
                                        </td>
                                        <td class="a-right">
                                            <strong><span class="weight" id="total_weight"><?php echo e($total_weight); ?>kg</span></strong>
                                            <?php echo e(Session()->put('weight',$total_weight)); ?>

                                            <strong><span class="weight" id="session_weight"></span></strong>
                                            

                                        </td>
                                        <td class="a-right" colspan="1">
                                            <strong>Grand Total(including gst)</strong>
                                        </td>
                                        <td class="a-right">
                                            <strong><span class="price" id="total">₹ <?php echo e($session_total); ?></span></strong>
                                            <?php echo e(Session()->put('total_price',$total)); ?>

                                            <?php echo e(Session()->put('total_gst',$total_gst)); ?>

                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                            <?php if (Illuminate\Support\Facades\Auth::check() && count($carts) != 0) { ?>
                                <a href="<?php echo e(route('checkout')); ?>" title="Proceed to Checkout" class="button btn-continue" style="float:right; background-color:#88be4c"><span>Proceed to Checkout</span></a>
                            <?php }
                            if (Illuminate\Support\Facades\Auth::check() && count($carts) == 0) { ?>
                                <a href="<?php echo e(route('shop')); ?>" title="Proceed to Checkout" class="button btn-continue"><span>Continue Shopping</span></a>
                            <?php } ?>

                        </div>
                        <!--inner-->
                    </div>
                    <!--totals-->
                </div>

            </div>

            <!-- BEGIN CART COLLATERALS -->





        </div>
        <?php else: ?>
        <div class="main">
            <div class="cart wow bounceInUp animated py-5 text-center">
                <div class="mycards">
                    <h4>Your cart is currently empty.</h4>
                    <a href="<?php echo e(route('shop')); ?>" class="button btn-proceed-checkout">Continue Shopping</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <!--main-container-->

</div>
<!--col1-layout-->


<div class="our-features-box wow bounceInUp animated animated">
    <div class="container">
        <ul>
            <li>
                <div class="feature-box free-shipping">
                    <div class="icon-truck"></div>
                    <div class="content">We Deliver Across The Globe</div>
                </div>
            </li>
            <li>
                <div class="feature-box need-help">
                    <div class="icon-support"></div>
                    <div class="content">Contact Us +91-9642392222</div>
                </div>
            </li>
            <li>
                <div class="feature-box money-back">
                    <div class="icon-money"></div>
                    <div class="content">Money Back Guarantee</div>
                </div>
            </li>
            <li class="last">
                <div class="feature-box return-policy">
                    <div class="icon-return"></div>
                    <div class="content">Premium Quality Assurance</div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- For version 1,2,3,4,6 -->
<script>
    function updateWeight(id, cartId, proId) {
        var varient_id = document.getElementById('varient_id' + cartId).options[id].value;
        var qs = {
            '_token': "<?php echo e(csrf_token()); ?>",
            'varient_id': varient_id,
            'id': cartId
        };
        // alert(JSON.stringify(qs));

        $.ajax({
            url: "<?php echo e(route('ajax-update-cart-varientId')); ?>",
            method: "POST",
            data: qs,
            success: function(result) {
                // alert(JSON.stringify(result));
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success(result.status);
                if (result.weight == '250gm') {
                    var sub_weight = 250;
                }
                if (result.weight == '500gm') {
                    var sub_weight = 500;
                }
                if (result.weight == '1kg') {
                    var sub_weight = 1000;
                }
                var parsed = JSON.parse(result.price)
                var value = parsed; //Single Data Viewing

                document.getElementById('price' + cartId).innerHTML = '₹' + result.price;

                document.getElementById('amount' + cartId).innerHTML = '₹' + result.quantity * result.price;
                // document.getElementById('amount' + cartId).innerHTML = '₹' + result.quantity * result.price;
                document.getElementById('sub_weight' + cartId).innerHTML = (result.quantity * sub_weight)/1000 + 'kg';
                $('#total').load(location.href + ' #total');
                $('#total_weight').load(location.href + ' #total_weight');
                $('#session_weight').load(location.href + ' #session_weight');
                $('#session_amount'+cartId).load(location.href + ' #session_amount'+cartId);

            },
            error: function(request, status, error) {
                console.log('Error is' + request.responseText);
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/cart.blade.php ENDPATH**/ ?>