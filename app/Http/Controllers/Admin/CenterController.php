<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class CenterController extends Controller
{
    // list of centers
    public function index()
    {
        $user = Auth::user();
        $states = State::all();
        $centers = Center::with(['state', 'city'])->get();

        return view('admin.centers', compact('user', 'centers', 'states'));
    }

    // add center
    public function addCenters(Request $request)
    {
        $rules = [
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|string',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required|',
            'zip_code' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $requestData['code'] = '+91';

            $success = Center::create($requestData);
            return Redirect::route('admin.centers')->with('success', 'successfully submitted!');
        }
    }

    // edit center
    public function updateCenters(Request $request)
    {
        $rules = [
            'id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            'zip_code' => 'required',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            Center::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.centers')->with('success', 'successfully submitted!');
        }
    }

    // delete center
    public function deleteCenter($id)
    {
        Center::where('id', $id)->delete();
        return Redirect::route('admin.centers')->with('success', 'successfully submitted!');
    }

    // get city by state Id
    public function stateCity(Request $request)
    {
        $id = $request->id;
        $cities = City::where('state_id', $id)->get();
        $returnHTML = view('admin.render.cityOption', compact('cities'))->render();
        return Response::json(['success' => true, 'data' => $returnHTML]);
    }
}
