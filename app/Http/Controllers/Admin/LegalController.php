<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disclaimer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallary;
use App\Models\PrivacyPolicy;
use App\Models\Team;
use App\Models\Term;
use Response;

class LegalController extends Controller
{
    public function privacyPolicy()
    {
        $policy = PrivacyPolicy::first();
        return view('admin.policy', compact('policy'));
    }

    public function addPolicy(Request $request)
    {
        // dd($request);
        $rules = [
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            PrivacyPolicy::create($requestData);
            return Redirect::route('admin.privacy_policy')->with('success', 'successfully submitted!');
        }
    }


    public function editPolicy(Request $request)
    {
        $rules = [
            'policy_id' => 'required',
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $policy = PrivacyPolicy::find($request->policy_id);

            $policy->description =  $requestData['description'];
            $policy->save();

            return Redirect::route('admin.privacy_policy')->with('success', 'successfully submitted!');
        }
    }

    public function term()
    {
        $term = Term::first();
        return view('admin.terms', compact('term'));
    }

    public function addTerm(Request $request)
    {
        // dd($request);
        $rules = [
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            Term::create($requestData);
            return Redirect::route('admin.terms')->with('success', 'successfully submitted!');
        }
    }


    public function editTerm(Request $request)
    {
        $rules = [
            'term_id' => 'required',
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $term = Term::find($request->term_id);

            $term->description =  $requestData['description'];
            $term->save();

            return Redirect::route('admin.terms')->with('success', 'successfully submitted!');
        }
    }

    public function deleteTerm($id)
    {
        Term::where('id', $id)->delete();
        return Redirect::route('admin.terms')->with('success', 'successfully submitted!');
    }


    public function disclaimer()
    {
        $disclaimer = Disclaimer::first();
        return view('admin.disclaimer', compact('disclaimer'));
    }

    public function addDisclaimer(Request $request)
    {
        // dd($request);
        $rules = [
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            Disclaimer::create($requestData);
            return Redirect::route('admin.disclaimer')->with('success', 'successfully submitted!');
        }
    }


    public function editDisclaimer(Request $request)
    {
        $rules = [
            'id' => 'required',
            'description' =>  'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $disclaimer = Disclaimer::find($request->id);

            $disclaimer->description =  $requestData['description'];
            $disclaimer->save();

            return Redirect::route('admin.disclaimer')->with('success', 'successfully submitted!');
        }
    }
}
