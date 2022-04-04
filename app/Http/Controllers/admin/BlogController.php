<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function blogs_show()
    {
        $blogs=Blog::all();
        // dd($blogs);
        return view('admin.blogs.blogs_show', compact('blogs'));
    }

    public function blog_create()
    {
        return view('admin.blogs.blog_create');
    }

    public function blog_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'author_name' => 'required',
    		'image_url'=>'required','image','max:2048',
        ]);

        $new_name = "";
        $image=$request->file('image_url');
        if($image!=''){
            $new_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blogs/'),$new_name);
        }
        
        $blogs = new blog([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'author_name' => $request->get('author_name'),
            'image_url' => $new_name,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $blogs->save();
        return redirect()->route('blogs-show')->with('success','Data Added Successfully');
    }

    public function blog_edit ($id)
    {
        $blog=Blog::find($id);
        return view('admin.blogs.blog_edit', compact('blog'));
    }

    public function blog_update_action(Request $request)
    {
        $image_name=$request->old_image_url;
        $image=$request->file('new_image_url');
	    if($image!=''){
            $image_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blogs/'),$image_name);
        }
             
        else{
            $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'author_name' => 'required',
		]);
        }         
        $blog=Blog::findOrFail($request->get('id'));
        $blog->title=$request->get('title');
        $blog->description=$request->get('description');
        $blog->author_name=$request->get('author_name');

        if($request->file('new_image_url')){
            $file=public_path('/images/blogs/'."/".$request->old_image_url);
                if(file_exists($file)){
                        unlink($file);
                }
            $blog->image_url=$image_name;
        }
    
        $blog->updated_at=date('Y-m-d');
        $blog->save();
        return redirect()->route('blogs-show')->with('success','Data Updated Successfully');
    }


    public function blog_delete($id){
		$blog=Blog::where('id', $id)->first();
        $file=public_path('/images/blogs/'."/".$blog->image_url);
        if(file_exists($file)){
                unlink($file);
        }
        $blog->delete();
        return redirect()->route('blogs-show')->with('error','Data Deleted');
    }

    public function blog_status_update(Request $request){
        if($request->mode == 'true'){
            Blog::where('id',$request->id)->update(['status'=>'show']);
        }else{
            Blog::where('id',$request->id)->update(['status'=>'hide']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
}
