<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use Auth;
use DB;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ]);
            if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $block_status=User::where('email',$request->email)->first();
        if($block_status&&$block_status->block=='block'){
                        return redirect()->back()->with('blocked_user', 'Your account is blocked. Please contact support!');
        }
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // do whatever yo desire

            return redirect()->back()->with('no_user', 'Please register first!');
        }

        $exist=DB::table('active_users')->where('user_id',Auth::id())->first();
        if($exist==null)
        DB::table('active_users')->insert(array('user_id' =>   Auth::id()));
        return redirect('/index');
    }
    public function logout(Request $request)
    {
        DB::table('active_users')->where('user_id', '=', Auth::id())->delete();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
