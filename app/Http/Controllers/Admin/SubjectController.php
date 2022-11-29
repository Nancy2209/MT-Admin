<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\ClassCategory;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class SubjectController extends Controller
{
    public function index()
    {
        $courses = CourseType::all();
        $subjects = Subject::all();
        // dd($subjects);
        return view('admin.subjects', compact('courses', 'subjects'));
    }

    public function getStandards($id)
    {
        $standardDe = explode(',', $id);
        $classCategories = ClassCategory::whereIn('id', $standardDe)->get();
        return $classCategories;
    }

    public function addSubject(Request $request)
    {
        $rules = [
            'classCategory_id' => 'required',
            'course_id' => 'required',
            'board_name' => 'required',
            'name' => 'required',
        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // dd($requestData);
            // $standard = ClassCategory::find($request->classCategory_id);
            // $requestData['classCategory_id'] = $standard;
            $success = Subject::create($requestData);
            return Redirect::route('admin.subjects')->with('success', 'successfully submitted!');
        }
    }

    public function updateSubject(Request $request)
    {
        $rules = [
            'id' => 'required',
            'classCategory_id' => 'required',
            'course_id' => 'required',
            'board_name' => 'required',
            'name' => 'required'
        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            $standard = CourseType::find($request->classCategory_id);
            if ($standard) {
                $requestData['classCategory_id'] = $standard->id;
            }
            // dd($requestData);
            Subject::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.subjects')->with('success', 'successfully submitted!');
        }
    }


    public function deleteSubject($id)
    {
        Subject::where('id', $id)->delete();
        return Redirect::route('admin.subjects')->with('success', 'successfully submitted!');
    }

    // get standard by Class Category
    public function courseStandard(Request $request)
    {
        $id = $request->id;
        $standards = ClassCategory::where('course_id', $id)->get();
        $returnHTML = view('admin.render.standardOption', compact('standards'))->render();
        return Response::json(['success' => true, 'data' => $returnHTML]);
    }

    public function standardBoard(Request $request)
    {
        $id = $request->id;
        $standards = ClassCategory::where('id', $id)->get();
        $returnHTML = view('admin.render.boardOption', compact('standards'))->render();
        return Response::json(['success' => true, 'data' => $returnHTML]);
    }
}
