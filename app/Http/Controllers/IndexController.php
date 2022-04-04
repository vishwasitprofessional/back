<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\DealOfDay;
use App\Models\FeaturedProduct;
use App\Models\OrderItem;
use App\Models\PopularProduct;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Review;
use App\Models\ShippingWeightCost;
use App\Models\Slider;
use App\Models\State;
use App\Models\User;
use App\Models\Video;
use App\Models\GoogleReview;
use App\Models\EmailSubscribe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

class IndexController extends Controller
{
    public function index()
    {

        // $brands=get_multi_brands();
        // dd(($brands));
        // $cat_id = get_setting('cat_id');
        $category = get_categories();
        $cat_id = "";
        foreach ($category as $row) {
            $cat_id = $row->id;
        }
        $main_category = get_categories()->where('id', $cat_id)->first()->toArray();
        $banners = Banner::where('status', 'active')->inRandomOrder()->limit(6)->get();

        $blogs = Blog::where('status', 'show')->orderBy('updated_at', 'desc')->limit(3)->get();
        $sliders = Slider::where('status', 'show')->orderBy('updated_at', 'desc')->get();
        $popular_products = PopularProduct::where(['is_deleted' => 0, 'status' => 'active'])->inRandomOrder()->get();

        $sub_categories = Category::with('relProductChild')->where(['parent_id' => 1, 'status' => 'active'])->where('is_deleted', 0)->get();

        $google_reviews = GoogleReview::orderBy('id', 'desc')->get();
        // dd($google_reviews);

        $videos = Video::all();
        return view('index', compact('banners', 'blogs', 'sliders', 'main_category',  'popular_products', 'sub_categories', 'google_reviews', 'videos'));
    }


    public function shop()
    {
        $products = Product::select('products.*', 'product_varients.sale_price')
            ->join('product_varients', 'product_varients.id', '=', 'products.varient_id');
        //dd($products);


        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('products.cat_id', $cat_ids);
            // dd($product);
        }

        //brand filter
        if (!empty($_GET['brand'])) {
            $ids = explode(',', $_GET['brand']);
            $brand_ids = User::select('id')->whereIn('id', $ids)->pluck('id');
            $products = $products->whereIn('vendor_id', $brand_ids);
            // dd($products);
        }

        //Sort Filter
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['products.status' => 'show'])->orderBy('product_varients.sale_price', 'ASC');
            }
            if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['products.status' => 'show'])->orderBy('product_varients.sale_price', 'DESC');
            }
        }
        //Price Filter
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('product_varients.sale_price', $price)->where(['products.is_deleted' => 0, 'products.status' => 'show'])->get();
        } else {
            $products = $products->where(['products.is_deleted' => 0, 'products.status' => 'show'])->get();
            // dd($products);
        }
        return view('shop', compact('products'));
    }


    public function shop_filter(Request $request)
    {
        $data = $request->all();

        //Category Filter
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }
        //Sort Filter
        $sortByUrl = "";
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }
        //Price Filter
        $price_range_url = "";
        if (!empty($data['price_range'])) {
            $price_range_url .= '&price=' . $data['price_range'];
        }
        //Brand Filter
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }
        //Size Filter
        $sizeUrl = "";
        if (!empty($data['size'])) {
            $sizeUrl .= '&size=' . $data['size'];
        }
        return redirect()->route('shop', $catUrl . $sortByUrl . $price_range_url . $brandUrl . $sizeUrl);
    }

    public function product_detail($slug)
    {

        $product_detail = ProductVarient::with('relProduct')->where('slug', $slug)->first();
        $product_varient_detail = ProductVarient::where('pro_id', $product_detail->pro_id)->get();
        $result = PopularProduct::where(['is_deleted' => 0, 'status' => 'active'])->inRandomOrder()->limit(9)->get();
        $popular_productsets = $result->chunk(3);
        $related_products = Product::where(['child_cat_id' => $product_detail->child_cat_id, 'status' => 'show'])->inRandomOrder()->get();

        $reviews = OrderItem::select('order_items.*', 'products.image_url1 as pro_image', 'products.title as pro_name', 'products.avg_rating')
            ->join('product_varients', 'product_varients.id', '=', 'order_items.varient_id')
            ->join('products', 'products.id', '=', 'product_varients.pro_id')
            ->where(['order_items.rstatus'=>1, 'order_items.varient_id'=>$product_detail->id])->orderBy('id', 'desc')->paginate(5);
        // dd($reviews);
                            
        return view('product_detail', compact('product_detail', 'popular_productsets', 'related_products', 'product_varient_detail','reviews'));
    }

    public function product_cat(Request $request, $slug)
    {
        $categories = Category::with('relProduct', 'relProductChild')->where('slug', $slug)->first();
        // $categories = Category::with('relProduct')->where('slug',$slug)->first();
        $products = Product::select('products.*', 'product_varients.sale_price')
            ->join('product_varients', 'product_varients.id', '=', 'products.varient_id');
        $sort = "";
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    ->orWhere('products.child_cat_id', $categories->id)->orderBy('sale_price', 'ASC')->get();
            } elseif ($sort == 'priceDesc') {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    ->orWhere('products.child_cat_id', $categories->id)
                    ->orderBy('sale_price', 'DESC')->get();
            } else {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    ->orWhere('products.child_cat_id', $categories->id)->get();
            }
        }
        $route = 'product-cat';
        return view('product_categories', compact('categories', 'route', 'products'));
    }



    public function product_brand(Request $request, $cat_id, $vendor_id)
    {
        $categories = Category::with('relProduct', 'relProductChild')->where('id', $cat_id)->first();
        $brand = User::with('relProduct')->where('id',$vendor_id)->first();
        $vendors = User::with('relProduct')->where('id',$vendor_id)->first();
        // dd($brand);
        // $categories = Category::with('relProduct')->where('slug',$slug)->first();
        $products = Product::select('products.*', 'product_varients.sale_price')
            ->join('product_varients', 'product_varients.id', '=', 'products.varient_id');
        $sort = "";
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('errors.404');
        } else {

            // dd($brand);
            if ($sort == 'priceAsc') {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    // ->orWhere('products.child_cat_id', $categories->id)
                    ->where('products.vendor_id', $brand->id)
                    ->orderBy('sale_price', 'ASC')->get();
            } elseif ($sort == 'priceDesc') {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    // ->orWhere('products.child_cat_id', $categories->id)
                    ->where('products.vendor_id', $brand->id)
                    ->orderBy('sale_price', 'DESC')->get();
            } else {
                $products = $products->where(['products.status' => 'show', 'products.cat_id' => $categories->id])
                    // ->orWhere('products.child_cat_id', $categories->id)
                    ->where('products.vendor_id', $brand->id)->get();
                // dd($products);
            }
        }
        $route = 'product-brand';
        return view('product_brands', compact('categories', 'route', 'products', 'vendor_id', 'cat_id','vendors'));
    }



    public function product_multi_brand(Request $request, $vendor_id)
    {
        // $categories = Category::with('relProduct', 'relProductChild')->where('id', $child_cat_id)->first();
        $brand = User::where(['id' => $vendor_id, 'approved_status' => 'approved'])->first();

        // $categories = Category::with('relProduct')->where('slug',$slug)->first();
        $products = Product::select('products.*', 'product_varients.sale_price')
            ->join('product_varients', 'product_varients.id', '=', 'products.varient_id');

        $sort = "";
        if ($request->sort != null) {
            $sort = $request->sort; //dd($sort);
        }
        if ($brand == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = $products->where('products.vendor_id', $brand->id)->orderBy('sale_price', 'ASC')->get();
            } elseif ($sort == 'priceDesc') {
                $products = $products->where('products.vendor_id', $brand->id)->orderBy('sale_price', 'DESC')->get();
            } else {
                $products = $products->where(['products.vendor_id' => $brand->id])->where('products.status', 'show')->get();
                // dd($products);
            }
        }

        $route = 'product-multi-brand';
        // dd($brand->relProduct);
        return view('product_multi_brands', compact('route', 'products', 'vendor_id', 'brand'));
    }


    public function autoSearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->where('status', 'show')->get();

        $data = array();
        foreach ($products as $product) {
            $brand_name = $product->relVendor->brand_name;
            $data[] = array('value' => $product->title, 'id' => $product->id, 'brand_name' => $brand_name);
            // dd($data[0]['brand_name']);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No Result Found', 'id' => ''];
        }
    }


    public function search(Request $request)
    {
        $searchingdata = $request->input('search_product');
        $products = Product::where('title', 'LIKE', '%' . $searchingdata . '%')->where(['is_deleted' => 0, 'status' => 'show'])->get();
        // dd($products);
        return view('shop', compact('products'));
    }




    public function vendor_register()
    {
        return view('vendor.vendor_register');
    }

    public function vendor_register_action(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'string', 'max:12'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'user_type' => 'vendor',
            'password' => Hash::make($request->password),
        ]);

        if($user){
            Auth::loginUsingId($user->id);
            $user_detail = User::where('id', $user->id)->first();
            if ($user_detail->firm_name == null && $user_detail->brand_name == null && $user_detail->gst_no == null) {
                return redirect()->route('vendor-profile-edit', $user->id);
            } else {
                return redirect()->route('vendor-profile-show');
            }
        }
    }

    public function contact_form_create_action(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'     => 'required',
            'contact'     => 'required',
        ]);

        $contact_form = new ContactForm([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'contact' => $request->get('contact'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $contact_form->save();
        return redirect()->back()->with('success', 'Contact Form Submitted Successfully');
    }


    public function update_weight(Request $request)
    {
        $varient_id = $request->varient_id;
        $product = ProductVarient::find($varient_id);
        return response()->json([
            'sale_price' => $product->sale_price,
        ]);
    }


    public function test()
    {
        $ImagesDirectory    = public_path('images/products/'); //Source Image Directory End with Slash
        $DestImagesDirectory    = public_path('images/products1/'); //Destination Image Directory End with Slash
        $NewImageWidth         = 214; //New Width of Image
        $NewImageHeight     = 214; // New Height of Image
        // $Quality 		= 80; //Image Quality

        //Open Source Image directory, loop through each Image and resize it.
        if ($dir = opendir($ImagesDirectory)) {
            while (($file = readdir($dir)) !== false) {

                $imagePath = $ImagesDirectory . $file;
                $destPath = $DestImagesDirectory . $file;
                $checkValidImage = @getimagesize($imagePath);

                if (file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
                {
                    //Image looks valid, resize.
                    if ($this->resizeImage($imagePath, $destPath, $NewImageWidth, $NewImageHeight)) {
                        echo $file . ' resize Success!<br />';
                        /*
                        Now Image is resized, may be save information in database?
                        */
                    } else {
                        echo $file . ' resize Failed!<br />';
                    }
                }
            }
            closedir($dir);
        }
    }



    function resizeImage($SrcImage, $DestImage, $MaxWidth, $MaxHeight)
    {
        list($iWidth, $iHeight, $type)    = getimagesize($SrcImage);
        // $ImageScale              = min($MaxWidth / $iWidth, $MaxHeight / $iHeight);
        $NewWidth                  = 214;
        $NewHeight                 = 214;
        // $ImageScale              = min($MaxWidth / $iWidth, $MaxHeight / $iHeight);
        // $NewWidth                  = ceil($ImageScale * $iWidth);
        // $NewHeight                 = ceil($ImageScale * $iHeight);
        $NewCanves                 = imagecreatetruecolor($NewWidth, $NewHeight);

        switch (strtolower(image_type_to_mime_type($type))) {
            case 'image/jpeg':
                $NewImage = imagecreatefromjpeg($SrcImage);
                break;
            case 'image/png':
                echo $SrcImage;
                $NewImage = imagecreatefrompng($SrcImage);
                echo $NewImage;
                break;
            case 'image/gif':
                $NewImage = imagecreatefromgif($SrcImage);
                break;
            default:
                return false;
        }

        // Resize Image
        if (imagecopyresampled($NewCanves, $NewImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight)) {
            // copy file
            if (imagejpeg($NewCanves, $DestImage)) {
                imagedestroy($NewCanves);
                return true;
            }
        }
    }


    public function shippingCostUpdate()
    {
        $inputFileType = 'Xlsx';
        $inputFileName = public_path('shipping_cost.xlsx');
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);
        dd($sheetData);
        $i = 0;
        // $pro_id = 0;
        foreach ($sheetData as $row) {
            if ($i == 0) {
                $i++;
                continue;
            }

            // $states = State::where('country_id', 101)->get();
            // dd($states);
                // $shipping = ShippingWeightCost::where(['state_id'=>2, 'weight'=>$row[0]])->update([
                //     'price' => $row[4],
                // ]);
            //dd($shipping);
            // foreach ($states as $state) {
                $shipping_cost = new ShippingWeightCost([
                    'country_id' => 13,
                    'state_id' => 0,
                    'weight' => $row[0],
                    'price' => $row[3],
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ]);
                //dd($shipping_cost);
                $shipping_cost->save();
            // }
        }
    }
    

    public function email_subscriber_create_action(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
        ]);

        $email_subscriber_form = new EmailSubscribe([
            'email' => $request->get('email'),
            'subscriber' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $email_subscriber_form->save();
        return redirect()->back()->with('success', 'Email Subscribed Successfully');
    }
}
