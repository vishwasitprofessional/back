<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function categories_show()
    {
        $categories = Category::where('is_deleted', 0)->orderBy('updated_at', 'desc')->get();
        return view('admin.categories.categories_show', compact('categories'));
    }

    public function category_create()
    {
        $categories = Category::where(['is_parent'=>1,'is_deleted'=>0])->where('status','active')->orderBy('title', 'ASC')->get();
        // dd($categories);
        return view('admin.categories.category_create', compact('categories'));
    }

    public function category_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $new_name1 = "";
        $image1 = $request->file('image_url1');
        if ($image1 != '') {
            $new_name1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            
            $image1 = Image::make($image1)->resize(267, 267);
            // $img->move("public/images/products/",$new_name);
           
            $image1->save(public_path('images/categories/'). $new_name1);
            //$image1->move(public_path('images/categories/'), $new_name1);
        }
        $new_name2 = "";
        $image2 = $request->file('image_url2');
        if ($image2 != '') {
            $new_name2 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image2->getClientOriginalExtension();
            // $image2->move(public_path('images/categories/'), $new_name2);
            $image2 = Image::make($image2)->resize(267, 267);
            // $img->move("public/images/products/",$new_name);
           
            $image2->save(public_path('images/categories/'). $new_name2);
        }
        $new_name3 = "";
        $image3 = $request->file('image_url3');
        if ($image3 != '') {
            $new_name3 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image3->getClientOriginalExtension();
            // $image3->move(public_path('images/categories/'), $new_name3);
            $image3 = Image::make($image3)->resize(267, 267);
            // $img->move("public/images/products/",$new_name);
           
            $image3->save(public_path('images/categories/'). $new_name3);
        }
        $new_name4 = "";
        $image4 = $request->file('image_url4');
        if ($image4 != '') {
            $new_name4 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image4->getClientOriginalExtension();
            // $image4->move(public_path('images/categories/'), $new_name4);
            $image4 = Image::make($image4)->resize(267, 267);
            // $img->move("public/images/products/",$new_name);
           
            $image4->save(public_path('images/categories/'). $new_name4);
        }

        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $request['slug'] = $slug;
        $request['is_parent'] = $request->input('is_parent', 0);

        $categories = new Category([
            'title' => $request->get('title'),
            'slug' => $request['slug'],
            'parent_id' => $request->get('parent_id'),
            'is_parent' => $request['is_parent'],
            'description' => $request->get('description'),
            'image_url1' => $new_name1,
            'image_url2' => $new_name2,
            'image_url3' => $new_name3,
            'image_url4' => $new_name4,
            'created_at' => date('Y-m-d H:i'),
            'updated_at' => date('Y-m-d H:i'),
        ]);
        $categories->save();
        return redirect()->route('categories-show')->with('success', 'Data Added Successfully');
    }

    public function category_edit($id)
    {
        $category = Category::find($id);
        $parent_ids = Category::where(['is_parent'=>1,'is_deleted'=>0])->where('status','active')->orderBy('title', 'ASC')->get();
        return view('admin.categories.category_edit', compact('category', 'parent_ids'));
    }

    public function category_update_action(Request $request)
    {
        $image_name1 = $request->old_image_url1;
        $image1 = $request->file('new_image_url1');
        if ($image1 != '') {
            $image_name1 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image1->getClientOriginalExtension();
            // $image1->move(public_path('images/categories/'), $image_name1);
            $image1 = Image::make($image1)->resize(240, 330);
            // $img->move("public/images/products/",$new_name);
           
            $image1->save(public_path('images/categories/'). $image_name1);
        }
        $image_name2 = $request->old_image_url2;
        $image2 = $request->file('new_image_url2');
        if ($image2 != '') {
            $image_name2 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images/categories/'), $image_name2);
        }
        $image_name3 = $request->old_image_url3;
        $image3 = $request->file('new_image_url3');
        if ($image3 != '') {
            $image_name3 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image3->getClientOriginalExtension();
            // $image3->move(public_path('images/categories/'), $image_name3);
            $image3 = Image::make($image3)->resize(110, 110);
            // $img->move("public/images/products/",$new_name);
           
            $image3->save(public_path('images/categories/'). $image_name3);
        }
        $image_name4 = $request->old_image_url4;
        $image4 = $request->file('new_image_url4');
        if ($image4 != '') {
            $image_name4 = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image4->getClientOriginalExtension();
            $image4->move(public_path('images/categories/'), $image_name4);
            
        } else {
            $this->validate($request, [
                'title' => 'required',
                'parent_id' => 'nullable|exists:categories,id',
            ]);
        }
        if ($request->get('is_parent') == 1) {
            $request['parent_id'] = null;
        } else {
            $request['parent_id'] = $request->get('parent_id');
        }
        $request['is_parent'] = $request->input('is_parent', 0);

        $category = Category::findOrFail($request->get('id'));
        $category->parent_id = $request['parent_id'];
        $category->is_parent = $request['is_parent'];
        $category->title = $request->get('title');
        $category->description = $request->get('description');        
        $category->image_url1 = $image_name1;
        $category->image_url2 = $image_name2;
        $category->image_url3 = $image_name3;
        $category->image_url4 = $image_name4;
        $category->updated_at = date('Y-m-d');
        $category->save();
        return redirect()->route('categories-show')->with('success', 'Data Updated Successfully');
    }


    public function category_delete($id)
    {
        $category = Category::where('id', $id)->first();
        $category = Category::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('categories-show')->with('error', 'Data Deleted');
    }


    public function category_status_update(Request $request)
    {
        if ($request->mode == 'true') {
            Category::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Category::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully Updated Status', 'status' => true]);
    }

    public function get_child_by_parent_id(Request $request)
    {
        return $category=Category::where('parent_id',$request->cat_id)->get();
    }
}
