<?php

namespace App\Http\Controllers\Admin;

use App\SiteLogo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallary;
use App\Models\GalleryCategory;
use Response;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }


    // Gallert Category start
    public function galleryCategory(Request $request)
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery_category', compact('categories'));
    }

    public function addGalleryCategory(Request $request)
    {
        $rules = [
            'name' =>  'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        GalleryCategory::create($requestData);
        return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
    }


    public function editGalleryCategory(Request $request)
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

            $investor = GalleryCategory::find($request->id);
            unset($requestData['_token']);
            $contactAdd = GalleryCategory::where('id', $investor->id)->update($requestData);

            return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
        }
    }

    public function deleteGalleryCategory($id)
    {
        GalleryCategory::where('id', $id)->delete();
        return Redirect::route('admin.gallery.category')->with('success', 'successfully submitted!');
    }

    public function gallary()
    {
        $user = Auth::user();
        $gallaries = Gallary::with('category')->get();

        $categories = GalleryCategory::all();
        return view('admin.gallary', compact('user', 'gallaries', 'categories'));
    }

    public function addGallary(Request $request)
    {
        $rules = [
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $profileImage = $request->file('image');
            $profileName = time() . 'gallary.' . $profileImage->getClientOriginalExtension();
            Storage::disk('public')->put($profileName,  File::get($profileImage));
            $requestData['image'] =  $profileName;
            //dd($requestData);
            $gallary = Gallary::create($requestData);
            // $path = Storage::disk('s3')->put('images', $request->image);

            // $path = Storage::disk('s3')->url($path);

            //     dd($path);
            return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
        }
    }

    public function editGallary(Request $request)
    {
        $rules = [
            'gallary_id' => 'required',
            'category_id' => 'required',
            // 'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $gallary = Gallary::find($request->gallary_id);
            if ($request->image) {
                $profileImage = $request->file('image');
                $profileName = time() . 'gallary.' . $profileImage->getClientOriginalExtension();
                Storage::disk('public')->put($profileName,  File::get($profileImage));
                $requestData['image'] =  $profileName;
            }
            unset($requestData['_token']);
            unset($requestData['gallary_id']);
            Gallary::where('id', $gallary->id)->update($requestData);
            return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
        }
    }

    public function deleteGallary($id)
    {
        Gallary::where('id', $id)->delete();
        return Redirect::route('admin.gallary')->with('success', 'successfully submitted!');
    }

    public function logout()
    {
        $user = Auth::logout();
        return redirect()->route('admin.showlogin');
    }
}
