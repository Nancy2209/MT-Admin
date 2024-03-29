<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $contact = ContactUs::first();
        return view('admin.contacts', compact('user', 'contact'));
    }

    public function addContact(Request $request)
    {
        $rules = [
            'robomate_enquiry' => 'required',
            'product_enquiry' => 'required',
            'franchise_enquiry' => 'required',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $success = ContactUs::create($requestData);
            return Redirect::route('admin.contacts')->with('success', 'Updated Successfully!');
        }
    }

    public function updateContact(Request $request)
    {
        $rules = [
            'robomate_enquiry' => 'required',
            'product_enquiry' => 'required',
            'franchise_enquiry' => 'required',

        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            unset($requestData['_token']);
            ContactUs::where('id', $request->id)->update($requestData);
            return Redirect::route('admin.contacts')->with('success', 'Updated Successfully!');
        }
    }
}
