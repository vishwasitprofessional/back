<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function banners_show()
    {
        $banners=Banner::all();
        // dd($banners);
        return view('admin.banners.banners_show', compact('banners'));
    }

    public function banner_create()
    {
        return view('admin.banners.banner_create');
    }

    public function banner_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'link_title' => 'required',
            'link_url' => 'required',
    		'image_url'=>'required','image','max:2048',
        ]);

        $new_name = "";
        $image=$request->file('image_url');
        if($image!=''){
            $new_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banners/'),$new_name);
        }
        
        $banners = new banner([
            'title' => $request->get('title'),
            'sub_title' => $request->get('sub_title'),
            'link_title' => $request->get('link_title'),
            'link_url' => $request->get('link_url'),
            'image_url' => $new_name,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $banners->save();
        return redirect()->route('banners-show')->with('success','Data Added Successfully');
    }

    public function banner_edit ($id)
    {
        $banner=Banner::find($id);
        return view('admin.banners.banner_edit', compact('banner'));
    }

    public function banner_update_action(Request $request)
    {
        $image_name=$request->old_image_url;
        $image=$request->file('new_image_url');
	    if($image!=''){
            $image_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/banners/'),$image_name);
        }
             
        else{
            $this->validate($request,[
                'title' => 'required',
                'sub_title' => 'required',
                'link_title' => 'required',
                'link_url' => 'required',
		]);
        }         
        $banner=Banner::findOrFail($request->get('id'));
        $banner->title=$request->get('title');
        $banner->sub_title=$request->get('sub_title');
        $banner->link_title=$request->get('link_title');
        $banner->link_url=$request->get('link_url');

        if($request->file('new_image_url')){
            $file=public_path('/images/banners/'."/".$request->old_image_url);
                if(file_exists($file)){
                        unlink($file);
                }
            $banner->image_url=$image_name;
        }
    
        $banner->updated_at=date('Y-m-d');
        $banner->save();
        return redirect()->route('banners-show')->with('success','Data Updated Successfully');
    }


    public function banner_delete($id){
		$banner=Banner::where('id', $id)->first();
        $file=public_path('/images/banners/'."/".$banner->image_url);
        if(file_exists($file)){
                unlink($file);
        }
        $banner->delete();
        return redirect()->route('banners-show')->with('error','Data Deleted');
    }

    public function banner_status_update(Request $request){
        if($request->mode == 'true'){
            Banner::where('id',$request->id)->update(['status'=>'active']);
        }else{
            Banner::where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
}
