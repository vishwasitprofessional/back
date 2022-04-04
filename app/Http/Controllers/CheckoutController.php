<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\ShippingWeightCost;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function checkout(Request $request)
    {
        $weight=$request->Session()->get('weight');
        // dd($weight);
        $total_price=$request->Session()->get('total_price');
        $total_gst=$request->Session()->get('total_gst');
        // dd($weight);
        $countries  = Country::get();
        $states = State::where('country_id',101)->get();
        $shipping_address = "";
        $carts = "";
        if(Auth::check()){
            $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            $shipping_weight_cost=0;
            if(!empty($shipping_address->country)){
                if($weight < 1){
                    if($shipping_address->country==101){
                        $shipping_weight_cost=ShippingWeightCost::where('country_id',$shipping_address->country)
                                                                ->where('state_id',$shipping_address->state)
                                                                ->where('weight','=', 1)
                                                                ->orderBy('weight','DESC')->limit(1)->first();
                                                         //dd($shipping_weight_cost);
                    }else{
                        $shipping_weight_cost=ShippingWeightCost::where('country_id',$shipping_address->country)
                                                                ->where('weight','=', 1)
                                                                ->orWhere('state_id',$shipping_address->state)
                                                                ->orderBy('weight','DESC')->limit(1)->first();
                                                         //dd($shipping_weight_cost);
                    }
                }else{
                    if($shipping_address->country==101){
                        $shipping_weight_cost=ShippingWeightCost::where('country_id',$shipping_address->country)
                                                                ->where('state_id',$shipping_address->state)
                                                                ->where('weight','<=', $weight)
                                                                ->orderBy('weight','DESC')->limit(1)->first();
                                                         //dd($shipping_weight_cost);
                    }else{
                        $shipping_weight_cost=ShippingWeightCost::where('country_id',$shipping_address->country)
                                                                ->where('weight','<=', $weight)
                                                                ->orWhere('state_id',$shipping_address->state)
                                                                ->orderBy('weight','DESC')->limit(1)->first();
                                                         //dd($shipping_weight_cost);
                    }
                    
                }
            }
        }

        $billing_address = "";
        $carts = "";
        if(Auth::check()){
            $billing_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
        }
        if(Auth::check()){
            $carts = cart_show();
        }
        return view('checkout',compact('states','shipping_address','carts','billing_address','countries','total_price','shipping_weight_cost','total_gst'));
    }

    public function billing_address_store(Request $request)
    {
        $address=ShippingAddress::where('user_id', Auth::user()->id)->first();
        if(!empty($address->user_id)){
            ShippingAddress::where('user_id', $request->get('user_id'))->update([
                'b_name' => $request->get('b_name'),
                'b_contact' => $request->get('b_contact'),
                'b_pincode' => $request->get('b_pincode'),
                'b_locality' => $request->get('b_locality'),
                'b_address' => $request->get('b_address'),
                'b_city' => $request->get('b_city'),
                'b_state' => $request->get('b_state'),
                'b_country' => $request->get('b_country'),
                'b_landmark' => $request->get('b_landmark'),
                'b_contact2' => $request->get('b_contact2'),
                'b_address_type' => $request->get('b_address_type'),
                
            ]);
        }
        else{
            $this->validate($request, [
                'b_address' => 'required',
                'b_city' => 'required',
                'b_state' => 'required',
                'b_pincode' => 'required',
            ]);

            $shipping_address = new ShippingAddress([
                'user_id' => Auth::user()->id,
                'b_name' => $request->get('b_name'),
                'b_contact' => $request->get('b_contact'),
                'b_pincode' => $request->get('b_pincode'),
                'b_locality' => $request->get('b_locality'),
                'b_address' => $request->get('b_address'),
                'b_city' => $request->get('b_city'),
                'b_state' => $request->get('b_state'),
                'b_country' => $request->get('b_country'),
                'b_landmark' => $request->get('b_landmark'),
                'b_contact2' => $request->get('b_contact2'),
                'b_address_type' => $request->get('b_address_type'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ]);
            $shipping_address->save();
        }
        return redirect()->route('checkout');
    }

    

    public function shipping_address_store(Request $request)
    {
        $address=ShippingAddress::where('user_id', Auth::user()->id)->first();
        if(!empty($address->user_id)){
            ShippingAddress::where('user_id', $request->get('user_id'))->update([                
                'name' => $request->get('name'),
                'contact' => $request->get('contact'),
                'pincode' => $request->get('pincode'),
                'locality' => $request->get('locality'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'country' => $request->get('country'),
                'landmark' => $request->get('landmark'),
                'contact2' => $request->get('contact2'),
                'address_type' => $request->get('address_type'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ]);
        }
        else{
            $this->validate($request, [
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'pincode' => 'required',
            ]);

            $shipping_address = new ShippingAddress([
                'user_id' => Auth::user()->id,
                'name' => $request->get('name'),
                'contact' => $request->get('contact'),
                'pincode' => $request->get('pincode'),
                'locality' => $request->get('locality'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'country' => $request->get('country'),
                'landmark' => $request->get('landmark'),
                'contact2' => $request->get('contact2'),
                'address_type' => $request->get('address_type'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ]);
            $shipping_address->save();
        }
        return redirect()->route('checkout');
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;

        if(Coupon::where('coupon_code', $coupon_code)->exists()){
            $coupon = Coupon::where('coupon_code',$coupon_code)->first();

            if($coupon->start_datetime <= Carbon::today()->format('Y-m-d H:i:s') && Carbon::today()->format('Y-m-d H:i:s') <= $coupon->end_datetime){
                $carts = Cart::where('user_id', Auth::user()->id)->get();
                $total = 0;
                foreach ($carts as $row) {
                    $product = Product::where('id', $row->pro_id)->first();
                    $total=$total+($row->quantity*$product->sale_price);
                }

                if($coupon->coupon_type == 'percent'){
                    $discount_price = ($total/100)*$coupon->coupon_price;
                }
                elseif($coupon->coupon_type == 'fixed'){
                    $discount_price = $coupon->coupon_price;
                }
                $grand_total = $total-$discount_price;
                
                return response()->json([
                    'discount_price' =>$discount_price,
                    'grand_total_price' => $grand_total,
                ]);

            }else{
                return response()->json([
                    'status' => 'Coupon Code has been Expired.',
                    'error_status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'Coupon Code does  not exists.',
                'error_status' => 'error'
            ]);
        }
    } 
    
    public function ajax_get_states(Request $request){
        return $states=State::where('country_id',$request->country_id)->get();
    }
    
    public function ajax_get_shipping_cost(Request $request){
        $state=State::where('id',$request->state_id)->first();
        
        $weight=$request->Session()->get('weight');
        
        if($weight < 1){
            if($state->country_id==101){
                $shipping_weight_cost=ShippingWeightCost::where('country_id',$state->country_id)
                                                        ->where('state_id',$request->state_id)
                                                        ->where('weight','=', 1)
                                                        ->orderBy('weight','DESC')->limit(1)->first();
                                                 //dd($shipping_weight_cost);
            }else{
                $shipping_weight_cost=ShippingWeightCost::where('country_id',$state->country_id)
                                                        ->where('weight','=', 1)
                                                        ->orWhere('state_id',$request->state_id)
                                                        ->orderBy('weight','DESC')->limit(1)->first();
                                                 //dd($shipping_weight_cost);
            }
        }else{
            if($state->country_id==101){
                $shipping_weight_cost=ShippingWeightCost::where('country_id',$state->country_id)
                                                        ->where('state_id',$request->state_id)
                                                        ->where('weight','<=', $weight)
                                                        ->orderBy('weight','DESC')->limit(1)->first();
                                                 //dd($shipping_weight_cost);
            }else{
                $shipping_weight_cost=ShippingWeightCost::where('country_id',$state->country_id)
                                                        ->where('weight','<=', $weight)
                                                        ->orWhere('state_id',$request->state_id)
                                                        ->orderBy('weight','DESC')->limit(1)->first();
                                                 //dd($shipping_weight_cost);
            }
        }
        
        $total_amount=$request->Session()->get('total_price');       
        return response()->json([
            'shipping_cost' => number_format($shipping_weight_cost->price),
            'total_amount' =>  $total_amount,
            'grand_amount' =>  $total_amount+$shipping_weight_cost->price,
        ]);
    }


}
