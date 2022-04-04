<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Mail\SendMail;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile_show()
    {
        return view('vendor.profile.profile_show');
    }
    
    public function profile_view($id)
    {
        $vendor=User::where('id',$id)->first();
        // dd($vendor);
        return view('vendor.profile.profile_view',compact('vendor'));
    }
    
    public function profile_edit($id)
    {
        $vendor=User::find($id);
        return view('vendor.profile.profile_edit',compact('vendor'));
    }

    public function profile_update_action(Request $request)
    {
        $image_name1=$request->old_address_proof_image;
        $image1=$request->file('new_address_proof_image');
	    if($image1!=''){
            $image_name1=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('brand_name')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images/brands/address_proof_image'),$image_name1);
        }
        $image_name2=$request->old_cancelled_cheque;
        $image2=$request->file('new_cancelled_cheque');
	    if($image2!=''){
            $image_name2=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('brand_name')) . "---" . rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images/brands/cancelled_cheque'),$image_name2);
        }
        $image_name3=$request->old_brand_logo;
        $image3=$request->file('new_brand_logo');
	    if($image3!=''){
            $image_name3=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('brand_name')) . "---" . rand() . '.' . $image3->getClientOriginalExtension();
            // $image3->move(public_path('images/brands/logo/'),$image_name3);
            $image3 = Image::make($image3)->resize(110, 110);
            $image3->save(public_path('images/brands/logo/'). $image_name3);
        }else {
            $this->validate($request, [
                'firm_name' => 'required',
                'firm_type' => 'required',
                'firm_address' => 'required',
                'contact_person_name' => 'required',
                'contact_person_no' => 'required',
                'pan_no' => 'required',
                'godown_address' => 'required',
                'nature_of_business' => 'required',
                'product_type' => 'required',
                'brand_name' => 'required',
                'firm_registration_no' => 'required',
                'date_of_registration' => 'required',
                'fssai_lic_no' => 'required',
                'gst_no' => 'required',
                'year_of_establishment' => 'required',
                'bank_account_name' => 'required',
                'bank_account_no' => 'required',
                'bank_name' => 'required',
                'bank_branch_name' => 'required',
                'bank_ifsc_code' => 'required',
            ]);
        }
        
        $profile=User::findOrFail($request->get('id'));
        $profile->firm_name=$request->get('firm_name');
        $profile->firm_type=$request->get('firm_type');
        $profile->firm_address=$request->get('firm_address');
        $profile->contact_person_name=$request->get('contact_person_name');
        $profile->contact_person_no=$request->get('contact_person_no');
        $profile->pan_no=$request->get('pan_no');
        // $profile->address_proof_image=$request->get('address_proof_image');
        $profile->godown_address=$request->get('godown_address');
        $profile->nature_of_business=$request->get('nature_of_business');
        $profile->product_type=$request->get('product_type');
        $profile->brand_name=$request->get('brand_name');
        $profile->firm_registration_no=$request->get('firm_registration_no');
        $profile->date_of_registration=$request->get('date_of_registration');
        $profile->fssai_lic_no=$request->get('fssai_lic_no');
        $profile->gst_no=$request->get('gst_no');
        $profile->year_of_establishment=$request->get('year_of_establishment');
        $profile->bank_account_name=$request->get('bank_account_name');
        $profile->bank_account_no=$request->get('bank_account_no');
        $profile->bank_name=$request->get('bank_name');
        $profile->bank_branch_name=$request->get('bank_branch_name');
        $profile->bank_ifsc_code=$request->get('bank_ifsc_code');
        $profile->address_proof_image=$image_name1;
        $profile->cancelled_cheque=$image_name2;
        $profile->brand_logo=$image_name3;
        $profile->updated_at=date('Y-m-d');
        $profile->save();

        if($profile){
            $str = '1234567890';
            $str = str_shuffle($str);
            $email_otp = substr($str, 0, 6);


            $to = Auth::user()->email;
            $to_name = Auth::user()->name;
            $from = env('MAIL_USERNAME');
            // dd($from);
            $from_name = env('MAIL_FROM_NAME');
            $body = "Your account is successfully registered. Thanks for choosing " . env('APP_NAME') . ". <br>
            <br>For further details check: " . URL::to('/');

            app('App\Http\Controllers\vendor\ProfileController')->send_email($to, $to_name, $from, $from_name, 'Email', [
                'greeting' => "<b>Hi user,</b><br>",
                'title' => "<b>Email:</b><br>",
                'body' => $body,
                'footer' => "<b>From: </b>Support team"
            ]);

            $to = User::where('user_type','admin')->pluck('email')->first();
            $to_name = User::where('user_type','admin')->pluck('name')->first();
            app('App\Http\Controllers\vendor\ProfileController')->send_email($to, $to_name, $from, $from_name, 'Email', [
                'greeting' => "<b>Hi user,</b><br>",
                'title' => "<b>Email:</b><br>",
                'body' => $body,
                'footer' => "<b>From: </b>Support team"
            ]);
        }


        return redirect()->route('vendor-profile-show')->with('success','Data Updated Successfully');
    }


    public function send_email($to, $to_name, $from, $from_name, $subject, $data)
    {
        \Mail::send('email', $data, function ($message) use ($to, $to_name, $from, $from_name, $subject) {
            $message->to($to, $to_name)->subject($subject);
            $message->from($from, $from_name);
        });
    }


}
