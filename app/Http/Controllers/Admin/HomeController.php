<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CareerVideo;
use App\Models\City;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCount;
use App\Models\UserTestimonial;
use App\Models\VideoGallery;
use App\Models\Gallary;
use App\Models\GalleryCategory;
use App\Models\State;
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

            return Redirect::route('admin.jobs')->with('success', 'Updated Successfully!');
        }
    }

    public function deleteJobs($id)
    {
        Job::where('id', $id)->delete();
        return Redirect::route('admin.jobs')->with('success', 'Updated Successfully!');
    }
    // Jobs End

    // Gallert Category start

    // Gallert Category start
    public function galleryCategory(Request $request)
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery_category', compact('categories'));
    }

    public function addGalleryCategory(Request $request)
    {
        $rules = [
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        GalleryCategory::create($requestData);
        return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
    }


    public function editGalleryCategory(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $investor = GalleryCategory::find($request->id);
            unset($requestData['_token']);
            $contactAdd = GalleryCategory::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
        }
    }

    public function deleteGalleryCategory($id)
    {
        GalleryCategory::where('id', $id)->delete();
        return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
    }

    public function gallary()
    {
        $user = Auth::user();
        $gallaries = Gallary::with('category')->get();

        $categories = GalleryCategory::all();
        return view('admin.gallary', compact('user', 'gallaries', 'categories'));
    }

    public function addGallary(Request $request)
    {
        $rules = [
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $profileImage = $request->file('image');
            $profileName = time() . 'gallary.' . $profileImage->getClientOriginalExtension();
            Storage::disk('public')->put($profileName,  File::get($profileImage));
            $requestData['image'] =  $profileName;
            //dd($requestData);
            $gallary = Gallary::create($requestData);
            // $path = Storage::disk('s3')->put('images', $request->image);

            // $path = Storage::disk('s3')->url($path);

            //     dd($path);
            return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
        }
    }

    public function editGallary(Request $request)
    {
        $rules = [
            'gallary_id' => 'required',
            'category_id' => 'required',
            // 'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $gallary = Gallary::find($request->gallary_id);
            if ($request->image) {
                $profileImage = $request->file('image');
                $profileName = time() . 'gallary.' . $profileImage->getClientOriginalExtension();
                Storage::disk('public')->put($profileName,  File::get($profileImage));
                $requestData['image'] =  $profileName;
            }
            unset($requestData['_token']);
            unset($requestData['gallary_id']);
            Gallary::where('id', $gallary->id)->update($requestData);
            return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
        }
    }

    public function deleteGallary($id)
    {
        Gallary::where('id', $id)->delete();
        return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
    }


    public function logout()
    {
        $user = Auth::logout();
        return redirect()->route('admin.showlogin');
    }

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
        return Redirect::route('admin.gallery.video')->with('success', 'Updated Successfully!');
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

    public function checkUnique(Request $request)
    {
        $state = State::where('name', $request->state)->first();
        if ($state) {
            return 'error';
        } else {
            return 'success';
        }
    }

    public function checkUniqueCity(Request $request)
    {
        $city = City::where('name', $request->city)->first();
        if ($city) {
            return 'error';
        } else {
            return 'success';
        }
    }

    // career video end
}
