<?php

namespace App\Http\Controllers\Admin;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class AwardController extends Controller
{
    // list of awards
    public function index()
    {
        $user = Auth::user();
        $awards = Award::all();
        // dd($courseType);
        return view('admin.awards', compact('user', 'awards'));
    }

    // add awards data

    public function addAward(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $imageData = array();
            if ($request->hasfile('image') && count($request->file('image')) > 0) {
                foreach ($request->file('image') as $image) {
                    $profileName = time() . rand(1, 100) . 'awards.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->put('awards/' . $profileName,  File::get($image));
                    $imageData[] = $profileName;
                }
            }
            $requestData['image'] = json_encode($imageData);
            Award::create($requestData);
            return Redirect::route('admin.award')->with('success', 'successfully submitted!');
        }
    }

    public function updateAward(Request $request)
    {
        // $imageRule = $request->hasfile('image') ? 'mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable';
        $rules = [
            'title' => 'required',
            'description' => 'required',
            // 'image' => $imageRule
        ];


        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            $imageData = [];
            if ($request->hasfile('image') && count($request->file('image')) > 0) {
                $allowed = array("jpeg", "gif", "png", "jpg");
                foreach ($request->file('image') as $image) {
                    // dd(in_array($image->getClientOriginalExtension(), $allowed));
                    if (in_array($image->getClientOriginalExtension(), $allowed)) {
                        $profileName = time() . rand(1, 100) . 'awards.' . $image->getClientOriginalExtension();
                        Storage::disk('public')->put('awards/' . $profileName,  File::get($image));
                        $imageData[] = $profileName;
                    } else {
                        return Redirect::route('admin.award')->with('error', 'All file shoulde jpg,png,gif only!');
                    }
                }
                // dd($imageData);
                $requestData['image'] = json_encode($imageData);
            }

            Award::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.award')->with('success', 'successfully submitted!');
        }
    }

    public function deleteAward($id)
    {
        Award::where('id', $id)->delete();
        return Redirect::route('admin.award')->with('success', 'successfully submitted!');
    }
}
