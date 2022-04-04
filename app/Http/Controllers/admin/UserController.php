<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\EmailSubscribe;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function user_show()
    {
        $users=User::where('user_type','user')->get();
        // dd($users);
        return view('admin.users.user_show', compact('users'));
    }
    
    public function approved_vendor_view($id)
    {
        $vendor=User::find($id);
        // dd($users);
        return view('admin.users.approved_vendor_view', compact('vendor'));
    }
    
    public function approved_vendor_show()
    {
        $approved_vendors=User::where(['user_type'=>'vendor', 'approved_status'=>'approved'])->get();
        // dd($vendors);
        return view('admin.users.approved_vendor_show', compact('approved_vendors'));
    }
    
    public function pending_vendor_view($id)
    {
        $vendor=User::find($id);
        // dd($users);
        return view('admin.users.pending_vendor_view', compact('vendor'));
    }
    
    public function pending_vendor_show()
    {
        $pending_vendors=User::where(['user_type'=>'vendor', 'approved_status'=>'unapproved'])->get();
        // dd($vendors);
        return view('admin.users.pending_vendor_show', compact('pending_vendors'));
    }

    public function vendor_status_update(Request $request){
        if($request->mode == 'true'){
            $user=User::find($request->id);
            // dd($user);
            if(!empty($user->firm_name) && !empty($user->firm_type) && !empty($user->firm_address) && !empty($user->contact_person_name) && !empty($user->contact_person_no)
            && !empty($user->pan_no) && !empty($user->address_proof_image) && !empty($user->godown_address) && !empty($user->nature_of_business) && !empty($user->product_type) 
            && !empty($user->brand_name) && !empty($user->firm_registration_no) && !empty($user->date_of_registration) && !empty($user->fssai_lic_no) && !empty($user->gst_no)
            && !empty($user->year_of_establishment) && !empty($user->bank_account_name) && !empty($user->bank_account_no) && !empty($user->bank_name) && !empty($user->bank_branch_name)
            && !empty($user->bank_ifsc_code) && !empty($user->cancelled_cheque)){
                User::where('id',$request->id)->update(['approved_status'=>'approved']);
            }else{
                User::where('id',$request->id)->update(['approved_status'=>'unapproved']);
                return response()->json(['msg'=>'Not Successfully', 'status'=>true]);
            }
        }else{
            User::where('id',$request->id)->update(['approved_status'=>'unapproved']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
    
    public function contact_forms_show()
    {
        $contact_details=ContactForm::get();
        // dd($users);
        return view('admin.users.contact_forms_show', compact('contact_details'));
    }
    
    public function email_subscribers_show()
    {
        $email_subscribers=EmailSubscribe::get();
        return view('admin.users.email_subscribers_show', compact('email_subscribers'));
    }

    
}
