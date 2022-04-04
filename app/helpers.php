<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVarient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        return \App\Models\GeneralSetting::value($key);
    }
}


if (!function_exists('cart_show')) {
    // dd("here");
    function cart_show()
    {
        $carts = Cart::select(
            'products.*',
            'carts.quantity as cart_quantity',
            'carts.id as cart_id','carts.varient_id as cart_varient_id',
            'product_varients.title as weight',
            'product_varients.sale_price',
            'product_varients.price',
            'product_varients.quantity',
            'product_varients.slug',
            'product_varients.title as varient_title',
            'users.brand_name as brand_name'
        )
            ->join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
            ->join('products', 'products.id', '=', 'product_varients.pro_id')
            ->join('users', 'users.id', '=', 'products.vendor_id')
            ->where('carts.user_id', Auth::user()->id)->get();
        //  dd($carts);
        return $carts;
    }
}


if (!function_exists('get_categories')) {
    function get_categories()
    {
        return \App\Models\Category::with('relProduct')->where(['is_deleted' => 0, 'is_parent' => 1])->where('status', 'active')->orderBy('created_at', 'ASC')->get();
    }
}


if (!function_exists('get_child_categories')) {
    function get_child_categories($cat_id)
    {
        return Category::where(['parent_id' => $cat_id, 'status' => 'active'])->where('is_deleted', 0)->get();
    }
}

if (!function_exists('get_brands')) {
    function get_brands()
    {
       $vendorsResultSet =\App\Models\Product::with('relVendor')->where(['is_deleted' => 0, 'status' => 'show'])->get()->toArray();
       $vendors=array();
       foreach($vendorsResultSet as $row){
           if(!empty($row['rel_vendor']['brand_name'])){
               $vendors[$row['cat_id']][$row['vendor_id']]=$row['rel_vendor']['brand_name'];
            }
        }
        return $vendors;
    }
}

if (!function_exists('get_multi_brands')) {
    function get_multi_brands()
    {
        $vendors =\App\Models\User::with('relProduct')->where(['approved_status' => 'approved'])->get()->toArray();
        return $vendors;
    }
}

if (!function_exists('min_price')) {
    function min_price()
    {
        return floor(\App\Models\Product::min('sale_price'));
    }
}


if (!function_exists('max_price')) {
    function max_price()
    {
        return floor(\App\Models\Product::max('sale_price'));
    }
}


if (!function_exists('timeAgo')) {
    function timeAgo($time_ago)
    {

        //For human readable date

        // $time_ago = "2013-09+30 01:16:06";
        // echo date("F jS, Y", strtotime($time_ago));

        //For human readable date  //if need not below format then use above

        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed;
        $minutes    = round($time_elapsed / 60);
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400);
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640);
        $years      = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }
}
