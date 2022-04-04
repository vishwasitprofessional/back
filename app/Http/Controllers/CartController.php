<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function cart()
    {
        $carts = cart_show();
        // dd($carts);
        return view('cart', compact('carts'));
    }

    public function addtocart(Request $request)
    {
        if (Auth::check()) {
            $varient_id = $request->id;
            $quantity = $request->quantity;

            $cart = Cart::select('carts.*', 'products.title as pro_title', 'product_varients.sale_price')
                ->join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
                ->join('products', 'products.id', '=', 'product_varients.pro_id')
                ->where('user_id', Auth::user()->id)
                ->get()->toArray();
            // dd($cart);
            $item_id_list = array_column($cart, 'varient_id');
            $prod_id_is_there = $varient_id;

            if (in_array($prod_id_is_there, $item_id_list)) {
                foreach ($cart as $keys => $values) {
                    if ($cart[$keys]["varient_id"] == $varient_id) {
                        $cart[$keys]["quantity"] = $quantity;
                        $item_data = json_encode($cart);
                        return response()->json(['status' => '"' . $cart[$keys]["pro_title"] . '" Already Added to Cart']);
                    }
                }
            } else {

                $product = ProductVarient::select('products.*', 'product_varients.sale_price', 'product_varients.price', 'product_varients.quantity')
                    ->join('products', 'product_varients.pro_id', "=", 'products.id')
                    // ->join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
                    // ->join('products', 'products.id', '=', 'product_varients.pro_id')
                    ->where('product_varients.id', $varient_id)->first();
                $prod_name = $product->title;
                $prod_image = $product->image_url1;
                $prod_price = $product->sale_price;

                if ($product) {
                    $carts = new Cart([
                        'user_id' => Auth::user()->id,
                        'varient_id' => $varient_id,
                        'quantity' => $quantity,
                        'mode' => 'cart',
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d'),
                    ]);
                    $carts->save();
                    return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
                }
            }
        }
    }

    public function cartloadbyajax()
    {
        if (Auth::check()) {
            $cart_data = Cart::where('user_id', Auth::user()->id)->get();
            $totalcart = count($cart_data);
            echo json_encode(array('totalcart' => $totalcart));
            die;
            return;
        }
    }

    public function update_cart(Request $request)
    {
        if (Auth::check()) {
            $cart_id = $request->id;
            $quantity = $request->quantity;

            Cart::where(['id' => $cart_id, 'user_id' => Auth::user()->id])->update(['quantity' => $quantity]);
            $cart = Cart::join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
                ->join('products', 'products.id', '=', 'product_varients.pro_id')
                ->where('carts.user_id', Auth::user()->id)
                ->select('carts.*', 'products.title as pro_title','product_varients.title as weight','product_varients.sale_price as sale_price')
                ->get()->toArray();
            // dd($cart);
            // $item_id_list = array_column($cart, 'varient_id');
            // $prod_id_is_there = $varient_id;

            // if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart as $keys => $values) {
                if ($cart[$keys]["id"] == $cart_id) {
                    $cart[$keys]["quantity"] = $quantity;
                    $item_data = json_encode($cart);
                    //return response()->json(['status' => '"' . $cart[$keys]['pro_title'] . '" Quantity Updated']);
                    return response()->json([
                        'status' => '"' . $cart[$keys]['pro_title'] . '" Quantity Updated',
                        //'quantity' => $cart[$keys]['quantity'],
                         'price' => $cart[$keys]['sale_price'],
                        'weight' => $cart[$keys]['weight'],
                    ]);
                }
            }
        }
        // }
    }


    public function delete_cart(Request $request)
    {
        if (Auth::check()) {
            $carts = Cart::findOrFail($request->id);
            $carts->delete();
            return response()->json(['status' => 'Item Removed from Cart']);
        }
    }


    public function clear_cart(Request $request)
    {
        if (Auth::check()) {
            $ids = explode(",", $request->id);
            Cart::whereIn('user_id', $ids)->delete();
        } else {
            Cookie::queue(Cookie::forget('shopping_cart'));
        }
        return response()->json(['status' => 'Your Cart is Cleared']);
    }

    public function update_cart_varientId(Request $request)
    {
        if (Auth::check()) {
            $cart_id = $request->id;
            $varient_id = $request->varient_id;

            Cart::where(['id' => $cart_id, 'user_id' => Auth::user()->id])->update(['varient_id' => $varient_id]);
            $cart = Cart::join('product_varients', 'product_varients.id', '=', 'carts.varient_id')
                ->join('products', 'products.id', '=', 'product_varients.pro_id')
                ->where('carts.user_id', Auth::user()->id)
                ->select('carts.*', 'products.title as pro_title', 'product_varients.sale_price','product_varients.title as weight')
                ->get()->toArray();

                foreach ($cart as $keys => $values) {
                    if ($cart[$keys]["id"] == $cart_id) {
                        $cart[$keys]["varient_id"] = $varient_id;
                        $cart[$keys]["quantity"] = $cart[$keys]['quantity'];
                        $item_data = json_encode($cart);
                        return response()->json([
                                     'quantity' => $cart[$keys]['quantity'],
                                     'price' => $cart[$keys]['sale_price'],
                                     'weight' => $cart[$keys]['weight'],
                                     'status' => '"' . $cart[$keys]['pro_title'] . '" Weighr Updated',
                                 ]);
                    }
                }
        }

    }
}
