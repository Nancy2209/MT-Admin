<?php


namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\BoardOfDirector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KeyManagement;
use App\Models\KeyManagementBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class KeyManagementController extends Controller
{
    public function index()
    {
        $directors = KeyManagementBoard::all();
        // dd($courseType);
        return view('admin.key_management', compact('directors'));
    }

    public function addKeyMember(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            // 'image' => 'mimes:jpeg,jpg,png,gif|max:2048'

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file('image')) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'board.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            $success = KeyManagementBoard::create($requestData);
            return Redirect::route('admin.keyManagement')->with('success', 'Updated Successfully!');
        }
    }

    public function updateKeyMember(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            if ($request->file('image')) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'board.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            KeyManagementBoard::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.keyManagement')->with('success', 'Updated Successfully!');
        }
    }

    public function deleteKeyMember($id)
    {
        KeyManagementBoard::where('id', $id)->delete();
        return Redirect::route('admin.keyManagement')->with('success', 'Updated Successfully!');
    }
}
