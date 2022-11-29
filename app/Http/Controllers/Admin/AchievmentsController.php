<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Achievments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class AchievmentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $achievments = Achievments::first();
        // dd($courseType);
        return view('admin.achievment', compact('user', 'achievments'));
    }

    public function addAchievment(Request $request)
    {
        $rules = [
            'student_ratio'  => 'required',
            'faculty_ratio'  => 'required',
            'institute_ratio'  => 'required',
            'school_ratio'  => 'required',
            'college_ratio'  => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = Achievments::create($requestData);
            return Redirect::route('admin.achievment')->with('success', 'successfully submitted!');
        }
    }

    public function updateAchievment(Request $request)
    {
        $rules = [
            'student_ratio'  => 'required',
            'faculty_ratio'  => 'required',
            'institute_ratio'  => 'required',
            'school_ratio'  => 'required',
            'college_ratio'  => 'required',
            'id' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            unset($requestData['id']);
            Achievments::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.achievment')->with('success', 'successfully submitted!');
        }
    }
}
