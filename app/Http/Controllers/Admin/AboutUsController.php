<?php


namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class AboutUsController extends Controller
{
    // List about us 
    public function index()
    {
        $user = Auth::user();
        $abouts = AboutUs::all();
        // dd($courseType);
        return view('admin.aboutus', compact('user', 'abouts'));
    }

    // add about intro page
    public function addAbouts(Request $request)
    {
        $rules = [
            'year' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'aboutImage.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            $data = json_encode(['center' => $request->centers, 'revenue' => $request->revenue, 'students' => $request->students], true);
            $requestData['key_highlights'] = $data;
            unset($requestData['centers']);
            unset($requestData['revenue']);
            unset($requestData['students']);
            $success = AboutUs::create($requestData);
            return Redirect::route('admin.about')->with('success', 'successfully submitted!');
        }
    }

    // edit about page 
    public function updateAbouts(Request $request)
    {
        $rules = [
            'id' => 'required',
            'year' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'aboutImage.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            $data = json_encode(['center' => $request->centers, 'revenue' => $request->revenue, 'students' => $request->students], true);
            $requestData['key_highlights'] = $data;
            unset($requestData['_token']);
            unset($requestData['centers']);
            unset($requestData['revenue']);
            unset($requestData['students']);
            AboutUs::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.about')->with('success', 'successfully submitted!');
        }
    }

    // delete about details
    public function deleteAbouts($id)
    {
        AboutUs::where('id', $id)->delete();
        return Redirect::route('admin.about')->with('success', 'successfully submitted!');
    }
}
