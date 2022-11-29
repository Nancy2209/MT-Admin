<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class StateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $states = State::all();
        // dd($courseType);
        return view('admin.state', compact('user', 'states'));
    }

    public function addState(Request $request)
    {
        $rules = [
            'name' => 'required||regex:/^[\pL\s\-]+$/u|',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = State::create($requestData);
            return Redirect::route('admin.states')->with('success', 'successfully submitted!');
        }
    }

    public function updateState(Request $request)
    {
        $rules = [
            'name' => 'required||regex:/^[\pL\s\-]+$/u|',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            State::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.states')->with('success', 'successfully submitted!');
        }
    }

    public function deleteState($id)
    {
        State::where('id', $id)->delete();
        return Redirect::route('admin.states')->with('success', 'successfully submitted!');
    }
}
