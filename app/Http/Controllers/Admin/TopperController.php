<?php


namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Topper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class TopperController extends Controller
{
    // List topper us
    public function index()
    {
        $user = Auth::user();
        $toppers = Topper::all();
        return view('admin.topper', compact('user', 'toppers'));
    }

    // add topper intro page
    public function addToppers(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            if ($request->file('image')) {
                $topperImage = $request->file('image');
                $topperName = time() . 'topperImage.' . $topperImage->getClientOriginalExtension();
                Storage::disk('public')->put($topperName,  File::get($topperImage));
                $requestData['image'] = $topperName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }

            $success = Topper::create($requestData);
            return Redirect::route('admin.topper')->with('success', 'Updated Successfully!');
        }
    }

    // edit topper page
    public function updateTopper(Request $request)
    {
        $rules = [
            'name' => 'required',
            'percentage' => 'required',
            'description' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            if ($request->file('image')) {
                $topperImage = $request->file('image');
                $topperName = time() . 'topperImage.' . $topperImage->getClientOriginalExtension();
                Storage::disk('public')->put($topperName,  File::get($topperImage));
                $requestData['image'] = $topperName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }

            Topper::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.topper')->with('success', 'Updated Successfully!');
        }
    }

    // delete topper details
    public function deleteToppers($id)
    {
        Topper::where('id', $id)->delete();
        return Redirect::route('admin.topper')->with('success', 'Updated Successfully!');
    }
}
