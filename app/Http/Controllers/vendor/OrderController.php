<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function orders_show()
    {
        $orders=OrderItem::with('relProductVarient')->where('vendor_id',Auth::user()->id)->get();
        // dd($orders[0]->relOrder);
        return view('vendor.orders.orders_show', compact('orders'));
    }
    
    public function order_view($id)
    {
        $order=Order::find($id);
        // dd($order);
        return view('vendor.orders.order_view', compact('order'));
    }
    
    // public function generate_invoice($id)
    // {
    //     $order=Order::find($id);
    //     $order_items=OrderItem::with('relProductVarient')->where('order_id',$id)->get();
    //     // return view('generate_invoice');
        
    //     $data = [
    //         'order' => $order,
    //         'order_items' => $order_items
    //     ];
    //     $pdf = PDF::loadView('generate_invoice', $data);
        
    //     return $pdf->download('ecommerce_invoice.pdf');
    // }
    
    public function order_edit($id)
    {
        $order=Order::find($id);
        // dd($order);
        return view('vendor.orders.order_edit', compact('order'));
    }
    
    public function order_update_tracking_status(Request $request)
    {
        $orders = Order::find($request->get('id'));
        if($orders->order_status != "canceled"){
            $orders->tracking_msg = $request->get('tracking_msg');
            $orders->update();
            return redirect()->back()->with('success', 'Tracking Status Update');
        }else{
            return redirect()->back()->with('success', 'Order Is Canceled');
        }
    }
    
    public function order_cancel_order(Request $request)
    {
        $orders = Order::find($request->get('id'));
        if($orders->tracking_msg != null){
            $orders->cancel_reason = $request->get('cancel_reason');
            $orders->tracking_msg = "Canceled when ".$orders->tracking_msg;
            $orders->order_status = "Canceled";
            $orders->update();
            return redirect()->back()->with('success', 'Order Canceled');
        }else{
            return redirect()->back()->with('success', 'Update Your Tracking Status');
        }
    }
    
    public function order_complete_order(Request $request)
    {
        $orders = Order::find($request->get('id'));
        if($orders->tracking_msg != null){
            if($orders->order_status != "Canceled"){
                $orders->tracking_msg = "Completed when ".$orders->tracking_msg;
                if($orders->payment_status == "pending"){
                    $orders->payment_status = $request->get("cash_received") == TRUE ? "Approved" : "pending";
                }
                $orders->order_status = "Completed";
                $orders->update();
                return redirect()->back()->with('success', 'Order Completed');
            }else{
                return redirect()->back()->with('success', 'Your Order Is Canceled');
            }
        }else{
            return redirect()->back()->with('success', 'Update Your Tracking Status');
        }
    }

    public function order_status_update(Request $request)
    {
        // dd($request->input());
        OrderItem::where('id',$request->id)->update([
            'order_status'=>($request->order_status)
        ]);
        $order_item=OrderItem::find($request->id);
        // $order_items=OrderItem::where('order_id',$order_item->order_id)->get();
        
            $order_status="completed";
        if( OrderItem::where(['order_id'=>$order_item->order_id,'order_status'=>'canceled'])->exists()){
            $order_status="canceled";
        }elseif( OrderItem::where(['order_id'=>$order_item->order_id,'order_status'=>''])->exists()){
           $order_status="pending";    
        }
        
        // dd($order_status);
        
        //dd($order_items->toArray());
        // foreach($order_items as $row){
            
        //     if($row->order_status=='accepted'){
        //         $order_status='accepted';
        //     }
        //     if($row->order_status=='canceled'){
        //         $order_status='canceled';
        //         break;
        //     }
        // }
        // if($order_status=='canceled'){
            Order::where(['id'=>$order_item->order_id])->update(['order_status'=>(string)$order_status]);
        // }
        
        
        // else{
        //   Order::where('id',$order_item->order_id)->update([
        //         'order_status'=>'accepted'
        //     ]);
        //     dd("here");
        // }
        
        
        $message=$request->order_status;
        
        
        return ['message'=>$message];
    }


}
