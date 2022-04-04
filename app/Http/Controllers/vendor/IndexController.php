<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $vendor_id = Auth::user()->id;
        $products = Product::where(['is_deleted' => 0, 'vendor_id' => $vendor_id])->orderBy('id', 'DESC')->get();
        $orders=OrderItem::with('relProductVarient')->where('vendor_id',$vendor_id)->get();
        return view('vendor.dashboard',compact('products','orders'));
    }

}
