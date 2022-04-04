<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PopularProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PopularProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function popular_products_show()
    {
        $popular_products=PopularProduct::orderBy('id','DESC')->where('is_deleted',0)->get();
        // dd($popular_products);
        return view('admin.popular_products.popular_products_show', compact('popular_products'));
    }

    public function popular_product_create()
    {
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        // dd($products);
        return view('admin.popular_products.popular_product_create', compact('products'));
    }

    public function popular_product_create_action(Request $request)
    {
        $this->validate($request, [
            'pro_id'     => 'required',
        ]);

        $popular_products = new PopularProduct([
            'pro_id' => $request->get('pro_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $popular_products->save();
        return redirect()->route('popular-products-show')->with('success','Data Added Successfully');
    }

    public function popular_product_edit ($id)
    {
        $popular_product=PopularProduct::find($id);
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        return view('admin.popular_products.popular_product_edit', compact('popular_product', 'products'));
    }

    public function popular_product_update_action(Request $request)
    {   
            $this->validate($request,[
                'pro_id' => 'required',
		]);       
       
        $popular_product=PopularProduct::findOrFail($request->get('id'));
        $popular_product->pro_id=$request->get('pro_id');
        $popular_product->updated_at=date('Y-m-d');
        $popular_product->save();
        return redirect()->route('popular-products-show')->with('success','Data Updated Successfully');
    }


    public function popular_product_delete($id){
		$popular_product=PopularProduct::where('id', $id)->first();
		$popular_product=PopularProduct::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('popular-products-show')->with('error','Data Deleted');
    }

    public function popular_product_status_update(Request $request){
        if($request->mode == 'true'){
            PopularProduct::where('id',$request->id)->update(['status'=>'active']);
        }else{
            PopularProduct::where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }

}
