<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function insert_orderitem($order_id,$net_amount=0,$total_weight,$total_gst)
    {
        $str = '1234567890';
        $str = str_shuffle($str);
        $email_otp = substr($str, 0, 6);
            // dd($order_id);


        $to = Auth::user()->email;
        $to_name = Auth::user()->name;
        $from = env('MAIL_USERNAME');
        // dd($from);
        $from_name = env('MAIL_FROM_NAME');
        $body = "Order has been successfully placed. Thanks for choosing " . env('APP_NAME') . ". <br>
        <br>For further details check: " . URL::to('/');

        app('App\Http\Controllers\OrderController')->send_email($to, $to_name, $from, $from_name, 'Email', [
            'greeting' => "<b>Hi user,</b><br>",
            'title' => "<b>Email:</b><br>",
            'body' => $body,
            'footer' => "<b>From: </b>Support team"
        ]);

        $to = User::where('user_type','admin')->pluck('email')->first();
        $to_name = User::where('user_type','admin')->pluck('name')->first();
        app('App\Http\Controllers\OrderController')->send_email($to, $to_name, $from, $from_name, 'Email', [
            'greeting' => "<b>Hi user,</b><br>",
            'title' => "<b>Email:</b><br>",
            'body' => $body,
            'footer' => "<b>From: </b>Support team"
        ]);

        $carts = Cart::select('carts.*', 'products.title as pro_title','products.gst_in_percentage',
                            'products.vendor_id', 'product_varients.sale_price',
                            'product_varients.title as weight')
            ->join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
            ->join('products', 'products.id', '=', 'product_varients.pro_id')
            ->where('user_id', Auth::user()->id)->get();
        // dd($carts);
        
        if (!empty($carts)) {
            foreach ($carts as $row) {
                // $weight=0;
                if($row->weight=='250gm'){
                    $weight=250;
                }
                if($row->weight=='500gm'){
                    $weight=500;
                }
                if($row->weight=='1kg'){
                    $weight=1000;
                }
                $net_amount=$net_amount+($row->sale_price * $row->quantity);
                $shipping_cost=Session::get('shipping_cost');
                $gst=($row->sale_price * $row->quantity) * ($row->gst_in_percentage / 100);
                $total_gst = $total_gst + $gst;
                $total_cgst=$total_gst/2;
                $total_sgst=$total_gst/2;
                $order_item = new OrderItem([
                    'order_id' => $order_id,
                    'varient_id' => $row->varient_id,
                    'vendor_id' => $row->vendor_id,
                    'price' => $row->sale_price,
                    'quantity' => $row->quantity,
                    'amount' => $row->sale_price * $row->quantity,
                    'weight' => $weight * $row->quantity,
                    'gst_in_percentage' => $row->gst_in_percentage,
                    'gst' => $gst,
                    'cgst' => $gst/2,
                    'sgst' => $gst/2,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ]);
                $order_item->save();
            }
            
            Order::where('id', $order_id)->update([
                'total_amount' => $net_amount,
                'grand_amount' => $net_amount+$total_gst+$shipping_cost,
                'weight'=>$total_weight,
                'total_gst'=>$total_gst,
                'total_cgst'=>$total_cgst,
                'total_sgst'=>$total_sgst,
                'shipping_cost'=>$shipping_cost,
            ]);
            Cart::where('user_id', Auth::user()->id)->delete();
            Session::forget('total_price');
            Session::forget('weight');
            Session::forget('shipping_cost');
       
        }
    }

    public function place_order(Request $request)
    {
        if (isset($_POST['place_order_btn'])) {
            $this->validate($request, [
                'address_id' => 'required',
                'payment_mode' => 'required',
            ]);
            //  dd($request->input());
            $tracking_no = rand(111111, 999999);
            $net_amount = 0;
            $total_weight = 0;
            $total_gst = 0;
            $place_order = new Order([
                'user_id' => Auth::user()->id,
                'address_id' => $request->get('address_id'),
                'tracking_no' => $tracking_no,
                'payment_mode' => $request->get('payment_mode'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ]);
            $status = $place_order->save();
            $order_id = $place_order->id;

            $this->insert_orderitem($order_id, $net_amount,$total_weight,$total_gst);
            if ($status) {
                session()->put('order_id', $order_id);
            }
            //dd($place_order['payment_mode']);
            if ($place_order['payment_mode'] == 'paypal') {
                $paypal = new PaypalController;
                return $paypal->getCheckout();
            }
            return redirect()->route('thank-you')->with('success', 'Order Placed successfully');
        }

        if (isset($_POST['place_order_razorpay'])) {

            $tracking_no = rand(111111, 999999);
            //$net_amount = $request->Session()->get('total_price');
            $total_weight = $request->Session()->get('weight');
            $total_gst = 0;
            $net_amount = 0;
           
            $place_order = Order::create([
                'user_id' => Auth::user()->id,
                'address_id' => $request->address_id,
                'tracking_no' => $tracking_no,
                'payment_id' => $request->razorpay_payment_id,
                'payment_mode' => $request->payment_mode,
                // 'online_payment_type' => 'Razorpay',
                'payment_status' => "approved",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // $place_order->save();
            $order_id = $place_order->id;
            
            $this->insert_orderitem($order_id, $net_amount,$total_weight,$total_gst);
                
            return json_encode([
                'payment_status' => 'approved',
            ]);
            // return redirect()->route('thank-you')->with('success','Order Placed successfully');
        }
    }

    public function razorpay_payment(Request $request)
    {
        // return ($request->input());
        $carts = Cart::select('products.*', 'carts.quantity as cart_quantity', 'carts.id as cart_id', 'product_varients.sale_price', 'product_varients.price', 'product_varients.quantity')
            ->join('products', 'products.varient_id', '=', 'carts.varient_id')
            ->join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
            ->where('carts.user_id', Auth::user()->id)->get();
        
        
        return response()->json([
            'address_id' => $request->id,
            'name' => Auth::user()->name,
            'contact' => Auth::user()->contact,
            'email' => Auth::user()->email,
            'total_price' => $request->amount,
            'payment_mode' => $request->payment_mode,
            'payment_status' => "approved",
        ]);
    }


    public function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'approved';
        $order->payment_details = $payment;
        $status = $order->save();
        if ($status) {
            return redirect()->route('thank-you')->with('success', 'Order Placed successfully');
        }
    }


    public function thank_you()
    {
        return view('thank_you');
    }

    public function generate_invoice($id)
    {
        $order = Order::find($id);
        // return view('vendor.orders.generate_invoice');
        $order_items=OrderItem::with('relProductVarient')->where('order_id',$id)->get();
        // return view('vendor.orders.generate_invoice');
       
        $path = URL::to('/').'/public/images/logo.jpg';
        // dd($path);
        $type= pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $data = [
            'order' => $order,
            'order_items' => $order_items,
            'pic' => $pic
        ];
        $pdf = PDF::setOptions(['isHtml5ParserEnable'=>true, 'isRemoteEnabled'=>true])->loadView('generate_invoice', $data);
        
        return $pdf->download('ecommerce_invoice.pdf');
    }
    
 

    public function send_email($to, $to_name, $from, $from_name, $subject, $data)
    {
        \Mail::send('email', $data, function ($message) use ($to, $to_name, $from, $from_name, $subject) {
            $message->to($to, $to_name)->subject($subject);
            $message->from($from, $from_name);
        });
    }

}
