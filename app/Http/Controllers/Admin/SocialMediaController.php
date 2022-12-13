<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\ClassCategory;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use App\Models\SocialMedia;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class SocialMediaController extends Controller
{
    public function socialMedia()
    {
        $socialMedia = SocialMedia::all();
        // dd($subjects);
        return view('admin.soical_media', compact('socialMedia'));
    }


    public function addSocialMedia(Request $request)
    {
        $rules = [
            'name' => 'required',
            'link' => 'required',
            'image' => 'required'
        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'social.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
            }
            $success = SocialMedia::create($requestData);
            return Redirect::route('admin.socail.media')->with('success', 'Updated Successfully!');
        }
    }

    public function editSocialMedia(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'link' => 'required',
            //'image' => 'required'
        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'social.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
            }
            SocialMedia::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.socail.media')->with('success', 'Updated Successfully!');
        }
    }


    public function deleteSocialMedia($id)
    {
        SocialMedia::where('id', $id)->delete();
        return Redirect::route('admin.socail.media')->with('success', 'Updated Successfully!');
    }
}
