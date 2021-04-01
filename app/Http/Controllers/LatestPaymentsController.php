<?php

namespace App\Http\Controllers;

use App\Models\InrDepositOrder;
use Illuminate\Http\Request;

class LatestPaymentsController extends Controller
{
   public function __construct()
    {
      
    }
    public function index(){
        $latest_payments=InrDepositOrder::where('status','paid')->orderby('created_at','desc')->get();
        return view('latest-payments',['latest_payments'=>$latest_payments]);
    }
}
