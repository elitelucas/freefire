<?php

namespace App\Http\Controllers;

use App\Models\BuyDiamondsLimit;
use App\Models\BuyDiamondsOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index(Request $request){
        $all_buy_diamonds_limit=BuyDiamondsLimit::all();
        return view('bank',['all_buy_diamonds_limit'=>$all_buy_diamonds_limit]);
    }
    function buyDiamond(Request $request){
         $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
 
         $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ]);
            if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $buy_diamonds_limit_id=$request->input('buy_diamond');
        if($buy_diamonds_limit_id==null){
            return redirect()->back()->with('no-id', 'Select payment type!');
        }else{
            $buy_diamonds_limit=BuyDiamondsLimit::where('buy_diamonds_limit_id',$buy_diamonds_limit_id)->first();
            if(Auth::user()->inr<$buy_diamonds_limit->buy_diamonds_limit_inr_amount)
            return redirect()->back()->with('no-id', 'There is no enough INR!');
            User::where('id',Auth::id())->increment('diamond',$buy_diamonds_limit->buy_diamonds_limit_diamonds_amount);
            User::where('id',Auth::id())->decrement('inr',$buy_diamonds_limit->buy_diamonds_limit_inr_amount);
            BuyDiamondsOrder::insert([
                'buy_diamonds_orders_user_id'=>Auth::id(),
                'buy_diamonds_orders_diamonds'=>$buy_diamonds_limit->buy_diamonds_limit_diamonds_amount,
                'buy_diamonds_orders_inr'=>$buy_diamonds_limit->buy_diamonds_limit_inr_amount,
                'buy_diamonds_orders_created_date'=>date('Y:m:d h:i:s'),
                ]);
                return redirect()->route('bank');
        }
    }
}
