<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class CityController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $states = State::all();
        $cities = City::with('state')->get();
        // dd($courseType);
        return view('admin.city', compact('user', 'cities', 'states'));
    }

    public function addCity(Request $request)
    {
        $rules = [
            'state_id' => 'required',
            'name' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = City::create($requestData);
            return Redirect::route('admin.cities')->with('success', 'successfully submitted!');
        }
    }

    public function updateCity(Request $request)
    {
        $rules = [
            'state_id' => 'required',
            'name' => 'required',
            'id' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            City::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.cities')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCity($id)
    {
        City::where('id', $id)->delete();
        return Redirect::route('admin.cities')->with('success', 'successfully submitted!');
    }
}
