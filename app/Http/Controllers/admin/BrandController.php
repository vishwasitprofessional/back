<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function brands_show()
    {
        $brands=Brand::where('is_deleted',0)->orderBy('updated_at', 'desc')->get();  
        return view('admin.brands.brands_show', compact('brands'));
    }

    public function brand_create()
    {
        return view('admin.brands.brand_create');
    }

    public function brand_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $new_name = "";
        $image=$request->file('image_url');
        if($image!=''){
            $new_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands/'),$new_name);
        }
        
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $request['slug'] = $slug;

        $brands = new brand([
            'title' => $request->get('title'),
            'slug' => $request['slug'],
            'image_url' => $new_name,
            'created_at' => date('Y-m-d H:i'),
            'updated_at' => date('Y-m-d H:i'),
        ]);
        $brands->save();
        return redirect()->route('brands-show')->with('success','Data Added Successfully');
    }

    public function brand_edit ($id)
    {
        $brand=Brand::find($id);
        return view('admin.brands.brand_edit', compact('brand'));
    }

    public function brand_update_action(Request $request)
    {
        $image_name=$request->old_image_url;
        $image=$request->file('new_image_url');
	    if($image!=''){
            $image_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/brands/'),$image_name);
        }
        else{
            $this->validate($request,[
                'title' => 'required',
		]);
        }        
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $request['slug'] = $slug; 

        $brand=Brand::findOrFail($request->get('id'));
        $brand->title=$request->get('title');
        $brand->slug=$request['slug'];

        if($request->file('new_image_url')){
            $file=public_path('/images/brands/'."/".$request->old_image_url);
                if(file_exists($file)){
                        unlink($file);
                }
            $brand->image_url=$image_name;
        }
        
        $brand->updated_at=date('Y-m-d');
        $brand->save();
        return redirect()->route('brands-show')->with('success','Data Updated Successfully');
    }


    public function brand_delete($id){
		$brand=Brand::where('id', $id)->first();
        $file=public_path('/images/brands/'."/".$brand->image_url);
        if(file_exists($file)){
                unlink($file);
        }
        
		$brand=Brand::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('brands-show')->with('error','Data Deleted');
    }
    

    public function brand_status_update(Request $request){
        if($request->mode == 'true'){
            Brand::where('id',$request->id)->update(['status'=>'active']);
        }else{
            Brand::where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
}
