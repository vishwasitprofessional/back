<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function videos_show()
    {
        $videos=Video::all();
        // dd($videos);
        return view('admin.videos.videos_show', compact('videos'));
    }

    public function video_create()
    {
        return view('admin.videos.video_create');
    }

    public function video_create_action(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'video_url'  => 'required|mimes:mp4,ogx,oga,webm,ogv,mov,ogg,qt | max:20000'
        ]);

        $new_name = "";
        $video=$request->file('video_url');
        if($video!=''){
            $new_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('videos/'),$new_name);
        }
        
        $videos = new Video([
            'title' => $request->get('title'),
            'short_description' => $request->get('short_description'),
            'video_url' => $new_name,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);
        $videos->save();
        return redirect()->route('videos-show')->with('success','Video Added Successfully');
    }

    public function video_edit ($id)
    {
        $video=Video::find($id);
        return view('admin.videos.video_edit', compact('video'));
    }

    public function video_update_action(Request $request)
    {
        $video_name=$request->old_video_url;
        $video=$request->file('new_video_url');
	    if($video!=''){
            $video_name=preg_replace('/[^A-Za-z0-9\-]/', '-', $request->get('title')) . "---" . rand() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('videos/'),$video_name);
        }
             
        else{
            $this->validate($request,[
                'title' => 'required',
                'short_description' => 'required',
		]);
        }         
        $video=Video::findOrFail($request->get('id'));
        $video->title=$request->get('title');
        $video->short_description=$request->get('short_description');

        if($request->file('new_video_url')){
            $file=public_path('/videos/'."/".$request->old_video_url);
                if(file_exists($file)){
                        unlink($file);
                }
            $video->video_url=$video_name;
        }
    
        $video->updated_at=date('Y-m-d');
        $video->save();
        return redirect()->route('videos-show')->with('success','Video Updated Successfully');
    }


    public function video_delete($id){
		$video=Video::where('id', $id)->first();
        $file=public_path('/videos/'."/".$video->video_url);
        if(file_exists($file)){
                unlink($file);
        }
        $video->delete();
        return redirect()->route('videos-show')->with('error','Video Deleted');
    }
}
