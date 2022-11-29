<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\DemoVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DemoVideoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $demoVideos = DemoVideo::with('classCategory')->get();
        $classes = ClassCategory::all();
        return view('admin.demo_videos', compact('user', 'demoVideos', 'classes'));
    }

    public function getClasses($id)
    {
        $class_cat = explode(',', $id);
        $classCategories = ClassCategory::whereIn('id', $class_cat)->get();
        return $classCategories;
    }

    public function addDemoVideo(Request $request)
    {
        $rules = [
            'class_id' => 'required',
            'title' => 'required',
            'tag_name' => 'required',
            'description' => 'required',
            'video_name' => 'required',

        ];
        $requestData = $request->all();
        // if ($request->video_name) {
        //     $demoVideo = $request->file('video_name');
        //     $videoName = time() . 'aboutVideo.' . $demoVideo->getClientOriginalExtension();
        //     Storage::disk('public')->put($videoName,  File::get($demoVideo));
        //     $requestData['video_name'] = $videoName;
        //     // $path = Storage::disk('s3')->put('images', $request->image);

        //     // $path = Storage::disk('s3')->url($path);
        //     // $gallary->image =  $requestData['image'];
        //     // $gallary->save();
        // }

        DemoVideo::create($requestData);
        return Redirect::route('admin.demoVideo')->with('success', 'successfully submitted!');
    }

    public function updateDemoVideo(Request $request)
    {
        $rules = [
            'id' => 'required',
            'class_id' => 'required',
            'title' => 'required',
            'tag_name' => 'required',
            'description' => 'required',
            'video_name' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $video = DemoVideo::find($request->id);

            // if ($request->video_name) {
            //     $demoVideo = $request->file('video_name');
            //     $videoName = time() . 'aboutVideo.' . $demoVideo->getClientOriginalExtension();
            //     Storage::disk('public')->put($videoName,  File::get($demoVideo));
            //     $requestData['video_name'] = $videoName;
            //     // $path = Storage::disk('s3')->put('images', $request->image);

            //     // $path = Storage::disk('s3')->url($path);
            //     // $gallary->image =  $requestData['image'];
            //     // $gallary->save();
            // }
            unset($requestData['_token']);
            unset($requestData['id']);
            // dd($requestData);
            $contactAdd = DemoVideo::where('id', $video->id)->update($requestData);

            return Redirect::route('admin.demoVideo')->with('success', 'successfully submitted!');
        }
    }


    public function deleteDemoVideo($id)
    {
        DemoVideo::where('id', $id)->delete();
        return Redirect::route('admin.demoVideo')->with('success', 'successfully submitted!');
    }
}
