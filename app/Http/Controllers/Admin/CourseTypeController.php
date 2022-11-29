<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\CourseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class CourseTypeController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $courses = CourseType::all();
        return view('admin.courses', compact('user', 'courses'));
    }

    public function addCourse(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = CourseType::create($requestData);
            return Redirect::route('admin.courselist')->with('success', 'successfully submitted!');
        }
    }

    public function updateCourse(Request $request)
    {
        $rules = [
            'name' => 'required',
            'id' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            CourseType::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.courselist')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCourse($id)
    {
        CourseType::where('id', $id)->delete();
        return Redirect::route('admin.courselist')->with('success', 'successfully submitted!');
    }
}
