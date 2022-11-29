<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReleaseCategory;
use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\StudentHear;
use App\Models\WeOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class WeOfferController extends Controller
{


    // we offer start
    public function weOffer(Request $request)
    {
        $offers = WeOffer::all();
        return view('admin.weOffer', compact('offers'));
    }

    public function addOffer(Request $request)
    {
        $rules = [
            'title' =>  'required',
            'description' =>  'required',
            'image' =>  'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $fileName = $request->file('image');
                $file = time() . 'offer.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['image'] = $file;
            }
        }

        WeOffer::create($requestData);
        return Redirect::route('admin.we.offer')->with('success', 'successfully submitted!');
    }


    public function editOffer(Request $request)
    {
        $rules = [
            'id' => 'required',
            'title' =>  'required',
            'description' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $offer = WeOffer::find($request->id);

            if ($request->image) {
                $filename = $request->file('image');
                $file = time() . 'offer.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['image'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = WeOffer::where('id', $offer->id)->update($requestData);

            return Redirect::route('admin.we.offer')->with('success', 'successfully submitted!');
        }
    }

    public function deleteOffer($id)
    {
        WeOffer::where('id', $id)->delete();
        return Redirect::route('admin.we.offer')->with('success', 'successfully submitted!');
    }


    // student hears start
    public function studentHear(Request $request)
    {
        $hears = StudentHear::all();
        return view('admin.student_hear', compact('hears'));
    }

    public function addStudenHears(Request $request)
    {
        $rules = [
            'name' =>  'required',
            'designation' =>  'required',
            'description' =>  'required',
            'image' =>  'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $fileName = $request->file('image');
                $file = time() . 'studenthear.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['image'] = $file;
            }
        }

        StudentHear::create($requestData);
        return Redirect::route('admin.student.hear')->with('success', 'successfully submitted!');
    }


    public function editStudentHear(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' =>  'required',
            'designation' => 'required',
            'description' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $hear = StudentHear::find($request->id);

            if ($request->image) {
                $filename = $request->file('image');
                $file = time() . 'studenthear.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['image'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = StudentHear::where('id', $hear->id)->update($requestData);

            return Redirect::route('admin.student.hear')->with('success', 'successfully submitted!');
        }
    }

    public function deleteStudentHear($id)
    {
        StudentHear::where('id', $id)->delete();
        return Redirect::route('admin.student.hear')->with('success', 'successfully submitted!');
    }
}
