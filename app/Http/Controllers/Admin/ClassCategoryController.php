<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\ClassCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ClassCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classCategories = ClassCategory::with('courseType')->get();
        $courses = CourseType::all();
        return view('admin.class_categories', compact('user', 'classCategories', 'courses'));
    }

    public function getCourses($id)
    {
        $courseDe = explode(',', $id);
        $courseTypeDetails = CourseType::whereIn('id', $courseDe)->get();
        return $courseTypeDetails;
    }

    public function addClass(Request $request)
    {


        $rules = [
            'course_id' => 'required',
            'name' => 'required',
            'board_name' => 'required',


        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $success = ClassCategory::create($requestData);
            return Redirect::route('admin.classCategory')->with('success', 'successfully submitted!');
        }
    }

    public function updateClass(Request $request)
    {
        $rules = [
            'id' => 'required',
            'course_id' => 'required',
            'name' => 'required',
            'board_name' => 'required',


        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $course = ClassCategory::find($request->id);

            unset($requestData['_token']);
            $success = ClassCategory::where('id', $course->id)->update($requestData);
            return Redirect::route('admin.classCategory')->with('success', 'successfully submitted!');
        }
    }


    public function deleteClass($id)
    {
        ClassCategory::where('id', $id)->delete();
        return Redirect::route('admin.classCategory')->with('success', 'successfully submitted!');
    }
}
