@extends('layouts.front')
@section('content')

<div class="page-heading">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="page-title">
					<h2>Checkout</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">

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
				<div class="col-xs-6 col-sm-9 col-md-9 rht-col">
					<div class="panel-group checkout-steps" id="accordion">

						@if(Auth::check())
						<!-- checkout-step-01 If Auth -->
						<div class="panel panel-default checkout-step-01">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
										<span>1</span> Checkout Method <i class="fa fa-check"></i>
									</a>

								</h4>
							</div>
							<!-- panel-heading -->

							<div id="collapseOne" class="panel-collapse collapse in">
								<!-- panel-body  -->
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6 col-sm-6 guest-login">
											<h4 class="checkout-subtitle">Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->name}}</h4>
											<h4 class="checkout-subtitle">Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->contact}}</h4>
											<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                								document.getElementById('logout-form').submit();">
												Logout and Sign in to another account
											</a>
											<div class="panel-heading">
												<h4 class="unicase-checkout-title">
													<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
														<span style="margin-top:20px;">Continue Checkout</span>
													</a>
												</h4>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 guest-login">
											<h4 class="checkout-subtitle">Advantages of our secure login</h4>
											<span>Fast and easy check out</span><br><br>
											<!-- <span>Easy access to your order history and status</span><br><br>
											<span>Get Relevant Alerts and Recommendation</span><br><br>
											<span>Wishlist, Reviews, Ratings and more.</span><br> -->
										</div>
									</div>
								</div>
								<!-- panel-body  -->
								<!-- <span>Please note that upon clicking "Logout" you will lose all items in cart and will be redirected to Flipkart home page.</span> -->
							</div><!-- row -->
						</div>
						<!--End checkout-step-01 If Auth -->

						@else
						<!-- checkout-step-01  -->
						<div class="panel panel-default checkout-step-01">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
										<span>1</span> Checkout Method
									</a>
								</h4>
							</div>
							<!-- panel-heading -->

							<div id="collapseOne" class="panel-collapse collapse in">

								<!-- panel-body  -->
								<div class="panel-body">
									<div class="row">

										<!-- already-registered-login -->
										<div class="col-md-6 col-sm-6 already-registered-login">
											<h4 class="checkout-subtitle">Already registered?</h4>
											<p class="text title-tag-line">Please log in below:</p>
											<form method="POST" action="{{ route('login') }}">
												@csrf
												<div class="form-group row">
													<label for="inputPrice" class="col-sm-2 col-form-label">Email</label>
													<div class="col-sm-10">
														<input type="email" name="email" class="form-control" id="email" placeholder="Email" required autofocus>
													</div>
												</div>

												<!-- Password -->
												<div class="form-group row">
													<label for="inputPrice" class="col-sm-2 col-form-label">Password</label>
													<div class="col-sm-10">
														<input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
													</div>
												</div>

												<!-- Remember Me -->
												<div class="form-group row">
													<div class="col-md-6 offset-md-4">
														<div class="form-check">
															<input type="checkbox" name="remember" id="remember_me">
															<label class="form-chek-label" for="remember">Remember Me</label>
														</div>
													</div>
												</div>

												<!-- Remember Me -->
												<div class="form-group row mb-0">
													<div class="col-md-8 offset-md-4">
														<button type="submit" class="btn btn-primary">Login</button>
														@if (Route::has('password.request'))
														<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
														@endif
													</div>
												</div>

											</form>
										</div>
										<!-- already-registered-login -->


										<div class="col-md-6 col-sm-6 guest-login">
											<h4 class="checkout-subtitle">Advantages of our secure login</h4>
											<span>Fast and easy check out</span><br><br>
											<!-- <span>Easy access to your order history and status</span><br><br>
											<span>Get Relevant Alerts and Recommendation</span><br><br>
											<span>Wishlist, Reviews, Ratings and more.</span><br> -->
										</div>

									</div>
								</div>
								<!-- panel-body  -->

							</div><!-- row -->
						</div>
						<!-- checkout-step-01  -->
						@endif


						@if(Auth::check())
						<!-- checkout-step-02 If Auth -->
						<div class="panel panel-default checkout-step-02">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
										<span>2</span> Billing Address @if(!empty($billing_address->b_name)) <i class="fa fa-check"></i> @endif
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">

								<div class="panel-body">
									<!-- Show Address-form  -->
									<!-- <form class="register-form" role="form"> -->
									<?php $add_id = ""; ?>
									@if(!empty($billing_address))
									<?php $add_id = $billing_address->id; ?>
									@endif
									<!-- </form> -->


								</div>
								<!-- Add Address-form  -->
								<div class="panel panel-default checkout-step-05">
									<div id="collapseFive" class="panel-collapse collapse in">
										<div class="panel-body">
											<form method="POST" action="{{ route('front-billing-address-store') }}">
												@csrf
												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
															<input type="text" name="b_name" class="form-control" @if(!empty($billing_address->b_name)) value="{{$billing_address->b_name}}" @else placeholder="Name" @endif>
														</div>
														<div class="col-sm-6">
															<input type="text" name="b_contact" class="form-control" @if(!empty($billing_address->b_contact)) value="{{$billing_address->b_contact}}" @else placeholder="10-digit mobile number" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="text" name="b_pincode" class="form-control" @if(!empty($billing_address->b_pincode)) value="{{$billing_address->b_pincode}}" @else placeholder="Pincode" @endif>
														</div>
														<div class="col-sm-6">
															<input type="text" name="b_locality" class="form-control" @if(!empty($billing_address->b_locality)) value="{{$billing_address->b_locality}}" @else placeholder="Locality" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-12">
															<textarea class="form-control" name="b_address" rows="3" placeholder="Address (Area and Street)">
															@if(!empty($billing_address->b_address))  {{$billing_address->b_address}} @endif
															</textarea>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="text" name="b_city" class="form-control" @if(!empty($billing_address->b_locality)) value="{{$billing_address->b_locality}}" @else placeholder="City/District/Town" @endif>
														</div>
														<div class="col-sm-6">
															<input type="text" name="b_landmark" class="form-control" @if(!empty($billing_address->b_landmark)) value="{{$billing_address->b_landmark}}" @else placeholder="Landmark (Optional)" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-4">
															<select class="form-control" id="country" name="b_country" onChange="getStates(this.selectedIndex)" required>
																<option value="">Select Country</option>
																@foreach($countries as $row)
																@if(!empty($billing_address->b_country))
																<option value="{{$row->id}}" @if($row->id==$billing_address->b_country) selected @endif>{{$row->name}}</option>
																@else
																<option value="{{$row->id}}">{{$row->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-4">
															<select class="form-control" id="states" name="b_state" onChange="getStatesId(this.selectedIndex)" >
																<option value="">Select State</option>
																@foreach($states as $row)
																@if(!empty($billing_address->b_state))
																<option value="{{$row->id}}" @if($row->id==$billing_address->b_state) selected @endif>{{$row->name}}</option>
																@else
																<option value="{{$row->id}}">{{$row->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-4">
															<input type="text" name="b_contact2" class="form-control" @if(!empty($billing_address->b_contact2)) value="{{$billing_address->b_contact2}}" @else placeholder="Alternate Phone (Optional)" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="radio-button guest-check" for="guest" style="margin-left:40px;"><b>Address Type</b></label>
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input id="guest" type="radio" name="b_address_type" value="home" checked>
															<label class="radio-button guest-check" for="guest">Home (All day delivery)</label>
														</div>
														<div class="col-sm-6">
															<input id="guest" type="radio" name="b_address_type" value="work">
															<label class="radio-button guest-check" for="guest">Work (Delivery between 10AM-5PM)</label>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-12">
															<input type="submit" class="button remove-item" value="Save" style="background-color:#88be4c" />
															<input type="reset" class="button remove-item" value="Cancel" style="background-color:#88be4c">
														</div>
													</div>
												</div>

											</form>
										</div>
									</div>
								</div>
								<!--End Add Address-form  -->
							</div>
						</div>
						<!--End checkout-step-02 If Auth -->

						@else
						<!-- checkout-step-02  -->
						<div class="panel panel-default checkout-step-02">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseTwo">
										<span>2</span> Billing Address
									</a>
								</h4>
							</div>
							<!-- panel-heading -->

						</div>
						@endif


						@if(Auth::check())
						<!-- checkout-step-02 If Auth -->
						<div class="panel panel-default checkout-step-02">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
										<span>3</span> Shipping Address @if(!empty($shipping_address->name)) <i class="fa fa-check"></i> @endif
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">

								<div class="panel-body">
									<?php $add_id = ""; ?>
									@if(!empty($shipping_address))
									<?php $add_id = $shipping_address->id; ?>
									@endif
									<!-- </form> -->


								</div>
								<!-- Add Address-form  -->
								<div class="panel panel-default checkout-step-05">
									<div id="collapseFive" class="panel-collapse collapse in">
										<div class="panel-body">
											<form method="POST" action="{{ route('front-shipping-address-store') }}">
												@csrf

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
															<input type="text" name="name" class="form-control" @if(!empty($billing_address->b_name)) value="{{$billing_address->b_name}}" @else placeholder="Name" @endif>
														</div>
														<div class="col-sm-6">
															<input type="text" name="contact" class="form-control" @if(!empty($billing_address->b_contact)) value="{{$billing_address->b_contact}}" @else placeholder="10-digit mobile number" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="text" name="pincode" class="form-control" @if(!empty($billing_address->b_pincode)) value="{{$billing_address->b_pincode}}" @else placeholder="Pincode" @endif>
														</div>
														<div class="col-sm-6">
															<input type="text" name="locality" class="form-control" @if(!empty($billing_address->b_locality)) value="{{$billing_address->b_locality}}" @else placeholder="Locality" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-12">
															<textarea class="form-control" name="address" rows="3" placeholder="Address (Area and Street)">
															@if(!empty($billing_address->b_address))  {{$billing_address->b_address}} @endif
															</textarea>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input type="text" name="city" class="form-control" @if(!empty($billing_address->b_city)) value="{{$billing_address->b_city}}" @else placeholder="City/District/Town" @endif>
														</div>														
														<div class="col-sm-6">
															<input type="text" name="landmark" class="form-control" @if(!empty($billing_address->b_landmark)) value="{{$billing_address->b_landmark}}" @else placeholder="Landmark (Optional)" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-4">
															<select class="form-control" id="country_id" name="country" onChange="getState(this.selectedIndex)" required>
																<option value="">Select Country</option>
																@foreach($countries as $row)
																@if(!empty($billing_address->b_country))
																<option value="{{$row->id}}" @if($row->id==$billing_address->b_country) selected @endif>{{$row->name}}</option>
																@else
																<option value="{{$row->id}}">{{$row->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-4">
															<select class="form-control" id="states_id" name="state" onChange="getStateId(this.selectedIndex)">
																<option value="">Select State</option>
																@foreach($states as $row)
																@if(!empty($billing_address->b_state))
																<option value="{{$row->id}}" @if($row->id==$billing_address->b_state) selected @endif>{{$row->name}}</option>
																@else
																<option value="{{$row->id}}">{{$row->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-4">
															<input type="text" name="contact2" class="form-control" @if(!empty($billing_address->b_contact2)) value="{{$billing_address->b_contact2}}" @else placeholder="Alternate Phone (Optional)" @endif>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="radio-button guest-check" for="guest" style="margin-left:40px;"><b>Address Type</b></label>
													<div class="col-sm-12">
														<div class="col-sm-6">
															<input id="guest" type="radio" name="address_type" value="home" checked>
															<label class="radio-button guest-check" for="guest">Home (All day delivery)</label>
														</div>
														<div class="col-sm-6">
															<input id="guest" type="radio" name="address_type" value="work">
															<label class="radio-button guest-check" for="guest">Work (Delivery between 10AM-5PM)</label>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-12">
															<input type="submit" class="button remove-item" value="Same As Billing Address" style="background-color:#88be4c"/>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-12">
														<div class="col-sm-12">
															<input type="submit" class="button remove-item" value="Save And Deliver Here" style="background-color:#88be4c"/>
															<input type="reset" class="button remove-item" value="Cancel" style="background-color:#88be4c"/>
														</div>
													</div>
												</div>

											</form>
										</div>
									</div>
								</div>
								<!--End Add Address-form  -->
							</div>
						</div>
						<!--End checkout-step-02 If Auth -->

						@else
						<!-- checkout-step-02  -->
						<div class="panel panel-default checkout-step-02">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseTwo">
										<span>3</span> Shipping Address
									</a>
								</h4>
							</div>
							<!-- panel-heading -->

						</div>
						@endif


						@if(Auth::check() )
						<!-- checkout-step-03 If Auth -->
						<div class="panel panel-default checkout-step-03">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix">
										<span>4</span> Order Review @if(count($carts)!=0) <i class="fa fa-check"></i> @endif
									</a>
								</h4>
							</div>
							<div id="collapseSix" class="panel-collapse collapse">
								<div class="panel-body">
									@if(!empty($carts))
									<table class="table">
										<thead>
											<tr>
												<th class="cart-description item">Image</th>
												<th class="cart-product-name item">Product</th>
												<th class="cart-product-name item">Brand</th>
												<th class="cart-edit item">Weight</th>
												<th class="cart-edit item">Price</th>
												<th class="cart-qty item">Qty</th>
												<th class="cart-total last-item">SubWeight</th>
												<th class="cart-sub-total item">Sub Total</th>
												<th class="cart-total last-item">GST</th>
											</tr>
										</thead><!-- /thead -->

										<tbody>
											<?php $total = 0;
											$total_weight = 0; ?>

											@foreach($carts as $cart)
											<tr id="cartpage">
												<td class="cart-image">
													<a class="entry-thumbnail" href="{{route('product-detail', $cart->slug)}}">
														<img src="{{URL::to('/')}}/public/images/products/{{$cart['image_url1']}}" alt="" height="40" width="40">
													</a>
												</td>
												<td class="cart-product-name-info">
													<p class='cart-product-description'>
														<a href="{{route('product-detail', $cart->slug)}}">{!! substr($cart['title'] ,0,10) !!}
														</a>
													</p>
												</td>

												<td class="cart-product-edit">
													<p class="product-name">
														{{$cart['brand_name']}}
													</p>
												</td>

												<td>
												    <?php $per_weight=0; ?>
													{{$cart['weight']}}
													@if(!empty($cart['weight']))
														<?php if ($cart['weight'] == '250gm') {
															 $per_weight = 250;
														}
														if ($cart['weight'] == '500gm') {
															 $per_weight = 500;
														}
														if ($cart['weight'] == '1kg') {
															 $per_weight = 1000;
														} ?>
														@endif
												</td>

												<td class="cart-product-edit">
													<span class="price" id="price{{$cart['cart_id']}}" style="color: #000000;">₹{{$cart->sale_price}}</span>
												</td>
												<td class="cart-product-quantity">
													{{$cart['cart_quantity']}}
												</td>

												<td>
													<span class="cart-price">
														<span class="weight" id="sub_weight{{$cart['cart_id']}}">
															<?php echo $sub_weight = ($per_weight *  $cart->cart_quantity)/1000; ?>kg
														</span>
													</span>
												</td>
												<td class="cart-product-sub-total">
													<span class="cart-sub-total-price" id="amount{{$cart['cart_id']}}">
														₹ <?php echo  $amount = $cart->sale_price *  $cart->cart_quantity; ?>
													</span>
												</td>
												<td class="cart-product-quantity">
													{{$cart['gst_in_percentage']}}%
												</td>
											</tr>
											<?php //$total += ($cart->sale_price *  $cart->cart_quantity); ?>
											<?php $total_weight += $per_weight *  $cart->cart_quantity; ?>
											@endforeach
										</tbody><!-- /tbody -->
									</table><!-- /table -->
									@if(count($carts)==0)
									<h4>No product found in your cart</h4>
									<div class="shopping-cart-btn">
										<span class="">
											<a href="{{route('shop')}}" class="btn btn-upper btn-primary pull-right outer-right-xs">Continue Shopping</a>
											<!-- <a href="#" class="btn btn-upper btn-primary outer-left-xs">Update shopping cart</a> -->
										</span>
									</div>
									@endif
									@endif
								</div>
							</div>
						</div>
						<!--End checkout-step-03 If Auth -->

						@else
						<!-- checkout-step-03  -->
						<div class="panel panel-default checkout-step-03">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseSix">
										<span>4</span> Order Review
									</a>
								</h4>
							</div>
							<!-- panel-heading -->

						</div>
						<!-- checkout-step-03  -->
						@endif






						@if(Auth::check() && count($carts)!=0 && !empty($shipping_address) && !empty($billing_address))
						<!-- checkout-step-04 If Auth -->
						<div class="panel panel-default checkout-step-04">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
										<span>5</span> Payment Information
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
									<form action="{{route('front-place-order')}}" method="POST">
										@csrf
										<div class="form-group row">
											<label class="radio-button guest-check" for="guest">Payment Mode</label>
											<input type="hidden" name="address_id" value="{{$add_id}}" class="address_id">
											<div class="col-sm-12">
												<!-- <div class="col-sm-6">
													<input id="guest" type="radio" name="payment_mode" value="COD" checked>
													<label class="radio-button guest-check" for="guest">Cash On Delivery</label>
												</div> -->
												<!-- <div class="col-sm-6">
													<input id="guest" type="radio" name="payment_mode" value="paypal">
													<label class="radio-button guest-check" for="guest">Pay With Paypal</label>
												</div> -->
												<div class="col-sm-6">
													<input id="guest" type="radio" name="payment_mode" value="Razorpay" onclick="razorPayOnline()">
													<label class="radio-button guest-check" for="guest">Place Order With Razorpay</label>
												</div>

											</div>
										</div>
										<!--<button type="submit" name="place_order_btn" class="button btn-link">Place Order</button>-->
									</form>
								</div>
							</div>
						</div>
						<!--End checkout-step-04 If Auth -->

						@else
						<!-- checkout-step-04  -->
						<div class="panel panel-default checkout-step-04">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<?php if (empty($billing_address->b_name)) { ?>
										<a onclick="billingAddress()">
											<span>5</span> Payment Information
										</a>
									<?php } else if (empty($shipping_address->name)) { ?>
										<a onclick="shippingAddress()">
											<span>5</span> Payment Information
										</a>
									<?php } else { ?>
										<a>
											<span>5</span> Payment Information
										</a>
									<?php } ?>
								</h4>
							</div>
						</div>
						<!-- checkout-step-04  -->
						@endif

					</div><!-- /.checkout-steps -->
				</div>

				@if(Auth::check())
				<div class="col-xs-12 col-sm-3 col-md-3 sidebar">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Price Details</h4>
								</div>
								<div class="">
								    <?php //$shipping_weight_cost=0;?>
									<ul class="list-unstyled">
										<li>Price (<span class="basket-item-count">0</span>) Items
											<span id="total" style="float:right;">₹ {{$total_price}}</span>
										</li>
										<li>GST<span id="total" style="float:right;">₹ {{$total_gst}}</span>
										</li>
										<li>Delivery Charges(including gst) <span style="float:right;" id="delivery_cost">
										@if(!empty($shipping_weight_cost)) ₹ {{$shipping_weight_cost=$shipping_weight_cost->price}} @endif</span>
										{{Session()->put('shipping_cost',$shipping_weight_cost)}}</li>
										<!-- <li>Discount <span style="float:right;" class="discount_price">0</span></li> -->
										<li>
										    
											<?php $total = ($total_price + $shipping_weight_cost + $total_gst); ?>
											<h4>Total Payable
												<span id="total_price" style="float:right;" class="grand_total">
												    ₹ {{$total}}
												</span>
												<h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- checkout-progress-sidebar -->
				</div>
				@else
				<div class="col-xs-12 col-sm-3 col-md-3 sidebar">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Fast and easy check out</h4>
								</div>
							</div>
						</div>
					</div>
					<!-- checkout-progress-sidebar -->
				</div>
				@endif



				{{--<div class="col-xs-12 col-sm-3 col-md-3 sidebar estimate-ship-tax">
					<table class="table">
						<thead>
							<tr>
								<th>
									<span class="estimate-title">Discount Code</span>
									<p>Enter your coupon code if you have one..</p>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="form-group">
										<input type="text" name="coupon_code" id="applyCoupon" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
										<small id="error_coupon" class="text-danger"></small>
									</div>
									<div class="clearfix pull-right">
										<button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY COUPON</button>
									</div>
								</td>
							</tr>
						</tbody><!-- /tbody -->
					</table><!-- /table -->
				</div>--}}<!-- /.estimate-ship-tax -->


			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		<div id="brands-carousel" class="logo-slider wow fadeInUp">

			<div class="logo-slider-inner">
				<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
					<div class="item m-t-15">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item m-t-10">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand3.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand6.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="{{URL::to('/')}}/templates/front/assets/images/blank.gif" alt="">
						</a>
					</div>
					<!--/.item-->
				</div><!-- /.owl-carousel #logo-slider -->
			</div><!-- /.logo-slider-inner -->

		</div><!-- /.logo-slider -->
		<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ============================================================= FOOTER ============================================================= -->
<!-- ============================================================= FOOTER ============================================================= -->

<!-- ============================================== INFO BOXES ============================================== -->
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
<!-- /.info-boxes -->
<!-- ============================================== INFO BOXES : END ============================================== -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
	function addressShip(id) {
		var _token = "{{csrf_token()}}";
		var address = $('input[name=address_id]').val(id);
		var qs = {
			id: id,
			_token: _token
		};
		$.ajax({
			url: "",
			method: "GET",
			data: qs,
			success: function(result) {
				// alert(JSON.stringify(qs.id));
				$('.address_id').text(qs.id);
			},
			error: function(request, status, error) {
				console.log('Error is' + request.responseText);
			}
		});
	}
</script>
<script type="text/javascript">
	function ShowHideDiv() {
		var paymentMode = document.getElementById("paymentMode");
		var paymentModeDiv = document.getElementById("paymentModeDiv");
		paymentModeDiv.style.display = paymentMode.value == "Online" ? "block" : "none";

	}

	function updateWeight(id, cartId) {
		var varient_id = document.getElementById('varient_id' + cartId).options[id].value;
		var qs = {
			'_token': "{{csrf_token()}}",
			'varient_id': varient_id,
			'id': cartId
		};
		// alert(JSON.stringify(qs));

		$.ajax({
			url: "{{ route('ajax-update-cart-varientId') }}",
			method: "POST",
			data: qs,
			success: function(result) {
				// alert(JSON.stringify(result));
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
				document.getElementById('sub_weight' + cartId).innerHTML = result.quantity * sub_weight + 'gm';
				$('#total').load(location.href + ' #total');
				$('#total_weight').load(location.href + ' #total_weight');
				$('#total_price').load(location.href + ' #total_price');

			},
			error: function(request, status, error) {
				console.log('Error is' + request.responseText);
			}
		});
	}

	function applyCoupon() {
		var _token = "{{csrf_token()}}";
		var coupon_code = $('input[name=coupon_code]').val();
		if ($.trim(coupon_code).length == 0) {
			error_coupon = "Please enter valid Coupon";
			$('#error_coupon').text(error_coupon);
		} else {
			error_coupon = '';
			$('#error_coupon').text(error_coupon);
		}

		if (error_coupon != '') {
			return false;
		}

		var qs = {
			coupon_code: coupon_code,
			_token: _token
		};

		$.ajax({
			url: "{{ route('ajax-front-apply-coupon-code') }}",
			type: 'POST',
			data: qs,
			success: function(response) {
				if (response.error_status == 'error') {
					alertify.set('notifier', 'position', 'bottom-right');
					alertify.success(response.status);
					$('input[name=coupon_code]').val('');
				} else {
					var discount_price = response.discount_price;
					var grand_total_price = response.grand_total_price;
					$('.coupon_code').prop('readonly', true);
					$('.discount_price').text(discount_price);

					$('#total').text(grand_total_price);
					$('.grand_total').text(grand_total_price);
				}
			}
		});
	}


	function razorPayOnline(e) {
		var _token = "{{csrf_token()}}";
		var id = $('input[name=address_id]').val();
		var payment_mode = document.querySelector('input[name="payment_mode"]:checked').value;
		var qs = {
			id: id,
			payment_mode: payment_mode,
			amount: 1,
// 			amount: <?php //echo $total; ?>,
			_token: _token
		};
		// alert(JSON.stringify(qs));
		$.ajax({
			url: "{{route('ajax-confirm-razorpay-payment')}}",
			method: "POST",
			data: qs,
			success: function(result) {
				var options = {
					//"key": "<?php //echo get_setting('razorpay_key');?>", // Enter the Key ID generated from the Dashboard
					"key": "rzp_test_4W0fVK0gW8Ziy0", 
					"amount": (1 * 100), // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
				// 	"amount": (<?php //echo $total * 100; ?>), // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
					"currency": "INR",
					"name": "Site Name",
					"description": "Thank you for purchasing",
					"image": "http://localhost/eco/public/images/logo.png",
					// "order_id": "order_HxHFO7GyLWQQsH", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
					"handler": function(razorpay_response) {
						// alert(JSON.stringify(razorpay_response));
						$.ajax({
							url: "{{route('front-place-order')}}",
							method: "POST",
							data: {
								'_token': _token,
								'address_id': result.address_id,
								'payment_mode': result.payment_mode,
								'razorpay_payment_id': razorpay_response.razorpay_payment_id,
								'place_order_razorpay': true,
							},
							success: function(response) {
								var data = JSON.parse(response);
								// console.log(data);
								// console.log(response.data);
								// console.log(response.payment_status);
								//  console.log(data.payment_status);
								if (data.payment_status == 'approved') {
									window.location.href = "{{url('/thank-you')}}";
									//location.href = "http://www.example.com/ThankYou.html";
								} else {
									console.log('Error is' + data);
								}
							},
							error: function(request, status, error) {
								console.log('Error is' + request.responseText);
							}
						});
					},
					"prefill": {
						"name": result.name,
						"contact": result.contact,
						"email": result.email
					},
					"theme": {
						"color": "#3399cc"
					}
				};
				var rzp1 = new Razorpay(options);
				rzp1.open();
				e.preventDefault();
			},
			error: function(request, status, error) {
				console.log('Error is' + request.responseText);
			}
		});
	}
</script>

<script>
	function shippingAddress() {
		alert("Plaese Fill Shipping Address First.")
	}

	function billingAddress() {
		alert("Plaese Fill Billing Address First.")
	}

	function getStates(id) {
		var country_id = document.getElementById('country').options[id].value;
		var queryString = {
			'_token': "{{csrf_token()}}",
			'country_id': country_id
		};
// 		alert(JSON.stringify(queryString));
		jQuery.ajax({
			url: "{{ route('ajax.get-states') }}",
			data: queryString,
			type: "POST",
			success: function(data) {
				// alert(JSON.stringify(data));
				var html = "<option value=''>Select one</option>";
				$.each(data, function(i, item) {
					html = html + "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
				});
				$("#states").html(html);
			},
			error: function(request, status, error) {
				document.getElementById("loader").style.display = "none";
				console.log("Error is: " + request.responseText);
			}
		});
	}
	
	function getState(id) {
		var country_id = document.getElementById('country_id').options[id].value;
		var queryString = {
			'_token': "{{csrf_token()}}",
			'country_id': country_id
		};
// 		alert(JSON.stringify(queryString));
		jQuery.ajax({
			url: "{{ route('ajax.get-states') }}",
			data: queryString,
			type: "POST",
			success: function(data) {
				// alert(JSON.stringify(data));
				var html = "<option value=''>Select one</option>";
				$.each(data, function(i, item) {
					html = html + "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
				});
				$("#states_id").html(html);
			},
			error: function(request, status, error) {
				document.getElementById("loader").style.display = "none";
				console.log("Error is: " + request.responseText);
			}
		});
	}
	
	function getStatesId(id) {
		var state_id = document.getElementById('states').options[id].value;
// 		alert(state_id);
		var queryString = {
			'_token': "{{csrf_token()}}",
			'state_id': state_id
		};
// 		alert(JSON.stringify(queryString));
		jQuery.ajax({
			url: "{{ route('ajax.get-shipping-cost') }}",
			data: queryString,
			type: "POST",
			success: function(data) {
				// alert(JSON.stringify(data));
				document.getElementById("total").innerHTML = '₹' +data.total_amount;
				
				document.getElementById('delivery_cost').innerHTML = '₹' +data.shipping_cost;
				document.getElementById('total_price').innerHTML = '₹' +data.grand_amount;
				
			},
			error: function(request, status, error) {
				document.getElementById("loader").style.display = "none";
				console.log("Error is: " + request.responseText);
			}
		});
	}
	
	function getStateId(id) {
		var state_id = document.getElementById('states_id').options[id].value;
// 		alert(state_id);
		var queryString = {
			'_token': "{{csrf_token()}}",
			'state_id': state_id
		};
// 		alert(JSON.stringify(queryString));
		jQuery.ajax({
			url: "{{ route('ajax.get-shipping-cost') }}",
			data: queryString,
			type: "POST",
			success: function(data) {
				// alert(JSON.stringify(data));
				document.getElementById("total").innerHTML = '₹' +data.total_amount;
				
				document.getElementById('delivery_cost').innerHTML = '₹' +data.shipping_cost;
				document.getElementById('total_price').innerHTML = '₹' +data.grand_amount;
				
			},
			error: function(request, status, error) {
				document.getElementById("loader").style.display = "none";
				console.log("Error is: " + request.responseText);
			}
		});
	}
</script>
@endsection