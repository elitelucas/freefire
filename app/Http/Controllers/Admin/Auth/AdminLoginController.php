<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
class AdminLoginController extends Controller
{
    public function __construct()
    {
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        // Attempt to log the user in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            DB::table('active_users')->insert(array('user_id' =>   Auth::id()));
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        DB::table('active_users')->where('user_id', '=', Auth::id())->delete();
        Auth::guard('web')->logout();
        
        return redirect('/admin');
    }
}
