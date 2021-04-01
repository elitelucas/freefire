<?php

namespace App\Http\Controllers;

use App\Models\TournamentRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentHistoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index(){
        $tournament_history= TournamentRegister::where('username',Auth::user()->name)->get();
        return view('tournament-history', ['tournament_history'=>$tournament_history]);
    }
}
