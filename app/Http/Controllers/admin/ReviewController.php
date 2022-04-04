<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reviews_show()
    {
        $reviews = Review::select('reviews.*', 'products.title as pro_name')->join('products','products.id','=','reviews.order_item_id')->get();
        // dd($reviews);
        return view('admin.reviews.reviews_show', compact('reviews'));
    }

    public function review_create()
    {
        $products=Product::get();
        return view('admin.reviews.review_create',compact('products'));
    }

    public function review_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'rating' => 'required',
            'comment' => 'required',
            'order_item_id' => 'required',
        ]);
        $reviews = new Review([
            'title' => $request->get('title'),
            'rating' => $request->get('rating'),
            'comment' => $request->get('comment'),
            'order_item_id' => $request->get('order_item_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $reviews->save();
        return redirect()->route('reviews-show')->with('success', 'Review Added Successfully');
    }

    public function review_edit($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.review_edit', compact('review'));
    }

    public function review_update_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'rating' => 'required',
            'comment' => 'required',
            'order_item_id' => 'required',
        ]);

        $review = Review::findOrFail($request->get('id'));
        $review->title = $request->get('title');
        $review->rating = $request->get('rating');
        $review->comment = $request->get('comment');
        $review->order_item_id = $request->get('order_item_id');
        $review->updated_at = date('Y-m-d');
        $review->save();
        return redirect()->route('reviews-show')->with('success', 'Review Updated Successfully');
    }


}
