<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pending_orders=Order::where('order_status','pending')->get();
        $products=Product::get();
        $users=User::where('user_type','user')->get();
        $vendors=User::where(['user_type'=>'vendor','approved_status'=>'unapproved'])->get();
        return view('admin.dashboard',compact('pending_orders','products','users','vendors'));
    }

}
