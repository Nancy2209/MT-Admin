<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CareerVideo;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCount;
use App\Models\UserTestimonial;
use App\Models\VideoGallery;
use Response;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::all();
        return view('admin.media', compact('medias'));
    }

    public function addMedia(Request $request)
    {
        $rules = [
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            Media::create($requestData);
            return Redirect::route('admin.media')->with('success', 'successfully submitted!');
        }
    }


    public function updateMedia(Request $request)
    {
        $rules = [
            'id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            unset($requestData['_token']);
            $mediaAdd = Media::where('id', $request->id)->update($requestData);

            return Redirect::route('admin.media')->with('success', 'successfully submitted!');
        }
    }

    public function deleteMedia($id)
    {
        Media::where('id', $id)->delete();
        return Redirect::route('admin.media')->with('success', 'successfully submitted!');
    }
}
