<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', [App\Http\Controllers\IndexController::class, 'test'])->name('test');
Route::get('shippingCostUpdate', [App\Http\Controllers\IndexController::class, 'shippingCostUpdate'])->name('shippingCostUpdate');
Route::get('/paypal',function(){
    return view('myOrder');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','adminRedirect'])->name('dashboard');

// route for processing payment
Route::post('/paypal', [App\Http\Controllers\PaymentController::class, 'payWithpaypal'])->name('paypal');

// route for check status of the payment
Route::get('/status', [App\Http\Controllers\PaymentController::class, 'getPaymentStatus'])->name('status');


Route::get('/',[App\Http\Controllers\IndexController::class, 'index'])->middleware(['adminRedirect','vendorRedirect'])->name('index');
Route::get('shop',[App\Http\Controllers\IndexController::class, 'shop'])->name('shop');
Route::post('shop-filter',[App\Http\Controllers\IndexController::class, 'shop_filter'])->name('shop-filter');
Route::get('product-detail/{slug}',[App\Http\Controllers\IndexController::class, 'product_detail'])->name('product-detail');

//search product & autosearch product
Route::get('autosearch',[App\Http\Controllers\IndexController::class, 'autoSearch'])->name('autosearch');
Route::get('searching',[App\Http\Controllers\IndexController::class, 'search'])->name('searching');


Route::get('product-cat/{slug}',[App\Http\Controllers\IndexController::class, 'product_cat'])->name('product-cat');

Route::get('product-brand/{cat_id?}/{vendor_id?}',[App\Http\Controllers\IndexController::class, 'product_brand'])->name('product-brand');
Route::get('product-multi-brand/{vendor_id}',[App\Http\Controllers\IndexController::class, 'product_multi_brand'])->name('product-multi-brand');
Route::post('product-multi-brand-filter',[App\Http\Controllers\IndexController::class, 'product_multi_brand_filter'])->name('product-multi-brand-filter');
Route::get('brand',[App\Http\Controllers\IndexController::class, 'brand'])->name('brand');

Route::get('wishlist',[App\Http\Controllers\CartController::class, 'wishlist'])->name('wishlist');

Route::get('cart',[App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::post('update-cart',[App\Http\Controllers\CartController::class, 'update_cart'])->name('ajax-update-cart');
Route::post('add-to-cart',[App\Http\Controllers\CartController::class, 'addtocart'])->name('ajax-add-to-cart');
Route::get('load-cart-data',[App\Http\Controllers\CartController::class, 'cartloadbyajax'])->name('ajax-load-cart-data');
Route::delete('delete-cart',[App\Http\Controllers\CartController::class, 'delete_cart'])->name('ajax-delete-cart');
Route::get('clear-cart',[App\Http\Controllers\CartController::class, 'clear_cart'])->name('ajax-clear-cart');
Route::post('update-cart-varientId',[App\Http\Controllers\CartController::class, 'update_cart_varientId'])->name('ajax-update-cart-varientId');

Route::get('checkout',[App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::post('shipping-address-store',[App\Http\Controllers\CheckoutController::class, 'shipping_address_store'])->name('front-shipping-address-store');
// Route::patch('shipping-address-update',[App\Http\Controllers\CheckoutController::class, 'shipping_address_update'])->name('front-shipping-address-update');

Route::post('billing-address-store',[App\Http\Controllers\CheckoutController::class, 'billing_address_store'])->name('front-billing-address-store');
Route::post('apply-coupon-code', [\App\Http\Controllers\CheckoutController::class, 'apply_coupon_code'])->name('ajax-front-apply-coupon-code');
Route::post('ajax-get-states',[\App\Http\Controllers\CheckoutController::class, 'ajax_get_states'])->name('ajax.get-states');
Route::post('ajax-get-shipping-cost',[\App\Http\Controllers\CheckoutController::class, 'ajax_get_shipping_cost'])->name('ajax.get-shipping-cost');

//paypal section
Route::get('paypal/payment/cancel',[App\Http\Controllers\PaypalController::class, 'getCancel']);
Route::get('paypal/payment/done',[App\Http\Controllers\PaypalController::class, 'getDone']);


Route::post('contact-form-create-action', [App\Http\Controllers\IndexController::class, 'contact_form_create_action'])->name('contact-form-create-action');
Route::post('ajax-update-weight',[App\Http\Controllers\IndexController::class, 'update_weight'])->name('ajax-update-weight');

Route::post('email-subscriber-create-action', [App\Http\Controllers\IndexController::class, 'email_subscriber_create_action'])->name('email-subscriber-create-action');

Route::post('place-order',[App\Http\Controllers\OrderController::class, 'place_order'])->name('front-place-order');
Route::get('thank-you',[App\Http\Controllers\OrderController::class, 'thank_you'])->name('thank-you');
Route::post('confirm-razorpay-payment',[App\Http\Controllers\OrderController::class, 'razorpay_payment'])->name('ajax-confirm-razorpay-payment');
Route::get('success', [\App\Http\Controllers\OrderController::class, 'booking_payment_success']);
Route::get('fail', [\App\Http\Controllers\OrderController::class, 'booking_payment_fail']);

Route::get('/status', [App\Http\Controllers\PaymentController::class, 'getPaymentStatus'])->name('status');
Route::get('order-success',[App\Http\Controllers\OrderController::class, 'success'])->name('success');
//Route::post('confirm-razorpay-payment',[App\Http\Controllers\OrderController::class, 'razorpay_payment'])->name('ajax-confirm-razorpay-payment');

Route::get('vendor-register', [App\Http\Controllers\IndexController::class, 'vendor_register'])->name('vendor-register');
Route::post('vendor-register-action', [App\Http\Controllers\IndexController::class, 'vendor_register_action'])->name('vendor-register-action');

Route::get('user-account',[App\Http\Controllers\UserController::class, 'user_account'])->name('front-user-account');
Route::get('user-orders-show',[App\Http\Controllers\UserController::class, 'user_orders_show'])->name('front-user-orders-show');
Route::get('user-order-view/{id}', [\App\Http\Controllers\UserController::class, 'user_order_view'])->name('front-order-view');
Route::get('user-order-edit/{id}', [\App\Http\Controllers\UserController::class, 'user_order_edit'])->name('front-order-edit');
Route::patch('user-order-cancel-order', [\App\Http\Controllers\UserController::class, 'user_order_cancel_order'])->name('front-order-cancel-order');
Route::get('user-order-review/{id}', [\App\Http\Controllers\UserController::class, 'user_order_review'])->name('user-order-review');
Route::post('user-add-review', [\App\Http\Controllers\UserController::class, 'user_add_review'])->name('user-add-review');
Route::post('ajax-user-order-update-status', [\App\Http\Controllers\UserController::class, 'user_order_status_update'])->name('ajax-user-order-update-status');

Route::get('generate-invoice/{id}', [\App\Http\Controllers\OrderController::class, 'generate_invoice'])->name('user-generate-invoice');


Route::get('execelupdate',[App\Http\Controllers\UserController::class, 'execelupdate']);


///////////////ADMIN ROUTES/////////////////////
Route::group(['prefix' => 'admin', 'middleware' => ['userRedirect']], function () {
    Route::get('dashboard', [\App\Http\Controllers\admin\IndexController::class, 'index'])->name('admin-index');

    Route::get('users-show', [\App\Http\Controllers\admin\UserController::class, 'user_show'])->name('users-show');
    Route::get('approved-vendors-show', [\App\Http\Controllers\admin\UserController::class, 'approved_vendor_show'])->name('approved-vendors-show');
    Route::get('approved-vendor-view/{id}', [\App\Http\Controllers\admin\UserController::class, 'approved_vendor_view'])->name('approved-vendor-view');
    Route::get('pending-vendors-show', [\App\Http\Controllers\admin\UserController::class, 'pending_vendor_show'])->name('pending-vendors-show');
    Route::get('pending-vendor-view/{id}', [\App\Http\Controllers\admin\UserController::class, 'pending_vendor_view'])->name('pending-vendor-view');
    Route::post('ajax-vendor-status-update', [\App\Http\Controllers\admin\UserController::class, 'vendor_status_update'])->name('ajax-vendor-status-update');
    
    Route::get('categories-show', [\App\Http\Controllers\admin\CategoryController::class, 'categories_show'])->name('categories-show');
    Route::get('category-create', [\App\Http\Controllers\admin\CategoryController::class, 'category_create'])->name('category-create');
    Route::post('category-create-action', [\App\Http\Controllers\admin\CategoryController::class, 'category_create_action'])->name('category-create-action');
    Route::get('category-edit/{id}', [\App\Http\Controllers\admin\CategoryController::class, 'category_edit'])->name('category-edit');
    Route::patch('category-update-action', [\App\Http\Controllers\admin\CategoryController::class, 'category_update_action'])->name('category-update-action');
    Route::delete('category-delete/{id}', [\App\Http\Controllers\admin\CategoryController::class, 'category_delete'])->name('category-delete');
    Route::post('ajax-category-status-update', [\App\Http\Controllers\admin\CategoryController::class, 'category_status_update'])->name('ajax-category-status-update');
    
    Route::post('ajax-category-get-child', [\App\Http\Controllers\admin\CategoryController::class, 'get_child_by_parent_id'])->name('ajax-category-get-child');

    Route::get('products-show', [\App\Http\Controllers\admin\ProductController::class, 'products_show'])->name('products-show');
    Route::get('product-create', [\App\Http\Controllers\admin\ProductController::class, 'product_create'])->name('product-create');
    Route::post('product-create-action', [\App\Http\Controllers\admin\ProductController::class, 'product_create_action'])->name('product-create-action');
    Route::get('product-edit/{id}', [\App\Http\Controllers\admin\ProductController::class, 'product_edit'])->name('product-edit');
    Route::get('product-view/{id}', [\App\Http\Controllers\admin\ProductController::class, 'product_view'])->name('product-view');
    Route::patch('product-update-action', [\App\Http\Controllers\admin\ProductController::class, 'product_update_action'])->name('product-update-action');
    Route::delete('product-delete/{id}', [\App\Http\Controllers\admin\ProductController::class, 'product_delete'])->name('product-delete');
    Route::post('ajax-product-status-update', [\App\Http\Controllers\admin\ProductController::class, 'product_status_update'])->name('ajax-product-status-update');
    Route::get('bulk-product-create', [\App\Http\Controllers\admin\ProductController::class, 'bulk_product_create'])->name('bulk-product-create');
    Route::post('bulk-product-create-action', [\App\Http\Controllers\admin\ProductController::class, 'bulk_product_create_action'])->name('bulk-product-create-action');
    
    Route::get('product-varients-show/{id}', [\App\Http\Controllers\admin\ProductController::class, 'product_varients_show'])->name('product-varients-show');
    Route::get('product-varients-create/{product_id}', [\App\Http\Controllers\admin\ProductController::class, 'product_varients_create'])->name('product-varients-create');
    Route::post('product-varients-create-action', [\App\Http\Controllers\admin\ProductController::class, 'product_varients_create_action'])->name('product-varients-create-action');
    Route::get('product-varient-edit/{id}', [\App\Http\Controllers\admin\ProductController::class, 'product_varient_edit'])->name('product-varient-edit');
    Route::patch('product-varient-update-action', [\App\Http\Controllers\admin\ProductController::class, 'product_varient_update_action'])->name('product-varient-update-action');
   
    Route::get('orders-show', [\App\Http\Controllers\admin\OrderController::class, 'orders_show'])->name('orders-show');
    Route::get('order-view/{id}', [\App\Http\Controllers\admin\OrderController::class, 'order_view'])->name('order-view');
    Route::get('order-edit/{id}', [\App\Http\Controllers\admin\OrderController::class, 'order_edit'])->name('order-edit');
    Route::patch('order-update-tracking-status', [\App\Http\Controllers\admin\OrderController::class, 'order_update_tracking_status'])->name('order-update-tracking-status');
    Route::patch('order-cancel-order', [\App\Http\Controllers\admin\OrderController::class, 'order_cancel_order'])->name('order-cancel-order');
    Route::patch('order-complete-order', [\App\Http\Controllers\admin\OrderController::class, 'order_complete_order'])->name('order-complete-order');
    Route::post('ajax-order-update-status', [\App\Http\Controllers\admin\OrderController::class, 'order_status_update'])->name('ajax-order-update-status');
    
    Route::get('generate-invoice/{id}', [\App\Http\Controllers\admin\OrderController::class, 'generate_invoice'])->name('generate-invoice');
    
    Route::get('coupons-show', [\App\Http\Controllers\admin\CouponController::class, 'coupons_show'])->name('coupons-show');
    Route::get('coupon-create', [\App\Http\Controllers\admin\CouponController::class, 'coupon_create'])->name('coupon-create');
    Route::post('coupon-create-action', [\App\Http\Controllers\admin\CouponController::class, 'coupon_create_action'])->name('coupon-create-action');
    Route::get('coupon-edit/{id}', [\App\Http\Controllers\admin\CouponController::class, 'coupon_edit'])->name('coupon-edit');
    Route::patch('coupon-update-action', [\App\Http\Controllers\admin\CouponController::class, 'coupon_update_action'])->name('coupon-update-action');
    Route::post('ajax-coupon-visibility-status-update', [\App\Http\Controllers\admin\CouponController::class, 'coupon_visibility_status_update'])->name('ajax-coupon-visibility-status-update');
    
    Route::get('banners-show', [\App\Http\Controllers\admin\BannerController::class, 'banners_show'])->name('banners-show');
    Route::get('banner-create', [\App\Http\Controllers\admin\BannerController::class, 'banner_create'])->name('banner-create');
    Route::post('banner-create-action', [\App\Http\Controllers\admin\BannerController::class, 'banner_create_action'])->name('banner-create-action');
    Route::get('banner-edit/{id}', [\App\Http\Controllers\admin\BannerController::class, 'banner_edit'])->name('banner-edit');
    Route::patch('banner-update-action', [\App\Http\Controllers\admin\BannerController::class, 'banner_update_action'])->name('banner-update-action');
    Route::delete('banner-delete/{id}', [\App\Http\Controllers\admin\BannerController::class, 'banner_delete'])->name('banner-delete');
    Route::post('ajax-banner-status-update', [\App\Http\Controllers\admin\BannerController::class, 'banner_status_update'])->name('ajax-banner-status-update');
    
    Route::get('blogs-show', [\App\Http\Controllers\admin\BlogController::class, 'blogs_show'])->name('blogs-show');
    Route::get('blog-create', [\App\Http\Controllers\admin\BlogController::class, 'blog_create'])->name('blog-create');
    Route::post('blog-create-action', [\App\Http\Controllers\admin\BlogController::class, 'blog_create_action'])->name('blog-create-action');
    Route::get('blog-edit/{id}', [\App\Http\Controllers\admin\BlogController::class, 'blog_edit'])->name('blog-edit');
    Route::patch('blog-update-action', [\App\Http\Controllers\admin\BlogController::class, 'blog_update_action'])->name('blog-update-action');
    Route::delete('blog-delete/{id}', [\App\Http\Controllers\admin\BlogController::class, 'blog_delete'])->name('blog-delete');
    Route::post('ajax-blog-status-update', [\App\Http\Controllers\admin\BlogController::class, 'blog_status_update'])->name('ajax-blog-status-update');
    
    Route::get('sliders-show', [\App\Http\Controllers\admin\SliderController::class, 'sliders_show'])->name('sliders-show');
    Route::get('slider-create', [\App\Http\Controllers\admin\SliderController::class, 'slider_create'])->name('slider-create');
    Route::post('slider-create-action', [\App\Http\Controllers\admin\SliderController::class, 'slider_create_action'])->name('slider-create-action');
    Route::get('slider-edit/{id}', [\App\Http\Controllers\admin\SliderController::class, 'slider_edit'])->name('slider-edit');
    Route::patch('slider-update-action', [\App\Http\Controllers\admin\SliderController::class, 'slider_update_action'])->name('slider-update-action');
    Route::delete('slider-delete/{id}', [\App\Http\Controllers\admin\SliderController::class, 'slider_delete'])->name('slider-delete');
    Route::post('ajax-slider-status-update', [\App\Http\Controllers\admin\SliderController::class, 'slider_status_update'])->name('ajax-slider-status-update');
    
    Route::get('brands-show', [\App\Http\Controllers\admin\BrandController::class, 'brands_show'])->name('brands-show');
    Route::get('brand-create', [\App\Http\Controllers\admin\BrandController::class, 'brand_create'])->name('brand-create');
    Route::post('brand-create-action', [\App\Http\Controllers\admin\BrandController::class, 'brand_create_action'])->name('brand-create-action');
    Route::get('brand-edit/{id}', [\App\Http\Controllers\admin\BrandController::class, 'brand_edit'])->name('brand-edit');
    Route::patch('brand-update-action', [\App\Http\Controllers\admin\BrandController::class, 'brand_update_action'])->name('brand-update-action');
    Route::delete('brand-delete/{id}', [\App\Http\Controllers\admin\BrandController::class, 'brand_delete'])->name('brand-delete');
    Route::post('ajax-brand-status-update', [\App\Http\Controllers\admin\BrandController::class, 'brand_status_update'])->name('ajax-brand-status-update');
    
    Route::get('deal-of-days-show', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_days_show'])->name('deal-of-days-show');
    Route::get('deal-of-day-create', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_create'])->name('deal-of-day-create');
    Route::post('deal-of-day-create-action', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_create_action'])->name('deal-of-day-create-action');
    Route::get('deal-of-day-edit/{id}', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_edit'])->name('deal-of-day-edit');
    Route::patch('deal-of-day-update-action', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_update_action'])->name('deal-of-day-update-action');
    Route::delete('deal-of-day-delete/{id}', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_delete'])->name('deal-of-day-delete');
    Route::post('ajax-deal-of-day-status-update', [\App\Http\Controllers\admin\DealOfDayController::class, 'deal_of_day_status_update'])->name('ajax-deal-of-day-status-update');

    Route::get('featured-products-show', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_products_show'])->name('featured-products-show');
    Route::get('featured-product-create', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_create'])->name('featured-product-create');
    Route::post('featured-product-create-action', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_create_action'])->name('featured-product-create-action');
    Route::get('featured-product-edit/{id}', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_edit'])->name('featured-product-edit');
    Route::patch('featured-product-update-action', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_update_action'])->name('featured-product-update-action');
    Route::delete('featured-product-delete/{id}', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_delete'])->name('featured-product-delete');
    Route::post('ajax-featured-product-status-update', [\App\Http\Controllers\admin\FeaturedProductController::class, 'featured_product_status_update'])->name('ajax-featured-product-status-update');
    
    Route::get('popular-products-show', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_products_show'])->name('popular-products-show');
    Route::get('popular-product-create', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_create'])->name('popular-product-create');
    Route::post('popular-product-create-action', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_create_action'])->name('popular-product-create-action');
    Route::get('popular-product-edit/{id}', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_edit'])->name('popular-product-edit');
    Route::patch('popular-product-update-action', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_update_action'])->name('popular-product-update-action');
    Route::delete('popular-product-delete/{id}', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_delete'])->name('popular-product-delete');
    Route::post('ajax-popular-product-status-update', [\App\Http\Controllers\admin\PopularProductController::class, 'popular_product_status_update'])->name('ajax-popular-product-status-update');
    
    Route::get('general-settings-show', [\App\Http\Controllers\admin\GeneralSettingController::class, 'general_settings_show'])->name('general-settings-show');
    Route::get('general-setting-edit/{id}', [\App\Http\Controllers\admin\GeneralSettingController::class, 'general_setting_edit'])->name('general-setting-edit');
    Route::patch('general-setting-update-action', [\App\Http\Controllers\admin\GeneralSettingController::class, 'general_setting_update_action'])->name('general-setting-update-action');
    
    Route::get('varient-filters-show', [\App\Http\Controllers\admin\VarientFilterController::class, 'varient_filters_show'])->name('varient-filters-show');
    Route::get('varient-filter-create', [\App\Http\Controllers\admin\VarientFilterController::class, 'varient_filter_create'])->name('varient-filter-create');
    Route::post('varient-filter-create-action', [\App\Http\Controllers\admin\VarientFilterController::class, 'varient_filter_create_action'])->name('varient-filter-create-action');
    Route::get('varient-filter-edit/{id}', [\App\Http\Controllers\admin\VarientFilterController::class, 'varient_filter_edit'])->name('varient-filter-edit');
    Route::patch('varient-filter-update-action', [\App\Http\Controllers\admin\VarientFilterController::class, 'varient_filter_update_action'])->name('varient-filter-update-action');
    
    Route::get('contact-forms-show', [\App\Http\Controllers\admin\UserController::class, 'contact_forms_show'])->name('contact-forms-show');
    
    Route::get('email-subscribers-show', [\App\Http\Controllers\admin\UserController::class, 'email_subscribers_show'])->name('email-subscribers-show');
    
    Route::get('reviews-show', [\App\Http\Controllers\admin\ReviewController::class, 'reviews_show'])->name('reviews-show');
    Route::get('review-create', [\App\Http\Controllers\admin\ReviewController::class, 'review_create'])->name('review-create');
    Route::post('review-create-action', [\App\Http\Controllers\admin\ReviewController::class, 'review_create_action'])->name('review-create-action');
    Route::get('review-edit/{id}', [\App\Http\Controllers\admin\ReviewController::class, 'review_edit'])->name('review-edit');
    Route::patch('review-update-action', [\App\Http\Controllers\admin\ReviewController::class, 'review_update_action'])->name('review-update-action');
    Route::delete('review-delete/{id}', [\App\Http\Controllers\admin\ReviewController::class, 'review_delete'])->name('review-delete');
    
    Route::get('videos-show', [\App\Http\Controllers\admin\VideoController::class, 'videos_show'])->name('videos-show');
    Route::get('video-create', [\App\Http\Controllers\admin\VideoController::class, 'video_create'])->name('video-create');
    Route::post('video-create-action', [\App\Http\Controllers\admin\VideoController::class, 'video_create_action'])->name('video-create-action');
    Route::get('video-edit/{id}', [\App\Http\Controllers\admin\VideoController::class, 'video_edit'])->name('video-edit');
    Route::patch('video-update-action', [\App\Http\Controllers\admin\VideoController::class, 'video_update_action'])->name('video-update-action');
    Route::delete('video-delete/{id}', [\App\Http\Controllers\admin\VideoController::class, 'video_delete'])->name('video-delete');
    
    Route::get('google-reviews-show', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_reviews_show'])->name('google-reviews-show');
    Route::get('google-review-create', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_review_create'])->name('google-review-create');
    Route::post('google-review-create-action', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_review_create_action'])->name('google-review-create-action');
    Route::get('google-review-edit/{id}', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_review_edit'])->name('google-review-edit');
    Route::patch('google-review-update-action', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_review_update_action'])->name('google-review-update-action');
    Route::delete('google-review-delete/{id}', [\App\Http\Controllers\admin\GoogleReviewController::class, 'google_review_delete'])->name('google-review-delete');


});




///////////////VENDOR ROUTES/////////////////////
Route::group(['prefix' => 'vendor', 'middleware' => ['userRedirect']], function () {
    Route::get('dashboard', [\App\Http\Controllers\vendor\IndexController::class, 'index'])->name('vendor-index');
    
    Route::get('profile-show', [\App\Http\Controllers\vendor\ProfileController::class, 'profile_show'])->name('vendor-profile-show');
    Route::get('profile-view/{id}', [\App\Http\Controllers\vendor\ProfileController::class, 'profile_view'])->name('vendor-profile-view');
    Route::get('profile-edit/{id}', [\App\Http\Controllers\vendor\ProfileController::class, 'profile_edit'])->name('vendor-profile-edit');
    Route::patch('profile-update-action', [\App\Http\Controllers\vendor\ProfileController::class, 'profile_update_action'])->name('vendor-profile-update-action');

    Route::get('products-show', [\App\Http\Controllers\vendor\ProductController::class, 'products_show'])->name('vendor-products-show');
    Route::get('product-create', [\App\Http\Controllers\vendor\ProductController::class, 'product_create'])->name('vendor-product-create');
    Route::post('product-create-action', [\App\Http\Controllers\vendor\ProductController::class, 'product_create_action'])->name('vendor-product-create-action');
    Route::get('product-edit/{id}', [\App\Http\Controllers\vendor\ProductController::class, 'product_edit'])->name('vendor-product-edit');
    Route::patch('product-update-action', [\App\Http\Controllers\vendor\ProductController::class, 'product_update_action'])->name('vendor-product-update-action');
    Route::delete('product-delete/{id}', [\App\Http\Controllers\vendor\ProductController::class, 'product_delete'])->name('vendor-product-delete');
    Route::post('ajax-product-status-update', [\App\Http\Controllers\vendor\ProductController::class, 'product_status_update'])->name('vendor-ajax-product-status-update');
    
    Route::get('product-varients-show/{id}', [\App\Http\Controllers\vendor\ProductController::class, 'product_varients_show'])->name('vendor-product-varients-show');
    Route::get('product-varients-create/{product_id}', [\App\Http\Controllers\vendor\ProductController::class, 'product_varients_create'])->name('vendor-product-varients-create');
    Route::post('product-varients-create-action', [\App\Http\Controllers\vendor\ProductController::class, 'product_varients_create_action'])->name('vendor-product-varients-create-action');
    Route::get('product-varient-edit/{id}', [\App\Http\Controllers\vendor\ProductController::class, 'product_varient_edit'])->name('vendor-product-varient-edit');
    Route::patch('product-varient-update-action', [\App\Http\Controllers\vendor\ProductController::class, 'product_varient_update_action'])->name('vendor-product-varient-update-action');
    
    Route::post('ajax-category-get-child', [\App\Http\Controllers\vendor\CategoryController::class, 'get_child_by_parent_id'])->name('vendor-ajax-category-get-child');

    Route::get('orders-show', [\App\Http\Controllers\vendor\OrderController::class, 'orders_show'])->name('vendor-orders-show');
    Route::get('order-view/{id}', [\App\Http\Controllers\vendor\OrderController::class, 'order_view'])->name('vendor-order-view');
    Route::get('order-edit/{id}', [\App\Http\Controllers\vendor\OrderController::class, 'order_edit'])->name('vendor-order-edit');
    Route::patch('order-update-tracking-status', [\App\Http\Controllers\vendor\OrderController::class, 'order_update_tracking_status'])->name('vendor-order-update-tracking-status');
    Route::patch('order-cancel-order', [\App\Http\Controllers\vendor\OrderController::class, 'order_cancel_order'])->name('vendor-order-cancel-order');
    Route::patch('order-complete-order', [\App\Http\Controllers\vendor\OrderController::class, 'order_complete_order'])->name('vendor-order-complete-order');
    Route::post('ajax-orderItem-update-status', [\App\Http\Controllers\vendor\OrderController::class, 'order_status_update'])->name('ajax-orderItem-update-status');
    
    Route::get('generate-invoice/{id}', [\App\Http\Controllers\vendor\OrderController::class, 'generate_invoice'])->name('vendor-generate-invoice');
    
});


require __DIR__.'/auth.php';
