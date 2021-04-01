<?php

namespace App\Http\Controllers;

use App\Models\TopUpOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpHistoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index(){
        $top_up_order=TopUpOrder::where('top_up_order_user_id',Auth::id())->get();
        return view('top-up-history',['top_up_order'=>$top_up_order]);
    }
}
