<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentBeforeController extends Controller
{
    public function __construct()
    {

    }
     function index(){
        $all_tournaments=Tournament::all();
        return view('tournament-before',['all_tournaments'=>$all_tournaments]);
     }
}
