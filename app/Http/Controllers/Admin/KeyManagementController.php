<?php

namespace App\Http\Controllers\Admin;

use App\Models\BoardOfDirector;
use App\Models\KeyManagement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KeyManagementController extends Controller
{
    public function index()
    {
        $directors = KeyManagement::all();
        return view('admin.key_management', compact('directors'));
    }

    public function addKeyMember(Request $request)
    {
        $rules = [
            'title' => 'required',
            'email' => 'required',
            'mobile' => 'required',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $success = KeyManagement::create($requestData);
            return Redirect::route('admin.keyManagement')->with('success', 'successfully submitted!');
        }
    }

    public function updateKeyMember(Request $request)
    {
        $rules = [
            'title' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'id'  => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);

            KeyManagement::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.keyManagement')->with('success', 'successfully submitted!');
        }
    }

    public function deleteKeyMember($id)
    {
        KeyManagement::where('id', $id)->delete();
        return Redirect::route('admin.keyManagement')->with('success', 'successfully submitted!');
    }
}
