<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function featured_products_show()
    {
        $featured_products=FeaturedProduct::orderBy('id','DESC')->where('is_deleted',0)->get();
        // dd($featured_products);
        return view('admin.featured_products.featured_products_show', compact('featured_products'));
    }

    public function featured_product_create()
    {
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        // dd($products);
        return view('admin.featured_products.featured_product_create', compact('products'));
    }

    public function featured_product_create_action(Request $request)
    {
        $this->validate($request, [
            'pro_id'     => 'required',
        ]);

        $featured_products = new FeaturedProduct([
            'pro_id' => $request->get('pro_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $featured_products->save();
        return redirect()->route('featured-products-show')->with('success','Data Added Successfully');
    }

    public function featured_product_edit ($id)
    {
        $featured_product=FeaturedProduct::find($id);
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        return view('admin.featured_products.featured_product_edit', compact('featured_product', 'products'));
    }

    public function featured_product_update_action(Request $request)
    {   
            $this->validate($request,[
                'pro_id' => 'required',
		]);       
       
        $featured_product=FeaturedProduct::findOrFail($request->get('id'));
        $featured_product->pro_id=$request->get('pro_id');
        $featured_product->updated_at=date('Y-m-d');
        $featured_product->save();
        return redirect()->route('featured-products-show')->with('success','Data Updated Successfully');
    }


    public function featured_product_delete($id){
		$featured_product=FeaturedProduct::where('id', $id)->first();
		$featured_product=FeaturedProduct::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('featured-products-show')->with('error','Data Deleted');
    }

    public function featured_product_status_update(Request $request){
        if($request->mode == 'true'){
            FeaturedProduct::where('id',$request->id)->update(['status'=>'active']);
        }else{
            FeaturedProduct::where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }

}
