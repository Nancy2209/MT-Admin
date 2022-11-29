<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReleaseCategory;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class ReportController extends Controller
{
    // Report Category start
    public function reportCategory(Request $request)
    {
        $categories = ReportCategory::all();
        return view('admin.report_category', compact('categories'));
    }

    public function addReportCategory(Request $request)
    {
        $rules = [
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ReportCategory::create($requestData);
        return Redirect::route('admin.report.category')->with('success', 'successfully submitted!');
    }


    public function editReportCategory(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $investor = ReportCategory::find($request->id);
            unset($requestData['_token']);
            $contactAdd = ReportCategory::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.report.category')->with('success', 'successfully submitted!');
        }
    }

    public function deleteReportCategory($id)
    {
        ReportCategory::where('id', $id)->delete();
        return Redirect::route('admin.report.category')->with('success', 'successfully submitted!');
    }

    // Report start
    public function reports(Request $request)
    {
        $reports = Report::all();
        $categories = ReportCategory::all();
        return view('admin.reports', compact('reports', 'categories'));
    }

    public function addReports(Request $request)
    {
        $rules = [
            'file_name' =>  'required',
            'report_year' =>  'required',
            'quarter_code' =>  'required',
            'quarter_name' =>  'required',
            'report_category_id' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file_name) {
                $fileName = $request->file('file_name');
                $file = time() . 'report.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['file_name'] = $file;
            }
        }

        Report::create($requestData);
        return Redirect::route('admin.report')->with('success', 'successfully submitted!');
    }


    public function editReports(Request $request)
    {
        $rules = [
            'id' => 'required',
            'report_year' =>  'required',
            'quarter_code' =>  'required',
            'quarter_name' =>  'required',
            'report_category_id' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $investor = Report::find($request->id);

            if ($request->file_name) {
                $filename = $request->file('file_name');
                $file = time() . 'report.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['file_name'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = Report::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.report')->with('success', 'successfully submitted!');
        }
    }

    public function deleteReports($id)
    {
        Report::where('id', $id)->delete();
        return Redirect::route('admin.report')->with('success', 'successfully submitted!');
    }
}
