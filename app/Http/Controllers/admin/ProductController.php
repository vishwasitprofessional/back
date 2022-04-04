<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\User;
use App\Models\VarientFilter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\Console\Input\Input;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products_show()
    {
        // $products = Product::with('relProductVarient')->orderBy('id', 'DESC')->where('is_deleted', 0)->get();
        $products = Product::orderBy('id', 'DESC')->where('is_deleted', 0)->get();
        // dd($products);
        return view('admin.products.products_show', compact('products'));
    }

    public function product_create()
    {
        $categories = Category::where(['is_deleted' => 0, 'is_parent' => 1])->where('status', 'active')->get();
        $sub_categories = Category::where(['is_deleted' => 0, 'is_parent' => 0])->where('status', 'active')->get();
        $vendors = User::where(['user_type' => 'vendor'])->where(['approved_status'=>'approved','is_deleted' => 0])->orWhere('user_type' , 'admin')->get();
        // dd($categories);
        return view('admin.products.product_create', compact('categories', 'vendors','sub_categories'));
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
            'vendor_id' => $request->get('vendor_id'),
            'code' => $request->get('code'),
            'gst_in_percentage' => $request->gst_in_percentage,
            'image_url1' => $new_name1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        // dd($products);
        $products->save();
        return redirect()->route('product-varients-show', $products->id);
    }


    public function product_varients_show($product_id)
    {
        $product_varients = ProductVarient::where('pro_id', $product_id)->get();
        return view('admin.products.product_varients_show', compact('product_varients', 'product_id'));
    }

    public function product_varients_create($product_id)
    {
        $product = Product::find($product_id);
        $varient_filters = VarientFilter::where('cat_id', $product->child_cat_id)
            ->get();
        return view('admin.products.product_varients_create', compact('product', 'varient_filters'));
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
            'title' => $title,
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
        return redirect()->route('product-varients-show', $request->pro_id)->with('success', 'Product Added Successfully');
    }


    public function product_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where(['is_deleted' => 0, 'is_parent' => 1])->where('status', 'active')->get();
        $sub_categories = Category::where(['is_deleted' => 0, 'is_parent' => 0])->where('status', 'active')->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $vendors = User::where(['user_type' => 'vendor'])->where(['approved_status'=>'approved','is_deleted' => 0])->orWhere('user_type' , 'admin')->get();
        return view('admin.products.product_edit', compact('product', 'categories', 'brands', 'vendors','sub_categories'));
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
            ]);
        }
        $product = Product::findOrFail($request->get('id'));
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->short_description = $request->get('short_description');
        $product->cat_id = $request->get('cat_id');
        $product->child_cat_id = $request->get('child_cat_id');
        $product->vendor_id = $request->get('vendor_id');
        $product->code = $request->get('code');
        $product_varients->gst_in_percentage = $request->gst_in_percentage;
        $product->image_url1 = $image_name1;
        $product->updated_at = date('Y-m-d');
        $product->save();
        return redirect()->route('products-show')->with('success', 'Data Updated Successfully');
    }

    public function product_varient_edit($id)
    {
        $product_varient = ProductVarient::find($id);
        $varient_filters = VarientFilter::where('cat_id', $product_varient->child_cat_id)
            ->get();
        return view('admin.products.product_varient_edit', compact('product_varient', 'varient_filters'));
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
        return redirect()->route('product-varients-show', $request->pro_id)->with('success', 'Product Detail Updated Successfully');
    }

    public function product_view($id)
    {
        $product = Product::find($id);
        $categories = Category::where(['is_deleted' => 0, 'is_parent' => 1])->get();
        $brands = Brand::where('is_deleted', 0)->get();
        $vendors = User::where(['is_deleted' => 0, 'user_type' => 'vendor'])->get();
        return view('admin.products.product_view', compact('product', 'categories', 'brands', 'vendors'));
    }


    public function product_delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product = Product::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('products-show')->with('error', 'Data Deleted');
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


    public function bulk_product_create()
    {
        $vendors = User::where(['is_deleted' => 0, 'user_type' => 'vendor'])->get();
        return view('admin.products.bulk_product_create', compact('vendors'));
    }

    public function bulk_product_create_action(Request $request)
    {
        $this->validate($request, [
            // 'file'=>'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp'
            'excel_file' => 'required|max:500000|mimes:xlsx',
            'vendor_id' => 'required'
        ]);

        $vendor_id = $request->vendor_id;

        $new_name = "";
        $file = $request->file('excel_file');
        if ($file != '') {
            $new_name = $vendor_id . '-' . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/bulk_products/'), $new_name);
        }


        $new_imgs = [];
        $imgs = $request->file('imgs');
        //dd($imgs);
        foreach ($imgs as $img) {
            
            $new_imgs[] = $img;
        }

        // dd($new_imgs);
        $inputFileType = 'Xlsx';
        $inputFileName = public_path('/images/bulk_products' . "/" . $new_name);
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);
        $i = 0;
        $im = 0;

        foreach ($sheetData as $row) {
            if (!empty($row[3])) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
                if ($row[3] == 'Dummy Product Name') {
                    $i++;
                    continue;
                }

                $sub_categories = Category::where(['parent_id' => 1, 'status' => 'active'])->where('is_deleted', 0)->get();
                $child_cat_id = "";
                foreach ($sub_categories as $sub_category) {
                    // $sub_cat_id=$sub_category->id;
                    if ($row[1] == $sub_category->title) {
                        $child_cat_id = $sub_category->id;
                    }
                }

                $products = Product::where('vendor_id', $vendor_id)->get();
                foreach ($products as $product) {
                    $product_title = $product->title;
                    if ($product_title == $row[3]) {
                        return redirect()->back()->with('error', 'Product Already Exists');
                    } else {
                        continue;
                    }
                }
               // dd($new_imgs[($im)]);

                if ($new_imgs[($im)] != '') {//dd($new_imgs[($im)]);
                    $new_img =  $row[3] . '.' . $new_imgs[($im)]->getClientOriginalExtension();

                    $img = Image::make($new_imgs[($im)])->resize(214, 214);
                    // dd($img);
                    $new_imgs[($im)]->move(public_path('images/products/'), $new_img);
                    // dd("hgere");
                }

                $products = new Product([
                    // 'id'=>$pro_id,
                    'varient_id' => 1,
                    'title' => $row[3],
                    'cat_id' => 1,
                    'child_cat_id' => $child_cat_id,
                    'vendor_id' => $vendor_id,
                    'code' => $row[2],
                    'status' => 'hide',
                    'image_url1' => $new_img,
                    // 'image_url2' => $row[2] . '.jpg',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ]);
                // dd($products);
                $products->save();

                $im++;

                $varient_filters = VarientFilter::where('cat_id', $products->child_cat_id)
                    ->get();

                $c = 0;
                foreach ($varient_filters as $varient_filters) {
                    $slug = Str::slug($row[1] . '-' . $row[3] . '-' . $varient_filters->title);

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

        return redirect()->route('products-show')->with('success', 'Data Added Successfully');
    }
}
