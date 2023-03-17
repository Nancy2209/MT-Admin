<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CareerVideo;
use App\Models\Enquiry;
use App\Models\Media;
use App\Models\MetaTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCount;
use App\Models\UserTestimonial;
use App\Models\VideoGallery;
use Response;

class MetaTagsController extends Controller
{
    public function metaTags()
    {
        $metaTags = MetaTag::all();
        return view('admin.meta_tag', compact('metaTags'));
    }

    public function addMetaTags(Request $request)
    {
        $rules = [
            'page_name' => 'required',
            'mata_title' => 'required',
            'mata_keyboard' => 'required',
            'mata_description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            MetaTag::create($requestData);
            return Redirect::route('admin.meta.tag')->with('success', 'Updated Successfully!');
        }
    }


    public function editMetaTags(Request $request)
    {
        $rules = [
            'page_name' => 'required',
            'mata_title' => 'required',
            'mata_keyboard' => 'required',
            'mata_description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            unset($requestData['_token']);
            $mediaAdd = MetaTag::where('id', $request->id)->update($requestData);

            return Redirect::route('admin.meta.tag')->with('success', 'Updated Successfully!');
        }
    }

    public function deleteMetaTags($id)
    {
        MetaTag::where('id', $id)->delete();
        return Redirect::route('admin.meta.tag')->with('success', 'Updated Successfully!');
    }

    public function enquiry()
    {
        $enquires = Enquiry::all();
        return view('admin.enquiry', compact('enquires'));
    }


    public function editEnquiry(Request $request)
    {
        $rules = [
            'page_name' => 'required',
            'mata_title' => 'required',
            'mata_keyboard' => 'required',
            'mata_description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            unset($requestData['_token']);
            $mediaAdd = MetaTag::where('id', $request->id)->update($requestData);

            return Redirect::route('admin.meta.tag')->with('success', 'Updated Successfully!');
        }
    }

    public function deleteEnquiry($id)
    {
        Enquiry::where('id', $id)->delete();
        return Redirect::route('admin.enquiry')->with('success', 'Updated Successfully!');
    }
}
