<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayersBeforeController extends Controller
{
    function index()
    {
        $all_players = Player::all();
        $max_speed = Player::where('player_membership', 'upgrade')->first()->player_minute;
        $max_capacity = Player::where('player_membership', 'upgrade')->first()->player_capacity;
        $left_time = '';
    
        return view('players-before', [
            'all_players' => $all_players,
            'max_speed' => $max_speed,
            'max_capacity' => $max_capacity,
            'left_time' => $left_time,
        ]);
    }
}
