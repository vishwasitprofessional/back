<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\User;
use App\Models\VarientFilter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products_show()
    {
        $vendor_id = Auth::user()->id;
        $products = Product::where(['is_deleted' => 0, 'vendor_id' => $vendor_id])->orderBy('id', 'DESC')->get();
        // dd($products);
        return view('vendor.products.products_show', compact('products'));
    }

    public function product_create()
    {
        $categories = Category::where(['is_deleted' => 0, 'is_parent' => 1])->where('status','active')->get();
        $sub_categories = Category::where(['is_deleted' => 0, 'is_parent' => 0])->where('status', 'active')->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $vendors = User::where(['is_deleted' => 0, 'user_type' => 'vendor'])->get();
        // dd($categories);
        return view('vendor.products.product_create', compact('categories', 'brands', 'vendors','sub_categories'));
    }

    public function product_create_action(Request $request)
    {
        $this->validate($request, [
            'cat_id' => 'required',
            'child_cat_id' => 'required',
            'title' => 'required',
        ]);

        $new_name1 = "";
        $image1 = $request->file('image_url1');
        if ($image1 != '') {
            $new_name1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            // $image1->move(public_path('images/products/'), $new_name1);
            $image1 = Image::make($image1)->resize(214, 214);
            $image1->save(public_path('images/products/'). $new_name1);
        }

        $products = new Product([
            'title' => $request->get('title'),
            'short_description' => $request->get('short_description'),
            'description' => $request->get('description'),
            'cat_id' => $request->get('cat_id'),
            'child_cat_id' => $request->get('child_cat_id'),
            'vendor_id' => Auth::user()->id,
            'code' => $request->get('code'),
            'gst_in_percentage' => $request->gst_in_percentage,
            'status' => 'show',
            'image_url1' => $new_name1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $products->save();
        return redirect()->route('vendor-product-varients-show', $products->id);
    }

    public function product_varients_show($product_id)
    {
        $product_varients = ProductVarient::with('relProduct')->where('pro_id', $product_id)->get();
        // dd($product_varients-);
        return view('vendor.products.product_varients_show', compact('product_varients', 'product_id'));
    }

    public function product_varients_create($product_id)
    {
        $product = Product::find($product_id);
        $varient_filters = VarientFilter::where('cat_id', $product->child_cat_id)
            ->get();
        return view('vendor.products.product_varients_create', compact('product', 'varient_filters'));
    }

    public function product_varients_create_action(Request $request)
    {
        $products = Product::find($request->pro_id);
        $varient_title=VarientFilter::find($request->title);
        $sub_categories = Category::where('id',$products->child_cat_id)->first();
        
        if(!empty($varient_title)){
            $title = $varient_title->title;
        }else{
            $title = "";
        }
        
        $slug = Str::slug($sub_categories->title . '-' . $products->title . '-' . $request->title);
        $product_varients = new ProductVarient([
            'pro_id' => $products->id,
            'cat_id' => $products->cat_id,
            'child_cat_id' => $products->child_cat_id,
            'slug' =>  $slug,
            'title' =>  $title,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            // 'image_url' => $row[2] . '.jpg',
            'quantity' => $request->quantity,
            'gross_weight' => $request->gross_weight,
            'dimensions' => $request->dimensions,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $product_varients->save();
        $varients = ProductVarient::where('pro_id', $product_varients->pro_id)->first();
        Product::where('id', $products->id)->update(['varient_id' => $varients->id]);
        return redirect()->route('vendor-product-varients-show', $request->pro_id)->with('success', 'Product Added Successfully');
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where(['is_deleted' => 0, 'is_parent' => 1])->where('status','active')->get();
        $sub_categories = Category::where(['is_deleted' => 0, 'is_parent' => 0])->where('status', 'active')->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $vendors = User::where(['is_deleted' => 0, 'user_type' => 'vendor'])->get();
        return view('vendor.products.product_edit', compact('product', 'categories', 'brands', 'vendors','sub_categories'));
    }

    public function product_update_action(Request $request)
    {
        $image_name1 = $request->old_image_url1;
        $image1 = $request->file('new_image_url1');
        if ($image1 != '') {
            $image_name1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            // $image1->move(public_path('images/products/'), $image_name1);
            $image1 = Image::make($image1)->resize(214, 214);
            $image1->save(public_path('images/products/'). $image_name1);
        } else {
            $this->validate($request, [
                'cat_id' => 'required',
                'child_cat_id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);
        }
        $product = Product::findOrFail($request->get('id'));
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->short_description = $request->get('short_description');
        $product->cat_id = $request->get('cat_id');
        $product->child_cat_id = $request->get('child_cat_id');
        $product->vendor_id = Auth::user()->id;
        $product->code = $request->get('code');
        $product_varients->gst_in_percentage = $request->gst_in_percentage;
        $product->status = 'show';
        if ($request->file('new_image_url1')) {
            $file1 = public_path('/images/products/' . "/" . $request->old_image_url1);
            if (file_exists($file1)) {
                unlink($file1);
            }
            $product->image_url1 = $image_name1;
        }
        $product->updated_at = date('Y-m-d');
        $product->save();
        return redirect()->route('vendor-product-varients-show', $product->id);
    }


    public function product_varient_edit($id)
    {
        $product_varient = ProductVarient::find($id);
        $varient_filters = VarientFilter::where('cat_id', $product_varient->child_cat_id)
            ->get();
        return view('vendor.products.product_varient_edit', compact('product_varient', 'varient_filters'));
    }

    public function product_varient_update_action(Request $request)
    {
        $products = Product::find($request->pro_id);
        $varient_title=VarientFilter::find($request->title);
        $sub_categories = Category::where('id',$products->child_cat_id)->first();
        
        if(!empty($varient_title)){
            $title = $varient_title->title;
        }else{
            $title = "";
        }
        
        $slug = Str::slug($sub_categories->title . '-' . $products->title . '-' . $request->title);
        $product_varients = ProductVarient::findOrFail($request->get('id'));
        $product_varients->pro_id = $request->get('pro_id');
        $product_varients->cat_id = $products->cat_id;
        $product_varients->child_cat_id = $products->child_cat_id;
        $product_varients->slug = $slug;
        $product_varients->title = $title;
        $product_varients->price = $request->price;
        $product_varients->sale_price = $request->sale_price;
        $product_varients->quantity = $request->quantity;
        $product_varients->gross_weight = $request->gross_weight;
        $product_varients->dimensions = $request->dimensions;
        $product_varients->updated_at = date('Y-m-d');
        $product_varients->save();
        $varients = ProductVarient::where('pro_id', $product_varients->pro_id)->first();
        Product::where('id', $products->id)->update(['varient_id' => $varients->id]);
        return redirect()->route('vendor-product-varients-show', $request->pro_id)->with('success', 'Product Detail Updated Successfully');
    }


    public function product_delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product = Product::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('vendor-products-show')->with('error', 'Data Deleted');
    }

    public function product_status_update(Request $request)
    {
        if ($request->mode == 'true') {
            Product::where('id', $request->id)->update(['status' => 'show']);
        } else {
            Product::where('id', $request->id)->update(['status' => 'hide']);
        }
        return response()->json(['msg' => 'Successfully Updated Status', 'status' => true]);
    }
}
