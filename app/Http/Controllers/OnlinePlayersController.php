<?php

namespace App\Http\Controllers;

use App\Models\ActiveUser;
use Illuminate\Http\Request;

class OnlinePlayersController extends Controller
{
    public function __construct()
    {
       
    }
    function index()
    {
        $all_online_players = ActiveUser::orderby('created_at','desc')->take(4)->get();
        $players_count=ActiveUser::count();
        return view('online-players', [
            'all_online_players' => $all_online_players,
            'players_count' => $players_count,
            ]);
    }
}
