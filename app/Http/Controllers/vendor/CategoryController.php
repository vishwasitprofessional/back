<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function get_child_by_parent_id(Request $request)
    {
        $category = Category::find($request->cat_id);
        if ($category) {
            $child_id = Category::getChildByParentID($request->cat_id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            } else {
                return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
            }
        }else{
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category Not Found']);
        }
    }
}
