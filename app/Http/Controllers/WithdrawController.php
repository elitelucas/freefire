<?php

namespace App\Http\Controllers;

use App\Models\WithdrawLimit;
use App\Models\WithdrawFee;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\DiamondWithdraw;



class WithdrawController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
      function index(){
        $all_withdraw_limit= WithdrawLimit::all();
        $withdraw_fee=WithdrawFee::all()[0]->withdraw_fee_amount;
        return view('withdraw',[
            'all_withdraw_limit'=>$all_withdraw_limit,
            'withdraw_fee'=>$withdraw_fee
            ]);
    }
     function saveAmount(Request $request){
          $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ]);
            if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
       $amount=$request->input('withdraw_amount');
        $fee=$request->input('fee');

        $diamond_withdraw=new DiamondWithdraw();
        $diamond_withdraw->diamond_withdraw_user_id=Auth::id();
        $diamond_withdraw->diamond_withdraw_ign=Auth::user()->ign;
        $diamond_withdraw->diamond_withdraw_player_ID=Auth::user()->playerID;
        $diamond_withdraw->diamond_withdraw_amount=$amount;
        $diamond_withdraw->diamond_withdraw_fee=$fee;
        $diamond_withdraw->diamond_withdraw_status='pending';
        $diamond_withdraw->save();

        Auth::user()->decrement(
            'diamond',$amount+$fee
        );
         return redirect()->back()->with('withdraw_amount', "{$amount}diamonds is withdrawed suceessfully");
    }
   function history(){
        $diamond_withdraw=DiamondWithdraw::where('diamond_withdraw_user_id', Auth::id())->get();
        return view('withdraw-history', ['diamond_withdraw'=>$diamond_withdraw]);
    }
}
