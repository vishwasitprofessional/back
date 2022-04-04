<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function general_settings_show()
    {
        $general_settings=GeneralSetting::orderBy('id','DESC')->get();
        // dd($general_settings);
        return view('admin.general_settings.general_settings_show', compact('general_settings'));
    }


    public function general_setting_edit ($id)
    {
        $general_setting=GeneralSetting::find($id);
        $categories=Category::where(['is_deleted'=>0, 'status'=> 'active'])->get();
        return view('admin.general_settings.general_setting_edit', compact('general_setting', 'categories'));
    }


    public function general_setting_update_action(Request $request)
    {   
        $image_name1 = $request->old_logo;
        $image1 = $request->file('new_logo');
        if ($image1 != '') {
            $image_name1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images/general_settings/'), $image_name1);
        }
        $image_name2 = $request->old_favicon;
        $image2 = $request->file('new_favicon');
        if ($image2 != '') {
            $image_name2 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images/general_settings/'), $image_name2);
        }

        $general_setting=GeneralSetting::findOrFail($request->get('id'));
        $general_setting->cat_id=$request->get('cat_id');
        $general_setting->title=$request->get('title');
        $general_setting->meta_description=$request->get('meta_description');
        $general_setting->meta_keywords=$request->get('meta_keywords');
        $general_setting->address=$request->get('address');
        $general_setting->email=$request->get('email');
        $general_setting->phone=$request->get('phone');
        $general_setting->fax=$request->get('fax');
        $general_setting->whatsapp_no=$request->get('whatsapp_no');
        $general_setting->footer=$request->get('footer');
        $general_setting->footer_url=$request->get('footer_url');
        $general_setting->facebook_url=$request->get('facebook_url');
        $general_setting->instagram_url=$request->get('instagram_url');
        $general_setting->linkedin_url=$request->get('linkedin_url');
        $general_setting->pinterest_url=$request->get('pinterest_url');
        $general_setting->youtube_url=$request->get('youtube_url');
        $general_setting->logo=$image_name1;
        $general_setting->favicon=$image_name2;
        $general_setting->updated_at=date('Y-m-d');
        $general_setting->save();
        return redirect()->route('general-settings-show')->with('success','Data Updated Successfully');
    }


}
