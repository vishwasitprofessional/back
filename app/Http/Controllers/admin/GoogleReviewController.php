<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleReview;
use Illuminate\Http\Request;

class GoogleReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function google_reviews_show()
    {
        $google_reviews=GoogleReview::all();
        // dd($videos);
        return view('admin.google_reviews.google_reviews_show', compact('google_reviews'));
    }

    public function google_review_create()
    {
        return view('admin.google_reviews.google_review_create');
    }

    public function google_review_create_action(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'comment' => 'required',
        ]);

        $google_reviews = new GoogleReview([
            'customer_name' => $request->get('customer_name'),
            'comment' => $request->get('comment'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $google_reviews->save();
        return redirect()->route('google-reviews-show')->with('success','Google Reviews Added Successfully');
    }

    public function google_review_edit ($id)
    {
        $google_review=GoogleReview::find($id);
        return view('admin.google_reviews.google_review_edit', compact('google_review'));
    }

    public function google_review_update_action(Request $request)
    {
            $this->validate($request,[
                'customer_name' => 'required',
                'comment' => 'required',
		]);
                 
        $google_review=GoogleReview::findOrFail($request->get('id'));
        $google_review->customer_name=$request->get('customer_name');
        $google_review->comment=$request->get('comment');
        $google_review->updated_at=date('Y-m-d');
        $google_review->save();
        return redirect()->route('google-reviews-show')->with('success','Google Reviews Updated Successfully');
    }


    public function google_review_delete($id){
		$google_review=GoogleReview::where('id', $id)->first();
        $google_review->delete();
        return redirect()->route('google-reviews-show')->with('error','Google Review Deleted');
    }
}
