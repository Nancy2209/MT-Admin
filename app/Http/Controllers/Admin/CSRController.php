<?php

namespace App\Http\Controllers\Admin;

use App\Models\CSR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallary;
use App\Models\PrivacyPolicy;
use App\Models\Team;
use App\Models\Term;
use App\Models\UserCount;
use Response;

class CSRController extends Controller
{
    public function csr()
    {
        $csrs = CSR::all();
        return view('admin.csr', compact('csrs'));
    }

    public function addCsr(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $profileImage = $request->file('image');
            $profileName = time() . 'CSR.' . $profileImage->getClientOriginalExtension();
            Storage::disk('public')->put($profileName,  File::get($profileImage));
            $requestData['image'] =  $profileName;
            //dd($requestData);
            CSR::create($requestData);
            return Redirect::route('admin.CSR')->with('success', 'successfully submitted!');
        }
    }

    public function editCsr(Request $request)
    {
        $rules = [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $csr = CSR::find($request->id);
            if ($request->image) {
                $profileImage = $request->file('image');
                $profileName = time() . 'CSR.' . $profileImage->getClientOriginalExtension();
                Storage::disk('public')->put($profileName,  File::get($profileImage));
                $requestData['image'] =  $profileName;
            }
            unset($requestData['_token']);
            CSR::where('id', $csr->id)->update($requestData);
            return Redirect::route('admin.csr')->with('success', 'successfully submitted!');
        }
    }

    public function deleteCsr($id)
    {
        CSR::where('id', $id)->delete();
        return Redirect::route('admin.csr')->with('success', 'successfully submitted!');
    }
}
