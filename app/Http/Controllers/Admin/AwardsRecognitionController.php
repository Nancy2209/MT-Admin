<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardsRecognition;

class AwardsRecognitionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $awards = AwardsRecognition::all();
        // dd($courseType);
        return view('admin.awards.index', compact('user', 'awards'));
    }

    public function addAwards(Request $request)
    {
        dd($request);
        $rules = [
            'award_title' => 'required',
            'description' => 'required',
            'image' => 'required',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = AwardsRecognition::create($requestData);
            return Redirect::route('admin.awards')->with('success', 'successfully submitted!');
        }
    }

    public function updateAwards(Request $request)
    {
        $rules = [
            'award_title' => 'required',
            'description' => 'required',
            'image' => 'required',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            AwardsRecognition::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.awards')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCenter($id)
    {
        AwardsRecognition::where('id', $id)->delete();
        return Redirect::route('admin.abouts');
    }
}
