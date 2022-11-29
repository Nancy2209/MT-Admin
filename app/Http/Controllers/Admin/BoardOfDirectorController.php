<?php


namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\BoardOfDirector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class BoardOfDirectorController extends Controller
{
    public function index()
    {
        $directors = BoardOfDirector::all();
        // dd($courseType);
        return view('admin.board_director', compact('directors'));
    }

    public function addMember(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'board.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            $success = BoardOfDirector::create($requestData);
            return Redirect::route('admin.boardOfDirectors')->with('success', 'successfully submitted!');
        }
    }

    public function updateMember(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            if ($request->image) {
                $aboutImage = $request->file('image');
                $aboutName = time() . 'board.' . $aboutImage->getClientOriginalExtension();
                Storage::disk('public')->put($aboutName,  File::get($aboutImage));
                $requestData['image'] = $aboutName;
                // $path = Storage::disk('s3')->put('images', $request->image);

                // $path = Storage::disk('s3')->url($path);
                // $gallary->image =  $requestData['image'];
                // $gallary->save();
            }
            BoardOfDirector::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.boardOfDirectors')->with('success', 'successfully submitted!');
        }
    }

    public function deleteMember($id)
    {
        BoardOfDirector::where('id', $id)->delete();
        return Redirect::route('admin.boardOfDirectors')->with('success', 'successfully submitted!');
    }
}
