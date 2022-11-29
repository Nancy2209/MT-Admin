<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CareerVideo;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCount;
use App\Models\UserTestimonial;
use App\Models\VideoGallery;
use Response;

class HomeController extends Controller
{

    // Jobs start

    public function jobs()
    {
        $jobs = Job::all();
        return view('admin.jobs', compact('jobs'));
    }

    public function addJobs(Request $request)
    {
        $rules = [
            'title' => 'required',
            'location' => 'required',
            'status' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            Job::create($requestData);
            return Redirect::route('admin.jobs')->with('success', 'successfully submitted!');
        }
    }


    public function editJobs(Request $request)
    {
        $rules = [
            'id' => 'required',
            'title' => 'required',
            'location' => 'required',
            'status' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            unset($requestData['_token']);
            $contactAdd = Job::where('id', $request->id)->update($requestData);

            return Redirect::route('admin.jobs')->with('success', 'successfully submitted!');
        }
    }

    public function deleteJobs($id)
    {
        Job::where('id', $id)->delete();
        return Redirect::route('admin.jobs')->with('success', 'successfully submitted!');
    }
    // Jobs End


    // Career Video start
    public function galleryVideo()
    {
        $careerVideos = VideoGallery::all();
        return view('admin.career_video', compact('careerVideos'));
    }

    public function addGalleryVideo(Request $request)
    {
        $requestData = $request->all();
        if ($request->video_name) {
            $careerVideo = $request->file('video_name');
            $videoName = time() . 'aboutVideo.' . $careerVideo->getClientOriginalExtension();
            Storage::disk('public')->put($videoName,  File::get($careerVideo));
            $requestData['video_name'] = $videoName;
            // $path = Storage::disk('s3')->put('images', $request->image);

            // $path = Storage::disk('s3')->url($path);
            // $gallary->image =  $requestData['image'];
            // $gallary->save();
        }

        VideoGallery::create($requestData);
        return Redirect::route('admin.gallery.video')->with('success', 'successfully submitted!');
    }


    public function editGalleryVideo(Request $request)
    {
        $rules = [
            'id' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $video = VideoGallery::find($request->id);

            if ($request->video_name) {
                $careerVideo = $request->file('video_name');
                $videoName = time() . 'aboutVideo.' . $careerVideo->getClientOriginalExtension();
                Storage::disk('public')->put($videoName,  File::get($careerVideo));
                $requestData['video_name'] = $videoName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            unset($requestData['_token']);
            unset($requestData['id']);
            $contactAdd = VideoGallery::where('id', $video->id)->update($requestData);

            return Redirect::route('admin.gallery.video')->with('success', 'successfully submitted!');
        }
    }

    public function deleteGalleryVideo($id)
    {
        VideoGallery::where('id', $id)->delete();
        return Redirect::route('admin.gallery.video')->with('success', 'successfully submitted!');
    }

    public function statusCareerVideo($id)
    {
        $videoStatus = VideoGallery::find($id);
        if ($videoStatus) {
            $active = $videoStatus->active ? 0 : 1;
            $alreadyActivated = VideoGallery::where('active', 1)->first();
            if ($alreadyActivated && $alreadyActivated->active == $active) {
                return Redirect::route('admin.career.video')->with('error', 'One video already published Please unpublished !');
            } else {
                VideoGallery::where('id', $id)->update(['active' => $active]);
            }
            $response  = $active ? 'Published' : 'Unpublished';
            return Redirect::route('admin.career.video')->with('success', 'Carrer video ' . $response . ' Successfully !');
        } else {
            return Redirect::route('admin.career.video')->with('error', 'Data Not Found!');
        }
    }

    public function themeChange(Request $request)
    {
        $theme = $request->theme;
        $request->session()->put('theme', $theme);
        return 'success';
    }

    // career video end
}
