<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DealOfDay;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DealOfDayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function deal_of_days_show()
    {
        $deal_of_days=DealOfDay::orderBy('id','DESC')->where('is_deleted',0)->get();
        // dd($deal_of_days);
        return view('admin.deal_of_days.deal_of_days_show', compact('deal_of_days'));
    }

    public function deal_of_day_create()
    {
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        // dd($products);
        return view('admin.deal_of_days.deal_of_day_create', compact('products'));
    }

    public function deal_of_day_create_action(Request $request)
    {
        $this->validate($request, [
            'pro_id'     => 'required',
        ]);

        $deal_of_days = new DealOfDay([
            'pro_id' => $request->get('pro_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $deal_of_days->save();
        return redirect()->route('deal-of-days-show')->with('success','Data Added Successfully');
    }

    public function deal_of_day_edit ($id)
    {
        $deal_of_day=DealOfDay::find($id);
        $products=Product::where(['is_deleted'=>0, 'status'=> 'show'])->get();
        return view('admin.deal_of_days.deal_of_day_edit', compact('deal_of_day', 'products'));
    }

    public function deal_of_day_update_action(Request $request)
    {   
            $this->validate($request,[
                'pro_id' => 'required',
		]);       
       
        $deal_of_day=DealOfDay::findOrFail($request->get('id'));
        $deal_of_day->pro_id=$request->get('pro_id');
        $deal_of_day->updated_at=date('Y-m-d');
        $deal_of_day->save();
        return redirect()->route('deal-of-days-show')->with('success','Data Updated Successfully');
    }


    public function deal_of_day_delete($id){
		$deal_of_day=DealOfDay::where('id', $id)->first();
		$deal_of_day=DealOfDay::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('deal-of-days-show')->with('error','Data Deleted');
    }

    public function deal_of_day_status_update(Request $request){
        if($request->mode == 'true'){
            DealOfDay::where('id',$request->id)->update(['status'=>'active']);
        }else{
            DealOfDay::where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }

}
