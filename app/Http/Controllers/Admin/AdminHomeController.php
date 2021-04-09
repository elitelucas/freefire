<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActiveUser;
use App\Models\User;
use App\Models\Player;
use App\Models\SiteChat;
use App\Models\UserFood;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * show dashboard.
     *
     * @return Illuminate\Http\Response
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
        $active_users=User::where('block','active')->count();
        $online_users=ActiveUser::count();
        $free_membership_players = Player::where('player_membership', 'free')->count();
        $medium_membership_players = Player::where('player_membership', 'medium')->count();
        $upgrade_membership_players = Player::where('player_membership', 'upgrade')->count();

        $recent_registered_users = User::orderby('created_at', 'DESC')->count();
        $blocked_users=User::where('block','block')->count();


        $site_chat = SiteChat::all()[0];
        return view('admin.index', [
            'site_chat' => $site_chat,
            'active_users' => $active_users,
            'online_users' => $online_users,
            'free_membership_players' => $free_membership_players,
            'medium_membership_players' => $medium_membership_players,
            'upgrade_membership_players' => $upgrade_membership_players,
            'recent_registered_users' => $recent_registered_users,
            'blocked_users' => $blocked_users,
        ]);
    }

    public function chat(Request $request)
    {
        $id = $request->input('id');
        $chat = $request->input('chat');
        SiteChat::where('id', $id)->update(['chat_enable' => $chat]);
        echo 'success';
    }

    public function site(Request $request)
    {
        $id = $request->input('id');
        $site = $request->input('site');
        SiteChat::where('id', $id)->update(['site_online' => $site]);
        echo 'success';
    }
    public function activeUser(Request $request)
    {
        $all_users = User::where('block', 'active')->take(1500)->get();
        return view('admin.list-user', ['all_users' => $all_users]);
    }
    public function onlineUser(Request $request)
    {
        $all_users = array();
        $all_active_user_id = ActiveUser::all();
        foreach ($all_active_user_id as $active_user_id) {
            $active_user = User::where('id', $active_user_id->user_id)->first();
            array_push($all_users, $active_user);
        }
        return view('admin.list-user', ['all_users' => $all_users]);
    }
    public function freeMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'free')->take(400)->get();
        return view('admin.player', ['all_player' => $all_player]);
    }
    public function mediumMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'medium')->take(100)->get();
        return view('admin.player', ['all_player' => $all_player]);
    }
    public function upgradeMembershipPlayer(Request $request)
    {
        $all_player = Player::where('player_membership', 'upgrade')->take(100)->get();
        return view('admin.player', ['all_player' => $all_player]);
    }
    public function recentRegisteredUser(Request $request)
    {
        $all_users = User::orderby('created_at', 'DESC')->take(100)->get();
        return view('admin.list-user', ['all_users' => $all_users]);
    }
    public function blockedUser(Request $request)
    {
        $all_users = User::where('block', 'block')->take(100)->get();
        return view('admin.list-user', ['all_users' => $all_users]);
    }




    public function listUser(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }

        $all_users = User::all();

        if (view()->exists($path)) {
            return view($path, ['all_users' => $all_users]);
        }

        return view('pages-404');
    }

    public function editUser(Request $request)
    {
        $id = $request->input('id');

        User::whereId($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'gems' => $request->input('gems'),
            'diamond' => $request->input('diamond'),
            'inr' => $request->input('inr'),
            'ign' => $request->input('ign'),
            'ig_id' => $request->input('ig_id'),
            'player_health' => $request->input('player_health'),
            'referrals' => $request->input('referrals'),
            'star' => $request->input('star'),
            'ip_address' => $request->input('ip_address'),
        ]);
        UserFood::where('user_food_id', $request->input('mushroom_1_id'))->update(['user_food_amount' => $request->input('mushroom_1')]);
        UserFood::where('user_food_id', $request->input('mushroom_2_id'))->update(['user_food_amount' => $request->input('mushroom_2')]);
        UserFood::where('user_food_id', $request->input('mushroom_3_id'))->update(['user_food_amount' => $request->input('mushroom_3')]);
        UserFood::where('user_food_id', $request->input('mushroom_4_id'))->update(['user_food_amount' => $request->input('mushroom_4')]);
        UserFood::where('user_food_id', $request->input('medkit_id'))->update(['user_food_amount' => $request->input('medkit')]);
        return redirect()->route('admin.list-user');
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
