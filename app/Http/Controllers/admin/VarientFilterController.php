<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VarientFilter;
use Illuminate\Http\Request;

class VarientFilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function varient_filters_show()
    {
        $varient_filters=VarientFilter::all();
        // dd($varient_filters);
        return view('admin.varient_filters.varient_filters_show', compact('varient_filters'));
    }

    public function varient_filter_create()
    {
        return view('admin.varient_filters.varient_filter_create');
    }

    public function varient_filter_create_action(Request $request)
    {
        $this->validate($request, [
            'cat_id' => 'required',
            'filter' => 'required',
            'title' => 'required',
        ]);

        $varient_filters = new VarientFilter([
            'cat_id' => $request->get('cat_id'),
            'filter' => $request->get('filter'),
            'title' => $request->get('title'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $varient_filters->save();
        return redirect()->route('varient-filters-show')->with('success','Data Added Successfully');
    }

    public function varient_filter_edit ($id)
    {
        $varient_filter=VarientFilter::find($id);
        return view('admin.varient_filters.varient_filter_edit', compact('varient_filter'));
    }

    public function varient_filter_update_action(Request $request)
    {
            $this->validate($request,[
                'cat_id' => 'required',
                'filter' => 'required',
                'title' => 'required',
		]);

        $varient_filter=VarientFilter::findOrFail($request->get('id'));
        $varient_filter->cat_id=$request->get('cat_id');
        $varient_filter->filter=$request->get('filter');
        $varient_filter->title=$request->get('title');
        $varient_filter->updated_at=date('Y-m-d');
        $varient_filter->save();
        return redirect()->route('varient-filters-show')->with('success','Data Updated Successfully');
    }

}
