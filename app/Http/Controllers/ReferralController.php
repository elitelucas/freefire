<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index(){
        $current_date=date('Y:m:d G:i:s');
        $referer_cnt = count(Referral::groupBy('sender')
        ->select('sender')
        ->where('receiver', Auth::id())
        ->get());

        $total_referer_amount = round(Referral::where('receiver',Auth::id())->where('status',1)->sum('amount'),2);
        $referer_amount = round(Referral::where('receiver',Auth::id())->where('status',0)->sum('amount'),2);     

        // $referer_amount = Referral::where('receiver', Auth::id())->group_
        // ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
        // ->first();
        return view('referral',[
            'referer_cnt'=>$referer_cnt,
            'referer_amount'=>$referer_amount,
            'total_referer_amount'=>$total_referer_amount,
            ]);

       
    }
    function collect(){
        $referer_amount = round(Referral::where('receiver',Auth::id())->where('status',0)->sum('amount'),2);
        User::where('id',Auth::id())->increment('gems',$referer_amount);
        Referral::where('receiver',Auth::id())->where('status',0)->update(['status'=>1]);
        echo 'success';
    }
    function view(){
        $refer= Referral::leftJoin('users','referrals.sender','=','users.id')
        ->select('users.email as email', DB::raw("SUM(referrals.amount) as amount"))       
        ->where('referrals.receiver', Auth::id())
        ->groupBy('referrals.sender', 'users.email')
        ->get();
        return view('referral-view',['refer'=>$refer]);       
    }
}
