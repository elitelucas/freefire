<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Player;
use App\Models\UserFood;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\SocialProvider;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('/auth-register')->withErrors($validator->errors());
        } else {
            return true;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {       
            $player_id = Player::all()[0]->player_id;

            User::create([
                'name' => $request->input('name'),
                'password' => Hash::make($request->input('password')),
                'referrals' => $request->input('referrer'),
                'ig_id' => $request->input('ig_id'),
                'player_id' => $player_id,
                'ign' => $request->input('ign'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'role' => 'user',
                'block' => 'active',
                'first_top_up' => 0,
                'gems' => 0,
                'diamond' => 0,
                'player_health' => 0,
                'find_us' => $request->input('find_us'),
                'ip_address' => $request->ip(),
                'created_at' => date('Y-m-d h:i:s')
            ]);
            $user_id = User::where('email', $request->input('email'))->first()->id;
            $foods = Food::select('foods_id')->get();
            //create user_food table
            foreach ($foods as $food) {
                UserFood::insert([
                    'user_food_user_id' => $user_id,
                    'user_food_food_id' => $food->foods_id,
                    'user_food_amount' => 0,
                    'user_food_created_date' => date('Y:m:d'),
                ]);
            };

            return redirect()->route('auth-login');
        
    }
    function sendNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required', 'unique:users'],
            'ig_id' => ['required', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users'],
             'captcha' => 'required|captcha',

            // 'player_id' => ['required','unique:users'],
        ]);
        $phone_number = $request->input('phone_number');

        if ($validator->fails()) {
            echo json_encode($validator->errors());
            return;
        } else {
            $otp = rand(100000, 999999);
            $sender_id = env("FAST_SMS_SENDER_ID");
            $route = env("FAST_SMS_ROUTE");
            $message = env("FAST_SMS_MESSAGE");

            $variable_values = $otp;

            $number = $phone_number;
            $this->Fstmsms($sender_id,$route, $message,$variable_values, $number);
            Session::put('OTP', $otp);
            echo Session::get('OTP');
        }
    }
    function verifyNumber(Request $request)
    {
      
        $otp = $request->input('otp');
    
        $verify_number =$request->input('verify_number');
        // dd( $verify_number);
        if ($verify_number == $otp) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    function resendNumber(Request $request)
    {
        $sender_id = env("FAST_SMS_SENDER_ID");
        $route = env("FAST_SMS_ROUTE");
        $message = env("FAST_SMS_MESSAGE");

        $verify_number =$request->input('verify_number');

        $number = $request->input('phone_number');
        $variable_values = $verify_number;
        $this->Fstmsms($sender_id,$route, $message,$variable_values, $number);
        echo 'success';
    }





    function Fstmsms($sender_id,$route, $message,$variable_values, $number)
    {
        $fields = array(
            "sender_id" => $sender_id,
            "message" => $message,
            "route" => $route,
            "variables_values" => $variable_values,
            "numbers" => $number,
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization:" . env('FAST_SMS_AUTH'),
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $response = "cURL Error #:" . $err;
        }
    }
}
