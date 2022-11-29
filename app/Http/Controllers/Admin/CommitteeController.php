<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class CommitteeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $committees = Committee::all();
        return view('admin.committe', compact('user', 'committees'));
    }

    public function addCommittee(Request $request)
    {
        $rules = [
            'name' => 'required',
            'title' => 'required',
            'designation' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = Committee::create($requestData);
            return Redirect::route('admin.committee')->with('success', 'successfully submitted!');
        }
    }

    public function updateCommittee(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'title' => 'required',
            'designation' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            Committee::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.committee')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCommittee($id)
    {
        Committee::where('id', $id)->delete();
        return Redirect::route('admin.committee')->with('success', 'successfully submitted!');
    }
}
