<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class CourseDetailController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courseDetails = CourseDetail::with('courseType')->get();
        $courses = CourseType::all();
        return view('admin.course_details', compact('user', 'courseDetails', 'courses'));
    }

    public function getCourses($id)
    {
        $courseDe = explode(',', $id);
        $courseTypeDetails = CourseType::whereIn('id', $courseDe)->get();
        return $courseTypeDetails;
    }

    public function addCourseDetail(Request $request)
    {


        $rules = [
            'course_id' => 'required',
            'title' => 'required',
            'tag_name' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'

        ];
        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file('image')) {
                //            profile image upload
                $Image = $request->file('image');
                $profileName = time() . 'course.' . $Image->getClientOriginalExtension();
                Storage::disk('public')->put($profileName,  File::get($Image));
                $requestData['image'] = $profileName;
            }
            $success = CourseDetail::create($requestData);
            return Redirect::route('admin.coursedetail')->with('success', 'successfully submitted!');
        }
    }

    public function updateCourseDetail(Request $request)
    {
        $rules = [
            'id' => 'required',
            'course_id' => 'required',
            'title' => 'required',
            'tag_name' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $course = CourseDetail::find($request->id);
            if ($course) {
                if ($request->file('image')) {
                    //            profile image upload
                    $Image = $request->file('image');
                    $profileName = time() . 'course.' . $Image->getClientOriginalExtension();
                    Storage::disk('public')->put($profileName,  File::get($Image));
                    $requestData['image'] = $profileName;
                }
                unset($requestData['_token']);
                $success = CourseDetail::where('id', $course->id)->update($requestData);
                return Redirect::route('admin.coursedetail')->with('success', 'successfully submitted!');
            } else {
                return Redirect::route('admin.coursedetail')->with('success', 'Course not found!');
            }
        }
    }

    public function deleteCourseDetail($id)
    {
        CourseDetail::where('id', $id)->delete();
        return Redirect::route('admin.coursedetail')->with('success', 'successfully submitted!');
    }
}
