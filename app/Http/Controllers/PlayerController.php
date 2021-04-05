<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index()
    {
        $all_players = Player::all();
        $max_speed = Player::where('player_membership', 'upgrade')->first()->player_minute;
        $max_capacity = Player::where('player_membership', 'upgrade')->first()->player_capacity;
        $user = User::where('id', Auth::id())->first();
        $left_time = '';
        if ($user->player->player_duration != 'lifetime') {
            if ($user->player_changed_date != null) {
                $diff_second = strtotime(date('Y:m:d h:i:s')) - strtotime($user->player_changed_date);
                $diff_day = floor($diff_second / 60 / 60 / 24);

                if ($diff_day > $user->player->player_duration) {
                    User::where('id', Auth::id())->update(['player_id' => 1]);
                } else {
                    $remain_second = $user->player->player_duration * 24 * 60 * 60 - $diff_second;

                    $remain_min = floor($remain_second / 60);
                    $remain_hour = floor($remain_second / 60 / 60);
                    $remain_day = floor($remain_second / 60 / 60 / 24);
                    if ($remain_second > 0) {
                        $left_time = $remain_second > 1 ? $remain_second . 'seconds' : $remain_second . 'second';
                    }
                    if ($remain_min > 0) {
                        $left_time = $remain_min > 1 ? $remain_min . 'minutes' : $remain_min . 'minute';
                    }
                    if ($remain_hour > 0) {
                        $left_time = $remain_hour > 1 ? $remain_hour . 'hours' : $remain_hour . 'hour';
                    }

                    if ($remain_day > 0) {
                        $left_time = $remain_day > 1 ? $remain_day . 'days' : $remain_day . 'day';
                    }
                }
            }
        }

        $updated_user = User::where('id', Auth::id())->first();

        return view('player', [
            'all_players' => $all_players,
            'max_speed' => $max_speed,
            'max_capacity' => $max_capacity,
            'updated_user' => $updated_user,
            'left_time' => $left_time,
            'user'=>$user
        ]);
    }
    function buyPlayer(Request $request)
    {
        $player_id = $request->input('player_id');

        $player = Player::where('player_id', $player_id)->first();
        if ($player->player_price_type == 'diamonds') {
            if (Auth::user()->diamond < $player->player_price) {
                echo 'fail';
                return;
            } else {
                User::where('id', Auth::id())->update([
                    'player_id' => $player_id,
                    'player_changed_date' => date('Y:m:d h:i:s'),
                ]);
                User::where('id', Auth::id())->decrement('diamond', $player->player_price);
                echo $player->player_image;
            }
        } else if ($player->player_price_type == 'stars') {
            if (Auth::user()->star < $player->player_price) {
                echo 'fail';
                return;
            } else {
                User::where('id', Auth::id())->update([
                    'player_id' => $player_id,
                    'player_changed_date' => date('Y:m:d h:i:s'),
                    ]);
                User::where('id', Auth::id())->decrement('star', $player->player_price);
                echo $player->player_image;
            }
        } else if ($player->player_price_type == 'INR') {
            if (Auth::user()->inr < $player->player_price) {
                echo 'fail';
                return;
            } else {          
                User::where('id', Auth::id())->update([
                    'player_id' => $player_id,
                    'player_changed_date' => date('Y:m:d h:i:s'),
                ]);
                User::where('id', Auth::id())->decrement('inr', $player->player_price);
                echo $player->player_image;
            }
        } else {
            User::where('id', Auth::id())->update([
                'player_id' => $player_id,
                'player_changed_date' => date('Y:m:d h:i:s'),
            ]);
            echo $player->player_image;
        }
    }
}
