<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\File;



class EditProfileController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index()
    {
        return view('edit-profile');
    }
    function edit(Request $request)
    {

    if($request->input('g-recaptcha-response')==null){
        return redirect()->back()->with('no_captcha', 'Captcha value is required!');
    }
        $validator = Validator::make($request->all(), [
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        if ($request->input('new_password')) {
            $new_pass_validator = Validator::make($request->all(), [
                'new_password' => 'min:6|confirmed|',
            ]);
            if ($new_pass_validator->fails()) {
                return redirect()->back()->withErrors($new_pass_validator->errors())->withInput($request->all());
            }
           
            User::where('id', Auth::id())->update([
                'password' => Hash::make($request->input('new_password')),
            ]);
        }
        User::where('id', Auth::id())->update([
            'ig_id' => $request->input('ig_id'),
            'ign' => $request->input('ign'),
            'phone_number' => $request->input('phone_number'),
            'avatar' =>$request->input('base_image'),
            'find_us' => $request->input('find_us'),
        ]);
        return redirect()->route('edit-profile');
    }
}
