<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Review;
use App\Models\VarientFilter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_account()
    {
        return view('user.my_account');
    }

    public function user_orders_show()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        // dd($orders);
        return view('user.orders_show', compact('orders'));
    }

    public function user_order_view($id)
    {
        $order = Order::find($id);
        $order_items=OrderItem::with('relProductVarient')->where('order_id',$id)->get();
       
        return view('user.order_view', compact('order','order_items'));
    }

    public function user_order_edit($id)
    {
        $order = Order::find($id);
        // dd($order);
        return view('user.order_edit', compact('order'));
    }

    public function user_order_cancel_order(Request $request)
    {
        $orders = Order::find($request->get('id'));
        // if($orders->tracking_msg != null){
        $orders->cancel_reason = $request->get('cancel_reason');
        $orders->tracking_msg = "Canceled when " . $orders->tracking_msg;
        $orders->order_status = "Canceled";
        $orders->update();
        return redirect()->back()->with('success', 'Order Canceled');
        // }
        // else{
        //     return redirect()->back()->with('success', 'Update Your Tracking Status');
        // }
    }

    public function user_order_status_update(Request $request)
    {
        // dd($request->input());
         Order::where('id',$request->id)->update([
            'order_status'=>($request->order_status)
        ]);
        $message=$request->order_status;
        return ['message'=>$message];
    }

    public function user_order_review($id)
    {
        $order_item = OrderItem::find($id);
        // dd($order_item);
        return view('user.user_order_review', compact('order_item'));
    }

    public function user_add_review(Request $request)
    {
        $this->validate($request, [
            'order_item_id'     => 'required',
            'rating'     => 'required',
        ]);

        $reviews = new Review([
            'order_item_id' => $request->get('order_item_id'),
            'rating' => $request->get('rating'),
            'customer_name' => $request->get('customer_name'),
            'comment' => $request->get('comment'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //dd("here");
        $reviews->save();
        if ($reviews) {
            $rstatus = OrderItem::findOrFail($request->get('order_item_id'));
            $rstatus->rstatus = true;
            $rstatus->updated_at = date('Y-m-d');
            $rstatus->save();

            if($rstatus){
                $products = ProductVarient::with('relOrderItem')->get();
                foreach($products as $product){
                    // dd($product);
                    $avgrating = 0;
                    // dd($product->relOrderItem);
                    foreach($product->relOrderItem->where('rstatus',1) as $order_item){
                        // dd($order_item->relProductVarient);
                        $avgrating = $avgrating + ($order_item->relReview->rating/$product->relOrderItem->where('rstatus',1)->count());
                        ProductVarient::where('id', $order_item->varient_id)->update(['avg_rating'=>$avgrating]);
                        Product::where('id', $order_item->relProductVarient->pro_id)->update(['avg_rating'=>$avgrating]);
                    }
                }
            }
        }
        return redirect()->route('front-order-view',$request->order_id)->with('success', 'Review Added Successfully');
    }


    public function execelupdate()
    {
        $vendor_id = 1;
        $inputFileType = 'Xlsx';
        $inputFileName = public_path('products.xlsx');
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);
        $i = 0;
        $pro_id = 0;
        foreach ($sheetData as $row) {
            if (!empty($row[3])) {
                if ($i == 0) {
                    $i++;
                    continue;
                }

                if ($row[1] == "SWEETS") {
                    $child_cat_id = 2;
                }
                if ($row[1] == "ORGANIC JAGGERY SWEETS") {
                    $child_cat_id = 3;
                }
                if ($row[1] == "HOT") {
                    $child_cat_id = 4;
                }
                if ($row[1] == "NON-VEG PICKLE") {
                    $child_cat_id = 5;
                }
                if ($row[1] == "VEG PICKLE") {
                    $child_cat_id = 6;
                }
                if ($row[1] == "SPICES") {
                    $child_cat_id = 7;
                }
                if ($row[1] == "MILLET SAVOURIES") {
                    $child_cat_id = 8;
                }
                if ($row[1] == "DAIRY PRODUCTS") {
                    $child_cat_id = 9;
                }

                // $categories = get_categories();
                // $cat_id = "";
                // foreach ($categories as $category) {
                //     $cat_id = $category->id;
                // }
                // $sub_categories=Category::where(['parent_id'=>1, 'status'=>'active'])->where('is_deleted',0)->get();
                // $child_cat_id="";
                // foreach($sub_categories as $sub_category){
                //     // $sub_cat_id=$sub_category->id;
                //     if($row[1] == $sub_category->title){
                //         $child_cat_id=$sub_category->id;
                //     }
                // }
                
                // dd($child_cat_id);
                
                // if ($row[1] == "DAIRY PRODUCTS") {
                //         $cat_id = 9;
                //     }

                // dd($sub_cat_id);

                $products = new Product([
                    // 'id'=>$pro_id,
                    'varient_id' => 1,
                    'title' => $row[3],
                    'cat_id' => 1,
                    'child_cat_id' => $child_cat_id,
                    'vendor_id' => 1,
                    'code' => $row[2],
                    'image_url1' => $row[2] . '.jpg',
                    // 'image_url2' => $row[2] . '.jpg',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ]);
                // dd($products);
                $products->save();

                $varient_filters = VarientFilter::where('cat_id', $products->child_cat_id)
                    ->get();

                $c = 0;
                foreach ($varient_filters as $varient_filters) {
                    $slug = Str::slug($row[1] . '-' . $row[3]);

                    if ($c == 0) {
                        $product_varients = new ProductVarient([
                            'pro_id' => $products->id,
                            'cat_id' => $products->cat_id,
                            'slug' =>  $slug,
                            'child_cat_id' => $products->child_cat_id,
                            'title' =>  $varient_filters->title,
                            'price' => $row[4],
                            'sale_price' => $row[4],
                            'image_url' => $row[2] . '.jpg',
                            'quantity' => 50,
                            'created_at' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d'),
                        ]);
                        $product_varients->save();
                        Product::where('id', $products->id)->update(['varient_id' => $product_varients->id]);
                    }
                    if ($c == 1) {
                        $slug = Str::slug($row[1] . '-' . $row[3] . '-' . $varient_filters->title);
                        $product_varients = new ProductVarient([
                            'pro_id' => $products->id,
                            'cat_id' => $products->cat_id,
                            'slug' =>  $slug,
                            'child_cat_id' => $products->child_cat_id,
                            'title' => $varient_filters->title,
                            'price' => $row[5],
                            'sale_price' => $row[5],
                            'image_url' => $row[2] . '.jpg',
                            'quantity' => 20,
                            'created_at' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d'),
                        ]);
                        $product_varients->save();
                    }
                    if ($c == 2) {
                        $slug = Str::slug($row[1] . '-' . $row[3] . '-' . $varient_filters->title);
                        $product_varients = new ProductVarient([
                            'pro_id' => $products->id,
                            'cat_id' => $products->cat_id,
                            'slug' => $slug,
                            'child_cat_id' => $products->child_cat_id,
                            'title' => $varient_filters->title,
                            'price' => $row[6],
                            'sale_price' => $row[6],
                            'image_url' => $row[2] . '.jpg',
                            'quantity' => 40,
                            'created_at' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d'),
                        ]);
                        $product_varients->save();
                    }
                    $c++;
                }

                $i++;
            }
        }
    }

    public function isProductExists($slug, $vendor_id)
    {
        $products = new Product();
        return $products->isProductExists($slug, $vendor_id);
    }
}
