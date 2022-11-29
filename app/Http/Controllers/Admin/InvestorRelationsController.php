<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CorpGovernance;
use App\Models\InvestorPresentation;
use App\Models\PressRelease;
use App\Models\ReleaseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class InvestorRelationsController extends Controller
{
    public function corpGovernance(Request $request)
    {
        $corps = CorpGovernance::all();
        return view('admin.corp_governance', compact('corps'));
    }

    public function addCorpGovernance(Request $request)
    {
        $rules = [
            'filename' =>  'required|max:10000|mimes:pdf',
            'file_title' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->filename) {
                $fileName = $request->file('filename');
                $file = time() . 'corp.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['filename'] = $file;
            }
        }

        CorpGovernance::create($requestData);
        return Redirect::route('admin.corp.governance')->with('success', 'successfully submitted!');
    }


    public function editCorpGovernance(Request $request)
    {
        $rules = [
            'id' => 'required',

            'file_title' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $video = CorpGovernance::find($request->id);

            if ($request->filename) {
                $filename = $request->file('filename');
                $file = time() . 'corp.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['filename'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = CorpGovernance::where('id', $video->id)->update($requestData);

            return Redirect::route('admin.corp.governance')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCorpGovernance($id)
    {
        CorpGovernance::where('id', $id)->delete();
        return Redirect::route('admin.corp.governance')->with('success', 'successfully submitted!');
    }


    // Invester presentations start
    public function investerPresentation(Request $request)
    {
        $investers = InvestorPresentation::all();
        return view('admin.invester_presentation', compact('investers'));
    }

    public function addInvesterPresentation(Request $request)
    {
        $rules = [
            'file_name' =>  'required',
            'invest_year' =>  'required',
            'quarter_name' =>  'required',
            'quarter_code' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file_name) {
                $fileName = $request->file('file_name');
                $file = time() . 'investment.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['file_name'] = $file;
            }
        }

        InvestorPresentation::create($requestData);
        return Redirect::route('admin.invester.presentation')->with('success', 'successfully submitted!');
    }


    public function editInvesterPresentation(Request $request)
    {
        $rules = [
            'id' => 'required',
            'invest_year' =>  'required',
            'quarter_name' =>  'required',
            'quarter_code' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $investor = InvestorPresentation::find($request->id);

            if ($request->file_name) {
                $filename = $request->file('file_name');
                $file = time() . 'investment.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['file_name'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = InvestorPresentation::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.invester.presentation')->with('success', 'successfully submitted!');
        }
    }

    public function deleteInvesterPresentation($id)
    {
        CorpGovernance::where('id', $id)->delete();
        return Redirect::route('admin.invester.presentation')->with('success', 'successfully submitted!');
    }

    // Release Category start
    public function releaseCategory(Request $request)
    {
        $categories = ReleaseCategory::all();
        return view('admin.release_category', compact('categories'));
    }

    public function addReleaseCategory(Request $request)
    {
        $rules = [
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ReleaseCategory::create($requestData);
        return Redirect::route('admin.release.category')->with('success', 'successfully submitted!');
    }


    public function editReleaseCategory(Request $request)
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

            $investor = ReleaseCategory::find($request->id);
            unset($requestData['_token']);
            $contactAdd = ReleaseCategory::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.release.category')->with('success', 'successfully submitted!');
        }
    }

    public function deleteReleaseCategory($id)
    {
        ReleaseCategory::where('id', $id)->delete();
        return Redirect::route('admin.release.category')->with('success', 'successfully submitted!');
    }


    // Press Releases start
    public function pressReleases(Request $request)
    {
        $press_releases = PressRelease::all();
        $categories = ReleaseCategory::all();
        return view('admin.press_release', compact('press_releases', 'categories'));
    }

    public function addPressReleases(Request $request)
    {
        $rules = [
            'file_name' =>  'required',
            'file_title' =>  'required',
            'date' =>  'required',
            'invest_quater' =>  'required',
            'release_category_id' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file_name) {
                $fileName = $request->file('file_name');
                $file = time() . 'pressRelease.' . $fileName->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($fileName));
                $requestData['file_name'] = $file;
            }
        }

        PressRelease::create($requestData);
        return Redirect::route('admin.press.release')->with('success', 'successfully submitted!');
    }


    public function editPressReleases(Request $request)
    {
        $rules = [
            'id' => 'required',
            'file_title' =>  'required',
            'date' =>  'required',
            'invest_quater' =>  'required',
            'release_category_id' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $investor = PressRelease::find($request->id);

            if ($request->file_name) {
                $filename = $request->file('file_name');
                $file = time() . 'investment.' . $filename->getClientOriginalExtension();
                Storage::disk('public')->put($file,  File::get($filename));
                $requestData['file_name'] = $file;
            }
            unset($requestData['_token']);
            $contactAdd = PressRelease::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.press.release')->with('success', 'successfully submitted!');
        }
    }

    public function deletePressReleases($id)
    {
        PressRelease::where('id', $id)->delete();
        return Redirect::route('admin.press.release')->with('success', 'successfully submitted!');
    }
}
