<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function coupons_show()
    {
        $coupons=Coupon::where('is_deleted',0)->get();
        $pro_title = [];
        foreach($coupons as $row){
            $products = Product::where('id',$row->product_id)->first();
            $pro_title[] = $products['title'];
        }
        // dd($coupons);
        return view('admin.coupons.coupons_show', compact('coupons', 'pro_title'));
    }

    public function coupon_create()
    {
        $coupons=Coupon::where('is_deleted',0)->get();
        $products = Product::where('is_deleted',0)->get();
        // dd($coupons);
        return view('admin.coupons.coupon_create', compact('coupons', 'products'));
    }

    public function coupon_create_action(Request $request)
    {
        $this->validate($request, [
            'offer_name' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'coupon_limit' => 'required',
            'coupon_type' => 'required',
            'coupon_price' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
        ]);

        $coupons = new Coupon([
            'offer_name' => $request->get('offer_name'),
            'product_id' => $request->get('product_id'),
            'coupon_code' => $request->get('coupon_code'),
            'coupon_limit' => $request->get('coupon_limit'),
            'coupon_type' => $request->get('coupon_type'),
            'coupon_price' => $request->get('coupon_price'),
            'start_datetime' => $request->get('start_datetime'),
            'end_datetime' => $request->get('end_datetime'),
            'status' => $request->get('status'),
            'visibility_status' => $request->get('visibility_status'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $coupons->save();
        return redirect()->route('coupons-show')->with('success','Data Added Successfully');
    }

    public function coupon_edit ($id)
    {
        $coupon=Coupon::find($id);
        $products = Product::where('is_deleted',0)->get();
        return view('admin.coupons.coupon_edit', compact('coupon', 'products'));
    }

    public function coupon_update_action(Request $request)
    {              
        $coupon=Coupon::findOrFail($request->get('id'));
        $coupon->offer_name=$request->get('offer_name');
        $coupon->product_id=$request->get('product_id');
        $coupon->coupon_code=$request->get('coupon_code');
        $coupon->coupon_limit=$request->get('coupon_limit');
        $coupon->coupon_type=$request->get('coupon_type');
        $coupon->coupon_price=$request->get('coupon_price');
        $coupon->start_datetime=$request->get('start_datetime');
        $coupon->end_datetime=$request->get('end_datetime');
        $coupon->status=$request->get('status');
        $coupon->visibility_status=$request->get('visibility_status');
        $coupon->updated_at=date('Y-m-d');
        $coupon->save();
        return redirect()->route('coupons-show')->with('success','Data Updated Successfully');
    }
    
    public function coupon_visibility_status_update(Request $request){
        if($request->mode == 'true'){
            Coupon::where('id',$request->id)->update(['visibility_status'=>'show']);
        }else{
            Coupon::where('id',$request->id)->update(['visibility_status'=>'hide']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }

}
