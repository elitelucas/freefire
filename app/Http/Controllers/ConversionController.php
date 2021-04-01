<?php

namespace App\Http\Controllers;

use App\Models\GemDiamondRatio;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ConversionController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    function index(){

        if (Auth::user()->gems <env('INITIAL_GEM_AMOUNT')) {
            return redirect()->back()->with('conversion', 'There is no enough gems to convert diamond! 
                         You need '.env("INITIAL_GEM_AMOUNT").' gems to convert!');
   }
        $gem_diamond_ratio= GemDiamondRatio::all()[0];
        return view('conversion',['gem_diamond_ratio'=>$gem_diamond_ratio]);
    }
    function convert(Request $request){
        $gems=$request->input('change_gem_val');
        $diamond=$request->input('change_diamond_val');
       
        User::where('id',Auth::id())->increment('diamond',$diamond);
        User::where('id',Auth::id())->decrement('gems',$gems);
        $user_gem=User::where('id',Auth::id())->first()->gems;
        echo $user_gem;
    }
}
