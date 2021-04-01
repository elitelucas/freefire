<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class PasswordResetController extends Controller
{
    public function __construct()
    {
       
    }
    function passwordReset(Request $request)
    {
        
            $email = $request->input('email');
            $phone_number = $request->input('phone_number');

            $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
            $user=User::where('email',$email)->first();
            if($user){
                if($user->phone_number==$phone_number){
                     $password = rand(100000, 999999);
                    $sender_id = env("FAST_SMS_SENDER_ID");
                    $route = env("FAST_SMS_ROUTE");
                    $message = env("FAST_SMS_MESSAGE");
                    
                    $variable_values = $password;
                    $this->Fstmsms($sender_id, $route,$message, $variable_values,$phone_number);
                    User::where('email', $email)->update([
                            'password' => Hash::make($password),
                        ]);
                return redirect()->back()->with('success', 'New Password was sent to your phone!');
                }else{
                     return redirect()->back()->with('wrong_number', 'Input correct phone number!');
                } 
            }else{
                return redirect()->back()->with('wrong_email', 'Input correct email!');
            }
           


    }
    
    function Fstmsms($sender_id, $route,$message, $variable_values,$number)
    {
        $fields = array(
            "sender_id" => $sender_id,
            "message" => $message,
            "route" => $route,
            "variables_values" => "New password:$variable_values",
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