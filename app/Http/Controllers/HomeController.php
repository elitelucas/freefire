<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Player;
use App\Models\SiteChat;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if (view()->exists($request->path())) {
            $active_players = Player::where('player_status', 1)->count();
            $free_membership_players = Player::where('player_membership', 'free')->count();
            $medium_membership_players = Player::where('player_membership', 'medium')->count();
            $upgrade_membership_players = Player::where('player_membership', 'upgrade')->count();
            $upgrade_membership_players = Player::where('player_membership', 'upgrade')->count();
           
            return view($request->path(), [
                'active_players' => $active_players,
                'free_membership_players' => $free_membership_players,
                'medium_membership_players' => $medium_membership_players,
                'upgrade_membership_players' => $upgrade_membership_players,
            ]);
        }
        return view('pages-404');
    }

    public function root()
    {

        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }

        $site_chat=SiteChat::all()[0];  
        return view('index', [
            'site_chat'=>$site_chat
        ]);
    }

    public function chat(Request $request)
    {
        $id=$request->input('id');
        $chat=$request->input('chat');
        SiteChat::where('id',$id)->update(['chat_enable'=>$chat]);
        echo 'success';        

    }

    public function site(Request $request)
    {
        $id=$request->input('id');
        $site=$request->input('site');
        SiteChat::where('id',$id)->update(['site_online'=>$site]);
        echo 'success';  
    }
    public function activePlayer(Request $request)
    {
        $all_player = Player::where('player_status', 1)->take(1500)->get();
        return view('player',['all_player'=>$all_player]);
    }
    public function freeMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'free')->take(400)->get();
        return view('player',['all_player'=>$all_player]);
    }
    public function mediumMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'medium')->take(100)->get();
        return view('player',['all_player'=>$all_player]);
    }
    public function upgradeMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'upgrade')->take(100)->get();
        return view('player',['all_player'=>$all_player]);
    }
    public function recentRegisteredPlayer(Request $request)
    {
        $all_player = Player::orderby('player_createdDate','DESC')->take(100)->get();
        return view('player',['all_player'=>$all_player]);
    }
    public function blockedUser(Request $request)
    {
        $all_users = User::where('block','block')->take(100)->get();
        return view('list-user',['all_users'=>$all_users]);
    }


    

    public function listUser(Request $request)
    {
        if (view()->exists($request->path())) {
            $all_users = User::all();
            return view($request->path(), ['all_users' => $all_users]);
        }
        return view('pages-404');
    }

    public function editUser(Request $request)
    {
        $receive_data = json_decode($request->input('data'));
        $id = $request->input('id');

        User::whereId($id)->update([
            'name' => $receive_data->name,
            'email' => $receive_data->email,
            'gems' => $receive_data->gems,
            'diamond' => $receive_data->diamond,
            'inr' => $receive_data->inr,
            'ign' => $receive_data->ign,
            'ig_id' => $receive_data->ig_id,
            'player' => $receive_data->player,
            'foods' => $receive_data->foods,
            'referrals' => $receive_data->referrals,
            'star' => $receive_data->star,
            'status' => $receive_data->status,
            'ip_address' => $receive_data->ip_address,
        ]);
        echo 'success';
    }

    public function changeBlock(Request $request)
    {

        $id = $request->input('id');
        $block = $request->input('block');
        if ($block == 'active') {
            User::whereId($id)->update([
                'block' => 'block'
            ]);
        } else if ($block == 'block') {
            User::whereId($id)->update([
                'block' => 'active'
            ]);
        }
        echo 'success';
    }
}
