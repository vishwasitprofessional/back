<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function sliders_show()
    {
        $sliders=Slider::all();
        // dd($sliders);
        return view('admin.sliders.sliders_show', compact('sliders'));
    }

    public function slider_create()
    {
        return view('admin.sliders.slider_create');
    }

    public function slider_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'short_description' => 'required',
    		'image_url'=>'required','image','max:2048',
        ]);

        $new_name = "";
        $image=$request->file('image_url');
        if($image!=''){
            $new_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sliders/'),$new_name);
        }
        
        $sliders = new slider([
            'title' => $request->get('title'),
            'sub_title' => $request->get('sub_title'),
            'short_description' => $request->get('short_description'),
            'image_url' => $new_name,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $sliders->save();
        return redirect()->route('sliders-show')->with('success','Data Added Successfully');
    }

    public function slider_edit ($id)
    {
        $slider=Slider::find($id);
        return view('admin.sliders.slider_edit', compact('slider'));
    }

    public function slider_update_action(Request $request)
    {
        $image_name=$request->old_image_url;
        $image=$request->file('new_image_url');
	    if($image!=''){
            $image_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sliders/'),$image_name);
        }
             
        else{
            $this->validate($request,[
                'title' => 'required',
                'sub_title' => 'required',
                'short_description' => 'required',
		]);
        }         
        $slider=Slider::findOrFail($request->get('id'));
        $slider->title=$request->get('title');
        $slider->sub_title=$request->get('sub_title');
        $slider->short_description=$request->get('short_description');

        if($request->file('new_image_url')){
            $file=public_path('/images/sliders/'."/".$request->old_image_url);
                if(file_exists($file)){
                        unlink($file);
                }
            $slider->image_url=$image_name;
        }
    
        $slider->updated_at=date('Y-m-d');
        $slider->save();
        return redirect()->route('sliders-show')->with('success','Data Updated Successfully');
    }


    public function slider_delete($id){
		$slider=Slider::where('id', $id)->first();
        $file=public_path('/images/sliders/'."/".$slider->image_url);
        if(file_exists($file)){
                unlink($file);
        }
        $slider->delete();
        return redirect()->route('sliders-show')->with('error','Data Deleted');
    }

    public function slider_status_update(Request $request){
        if($request->mode == 'true'){
            Slider::where('id',$request->id)->update(['status'=>'show']);
        }else{
            Slider::where('id',$request->id)->update(['status'=>'hide']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
}
