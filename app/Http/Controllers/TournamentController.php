<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentRegister;
use Illuminate\Http\Request;
use Auth;

class TournamentController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index()
    {
        $paykey = false;
        $all_tournaments = Tournament::all();
        $tournament_register = TournamentRegister::where('username', Auth::user()->name)->get();
        
        
            foreach ($all_tournaments as $key => $tournament) {
                $dd=TournamentRegister::where('tournament_id', $tournament->id)->get();
                foreach($dd as $obj){
                    if($obj->status=='paid'){
                        $all_tournaments[$key]->payStatus=true;
                    }
                }
                $registered_users = json_decode($tournament->registered_users);
                
                if ($registered_users && count($registered_users) > 0) {
                    foreach ($registered_users as $item) {
                        if ($item == Auth::id()) {
                            $all_tournaments[$key]->user_key = true;
                        }
                    }
                }
            }
        
        return view('tournament', ['all_tournaments' => $all_tournaments]);
    }
    function register($id)
    {
        $tournament = Tournament::where('id', $id)->first();


        return view('tournament-register', ['tournament' => $tournament]);
    }
    function checkout(Request $request)
    {
        $name = $request->input('name');
        $tournament_id = $request->input('tournament_id');
        $player_id_arr = $request->input('player_id');
        $ign_arr = $request->input('ign');
        $details = array();
        foreach ($player_id_arr as $key => $player_id) {
            array_push($details, ['player_id' => $player_id, 'ign' => $ign_arr[$key]]);
        }

        $tournament = Tournament::where('id', $tournament_id)->first();
        if ($tournament->registered_users_amount >= $tournament->registered_users_limit) {
            return redirect()->back()->with('over_limit', 'There is enough registered users!');
        } else {
            if ($tournament->registered_users == null) {
                $tournament_users_arr = array();
            } else {
                $tournament_users_arr = json_decode($tournament->registered_users);
            }
            array_push($tournament_users_arr, Auth::id());
            Tournament::where('id', $tournament_id)->update([
                'registered_users' => json_encode($tournament_users_arr),
            ]);
            Tournament::where('id', $tournament_id)
                ->increment('registered_users_amount', 1);
        }
        $tournament_register=new TournamentRegister();
        $tournament_register->name=$name;
        $tournament_register->username= Auth::user()->name;
        $tournament_register->phone_number=Auth::user()->phone_number;
        $tournament_register->ign= Auth::user()->ign;
        $tournament_register->igid=Auth::user()->ig_id;
        $tournament_register->tournament_id=$tournament->id;
        $tournament_register->tournament=$tournament->type->tournament_type;
        $tournament_register->amount=$tournament->amount;
        $tournament_register->fee=$tournament->fee;
        $tournament_register->status='pending';
        $tournament_register->type='direct';
        $tournament_register->details=json_encode($details);

        $tournament_register->save();

        return redirect()->route('tournament.confirm-checkout', ['id' => $tournament_register->id]);
    }
    function confirmCheckout($id)
    {
        $tournament_register = TournamentRegister::where('id', $id)->first();
        return view('tournament-checkout', ['tournament_register' => $tournament_register]);
    }
    function placeOrder(Request $request){
        $id=$request->input('id');
        $tournament_register = TournamentRegister::where('id', $id)->first();
        $amount=$tournament_register->amount+$tournament_register->fee;
        if($amount>Auth::user()->inr){
            return redirect()->back()->with('over_amount', 'There is no enough balance in your wallet!');
        }else{
            TournamentRegister::where('id', $id)->update([
                'status'=>'paid'
            ]);
            Auth::user()->update([
                'inr'=>(Auth::user()->inr-$amount)
                ]);
                return redirect()->route('tournament');
        }
    }
}
