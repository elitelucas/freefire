<?php

namespace App\Http\Controllers;

use App\Models\AttackLimit;
use App\Models\CollectGem;
use App\Models\DailyGift;
use Illuminate\Http\Request;
use App\Models\DailyGiftsReward;
use App\Models\DailyMessage;
use App\Models\DailyReceivedFood;
use App\Models\DailyStarReward;
use App\Models\Food;
use App\Models\Player;
use App\Models\Referral;
use App\Models\TopUp;
use App\Models\TopUpOrder;
use App\Models\User;
use App\Models\WorkerGem;
use App\Models\TotalDailyGem;
use App\Models\UserFood;
use App\Models\WithdrawStatus;
use App\Models\Worker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Scheduling\Schedule;


use Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Queue\Worker as QueueWorker;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AccountController extends Controller
{
    private $user_percent = 0.8;
    private $referrer_percent = 0.2;

    public function __construct()
    {

        $this->middleware('auth');
    }

    function index(Schedule $schedule)
    {
        $user = User::where('id', Auth::id())->first();
        $left_time = '';
        if ($user->player->player_duration != 'lifetime') {
            if ($user->player_changed_date != null) {
                $diff_second = strtotime(date('Y:m:d h:i:s')) - strtotime($user->player_changed_date);
                $diff_day = floor($diff_second / 60 / 60 / 24);

                if ($diff_day > $user->player->player_duration) {
                    User::where('id', Auth::id())->update(['player_id' => 1]);
                }
            }
        }
        
        $current_date = date('Y-m-d');
        $player = Player::where('player_id', Auth::user()->player_id)->first();



        //check if current user received daily gifts or not.

        $daily_gifts_rewards = DailyGiftsReward::where('daily_gifts_rewards_user_id', Auth::id())
            ->whereBetween('daily_gifts_rewards_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();

        //check if current user received daily star or not.

        $daily_star_rewards = DailyStarReward::where('daily_star_rewards_user_id', Auth::id())
            ->whereBetween('daily_star_rewards_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();

        $worker_exist = WorkerGem::where('worker_gem_user_id', Auth::id())->first();

        $collect_exist = CollectGem::where('collect_gem_user_id', Auth::id())
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();

        $total_daily_gems = TotalDailyGem::where('total_daily_gems_user_id', Auth::id())
            ->whereBetween('total_daily_gems_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
        $worker = Worker::all()[0];
        $worker_gem = $worker->worker_gem; //changed by worker_minute;
        if ($total_daily_gems == null) {
            TotalDailyGem::insert([
                'total_daily_gems_user_id' => Auth::id(),
                'total_daily_gems_amount' => 0,
                'attack_status' => 0,
                'total_daily_gems_created_date' => date('Y:m:d h:i:s'),
            ]);
        }



        if ($collect_exist == null) {
            //create collect_gem table row of new user
            CollectGem::insert([
                'collect_gem_user_id' => Auth::id(),
                'collect_gem_hour_amount' => 0,
                'collect_gem_daily_amount' => 0,
                'collect_gem_timer_minute' => 0,
                'collect_gem_created_date' => date('Y:m:d G:i:s'),
                'updated_at' => date('Y:m:d G:i:s'),
            ]);
        }

        if ($worker_exist == null) {
            //create worker_gem table row of new user
            WorkerGem::insert([
                'worker_gem_user_id' => Auth::id(),
                'worker_gem_status' => 0,
                'worker_gem_created_date' => date('Y:m:d h:i:s'),
            ]);
        } else {
            if ($worker_exist->updated_at && $worker_exist->worker_gem_status == 1) {
                $seconds = strtotime(date('Y-m-d G:i:s')) - strtotime($worker_exist->updated_at);
                $diff_mins = floor($seconds / 60);
                $timer_total_seconds = $worker_exist->worker_gem_timer_minute * 60 + $worker_exist->worker_gem_timer_second;
                $diff_secs = $timer_total_seconds - $seconds;

                $insert_min = intval(floor($diff_secs / 60));
                $insert_sec = intval($diff_secs % 60);
                if ($insert_min >= 0) {
                    // dd($insert_sec);
                    $user_increment = intval(floor($seconds / 60));;
                    if ($user_increment > 0) {
                        $player_membership = Player::where('player_id', Auth::user()->player_id)
                            ->first()->player_membership;
                        if (Auth::user()->referrals && $player_membership == "free") {
                            $this->increaseUserAndReferrerGem(
                                $user_increment * $worker_gem * $this->user_percent,
                                $user_increment * $worker_gem * $this->referrer_percent,
                                $current_date
                            );
                        } else {
                            $this->increaseUserGem(
                                $user_increment * $worker_gem,
                                $current_date
                            );
                        }
                    }

                    WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                        'worker_gem_timer_minute' => $insert_min,
                        'worker_gem_timer_second' => $insert_sec,
                    ]);
                } else {
                    $player_membership = Player::where('player_id', Auth::user()->player_id)
                        ->first()->player_membership;
                    if (Auth::user()->referrals && $player_membership == 'free') {
                        $this->increaseUserAndReferrerGem(
                            ($worker_exist->worker_gem_timer_minute + 1) * $worker_gem * $this->user_percent,
                            ($worker_exist->worker_gem_timer_minute + 1) * $worker_gem * $this->referrer_percent,
                            $current_date
                        );
                    } else {
                        $this->increaseUserGem(
                            ($worker_exist->worker_gem_timer_minute + 1) * $worker_gem,
                            $current_date
                        );
                    }
                    WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                        'worker_gem_status' => 0,
                    ]);
                }
            }
        }
        $worker_gem = WorkerGem::where('worker_gem_user_id', Auth::id())->first();

        $total_daily_gems = TotalDailyGem::where('total_daily_gems_user_id', Auth::id())
            ->whereBetween('total_daily_gems_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();

        $collect_gem = CollectGem::where('collect_gem_user_id', Auth::id())
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
        $food_amount = UserFood::where('user_food_user_id', Auth::id())->sum('user_food_amount');

        $current_player = Player::where('player_id', Auth::user()->player_id)->first();
        $withdraw_status = WithdrawStatus::all()[0];
        $tmp_all_daily_message = DailyMessage::where('daily_message_username', 'allUsers')
            ->whereBetween('daily_message_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();
        $user_daily_message = DailyMessage::where('daily_message_username', Auth::user()->name)
            ->whereBetween('daily_message_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();

        $all_daily_message = array();
        foreach ($tmp_all_daily_message as $item) {
            $checked_users = json_decode($item->daily_message_checked_users);
            $key = false;
            if ($checked_users != null)
                foreach ($checked_users as $id) {
                    if (Auth::id() == $id) {
                        $key = true;
                    }
                }
            if ($key == false) {
                array_push($all_daily_message, $item);
            }
        }


        return view('account', [
            'daily_gifts_rewards' => $daily_gifts_rewards && count($daily_gifts_rewards) > 0 ? $daily_gifts_rewards[0] : 0,
            'daily_star_rewards' => $daily_star_rewards && count($daily_star_rewards) > 0 ? $daily_star_rewards[0] : 0,
            'worker_gem' => $worker_gem,
            'collect_gem' => $collect_gem,
            'total_daily_gems' => $total_daily_gems,
            'food_amount' => $food_amount,
            'current_player' => $current_player,
            'worker' => $worker,
            'withdraw_status' => $withdraw_status,
            'all_daily_message' => $all_daily_message,
            'user_daily_message' => $user_daily_message,
        ]);
    }
    function dailyGift(Request $request)
    {
        return view('daily-gifts');
    }
    function dailyGiftRandom(Request $request)
    {
        $data = DailyGift::all();
        $min_value = $data[0]['daily_gift_min'];
        $max_value = $data[0]['daily_gift_max'];

        $random = rand($min_value, $max_value);
        $current_date = date('Y-m-d');
        $daily_gifts_rewards = DailyGiftsReward::where('daily_gifts_rewards_user_id', Auth::id())
            ->whereBetween('daily_gifts_rewards_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();
        if ($daily_gifts_rewards && count($daily_gifts_rewards) > 0) {
            echo 'fail';
        } else {
            $player_membership = Player::where('player_id', Auth::user()->player_id)
                ->first()->player_membership;
            if (Auth::user()->referrals && $player_membership == 'free') {
                $this->increaseUserAndReferrerGem(
                    $random * $this->user_percent,
                    $random * $this->referrer_percent,
                    $current_date
                );
                DailyGiftsReward::insert([
                    'daily_gifts_rewards_user_id' => Auth::id(),
                    'daily_gifts_rewards_amount' => $random * $this->user_percent,
                    'daily_gifts_rewards_created_date' => date('Y:m:d G:i:s')
                ]);
                echo $random * $this->user_percent;
            } else {
                DailyGiftsReward::insert([
                    'daily_gifts_rewards_user_id' => Auth::id(),
                    'daily_gifts_rewards_amount' => $random,
                    'daily_gifts_rewards_created_date' => date('Y:m:d G:i:s')
                ]);
                $this->increaseUserGem(
                    $random,
                    $current_date
                );
                echo $random;
            }
        }
    }

    function explorer(Request $request)
    {
        return view('explorer');
    }
    function getStar(Request $request)
    {
        $current_date = date('Y-m-d');
        $daily_star_rewards = DailyStarReward::where('daily_star_rewards_user_id', Auth::id())
            ->whereBetween('daily_star_rewards_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->get();

        if ($daily_star_rewards && count($daily_star_rewards) > 0) {
            echo 'fail';
        } else {
            DailyStarReward::insert([
                'daily_star_rewards_user_id' => Auth::id(),
                'daily_star_rewards_amount' => 1,
                'daily_star_rewards_created_date' => date('Y:m:d h:i:s')
            ]);
            Auth::user()->increment('star',1);
            echo 1;
        }
    }
    function foods(Request $request)
    {
        return view('foods');
    }
    function validationCaptcha(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            echo json_encode(['status' => 'fail']);
        } else {
            User::where('id', Auth::id())->update(['worker_status' => 1]);
            echo json_encode(['status' => 'success', 'new_image' => 'worker-after.png']);
        }
    }
    function refreshCaptcha()
    {
        return response()->json(['captcha_input' => captcha_img()]);
    }
    function workerIncrease()
    {
        $current_date = date('Y-m-d');
        $worker = Worker::all()[0];
        $increseAmount = $worker->worker_gem;
        $worker_gem = WorkerGem::where('worker_gem_user_id', Auth::id())->first();
        if ($worker_gem->worker_gem_created_date == null) {
            //create worker_gem table row of new user
            WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                'worker_gem_status' => 1,
                'worker_gem_created_date' => date('Y:m:d G:i:s')
            ]);
        }
        $player_membership = Player::where('player_id', Auth::user()->player_id)
            ->first()->player_membership;
        if (Auth::user()->referrals && $player_membership == 'free') {
            $this->increaseUserAndReferrerGem(
                $increseAmount * $this->user_percent,
                $increseAmount * $this->referrer_percent,
                $current_date
            );
            echo $increseAmount * $this->user_percent;
        } else {
            $this->increaseUserGem(
                $increseAmount,
                $current_date
            );
            echo $increseAmount;
        }
    }
    function collectIncrease()
    {
        $membership = 10; //change by membership
        $increseAmount = 1;

        $worker_gem = WorkerGem::where('worker_gem_user_id', Auth::id())->first();
        if ($worker_gem->worker_gem_created_date == null) {
            //create worker_gem table row of new user
            WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                'worker_gem_status' => 1,
                'worker_gem_created_date' => date('Y:m:d G:i:s')
            ]);
        } else {
            User::where('id', Auth::id())->increment('gems', $increseAmount);
            if ($worker_gem->worker_gem_hour_amount < $worker_gem->worker_gem_hour_limit) { //changed by membership

                if ($worker_gem->worker_gem_hour_amount + $increseAmount > $worker_gem->worker_gem_hour_limit) {
                    WorkerGem::where('worker_gem_user_id', Auth::id())->update(['worker_gem_hour_amount' => $worker_gem->worker_gem_hour_limit]);
                    WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                        'worker_gem_status' => 0,
                        'worker_gem_amount' => 0,
                    ]);
                    echo 'over limit';
                    return;
                } else if ($worker_gem->worker_gem_hour_amount + $increseAmount == $worker_gem->worker_gem_hour_limit) {
                    WorkerGem::where('worker_gem_user_id', Auth::id())->increment('worker_gem_hour_amount', $increseAmount);
                    WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                        'worker_gem_status' => 0,
                        'worker_gem_amount' => 0,
                    ]);
                    echo 'over limit';
                    return;
                }
            }
            WorkerGem::where('worker_gem_user_id', Auth::id())->increment('worker_gem_hour_amount', $increseAmount);
            //increase worker amount every minute of current user.

            if ($worker_gem->worker_gem_amount < 3) {
                // WorkerGem::where('worker_gem_user_id', Auth::id())->update(['worker_gem_status' => 1]);
                WorkerGem::where('worker_gem_user_id', Auth::id())->increment('worker_gem_amount', $increseAmount);
                $dd = WorkerGem::where('worker_gem_user_id', Auth::id())->first()->worker_gem_amount;
                if ($dd >= 3) {
                    WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                        'worker_gem_status' => 0,
                        'worker_gem_amount' => 0,
                    ]);
                }
            } else {
                WorkerGem::where('worker_gem_user_id', Auth::id())->update([
                    'worker_gem_status' => 0,
                    'worker_gem_amount' => 0,
                ]);
            }
            $send = WorkerGem::where('worker_gem_user_id', Auth::id())->first()->worker_gem_hour_amount;
            echo $send;
        }
    }
    function workerTime(Request $request)
    {

        WorkerGem::where('worker_gem_user_id', Auth::id())->update([
            'worker_gem_timer_minute' => $request->input('minute'),
            'worker_gem_timer_second' => $request->input('second'),
        ]);
    }
    function startTimer(Request $request)
    {
        WorkerGem::where('worker_gem_user_id', Auth::id())->update([
            'worker_gem_status' => 1,
        ]);
    }
    function endTimer(Request $request)
    {
        WorkerGem::where('worker_gem_user_id', Auth::id())->update([
            'worker_gem_status' => 0,
        ]);
    }
    function collect()
    {
        $current_date = date('Y:m:d');
        $player = Player::where('player_id', Auth::user()->player_id)->first();

        $user = User::where('id', Auth::id())->first();
        $collected_gems = CollectGem::where('collect_gem_user_id', Auth::id())
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
        if ($collected_gems->collect_gem_hour_amount == 0) {
            return redirect()->back()->with('collect_amount', 'There is no collected gems!');
        }

        if ($collected_gems->collect_gem_daily_amount >= $player->player_daily_limit) {
            return redirect()->back()->with('collect-over', 'Over the daily limit! Tomorrow try again!');
        }
        if ($collected_gems->collect_gem_daily_amount + $collected_gems->collect_gem_hour_amount > $player->player_daily_limit) {
            $inc = $player->player_daily_limit - $collected_gems->collect_gem_daily_amount;
            $player_membership = Player::where('player_id', Auth::user()->player_id)
                ->first()->player_membership;
            if (Auth::user()->referrals && $player_membership == 'free') {
                $this->increaseUserAndReferrerGem(
                    $inc * $this->user_percent,
                    $inc * $this->referrer_percent,
                    $current_date
                );
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->update(['collect_gem_hour_amount' => 0]);
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->increment('collect_gem_daily_amount', $inc * $this->user_percent);
                $send_gems = $inc * $this->user_percent;
            } else {
                $this->increaseUserGem(
                    $inc,
                    $current_date
                );
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->update(['collect_gem_hour_amount' => 0]);
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->increment('collect_gem_daily_amount', $inc);
                $send_gems = $inc;
            }
        } else {
            $player_membership = Player::where('player_id', Auth::user()->player_id)
                ->first()->player_membership;
            if (Auth::user()->referrals && $player_membership == "free") {
                $this->increaseUserAndReferrerGem(
                    $collected_gems->collect_gem_hour_amount * $this->user_percent,
                    $collected_gems->collect_gem_hour_amount * $this->referrer_percent,
                    $current_date
                );
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->update(['collect_gem_hour_amount' => 0]);

                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->increment('collect_gem_daily_amount', $collected_gems->collect_gem_hour_amount * $this->user_percent);
                $send_gems = $collected_gems->collect_gem_hour_amount * $this->user_percent;
            } else {
                $this->increaseUserGem(
                    $collected_gems->collect_gem_hour_amount,
                    $current_date
                );
                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->update(['collect_gem_hour_amount' => 0]);

                CollectGem::where('collect_gem_user_id', Auth::id())
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->increment('collect_gem_daily_amount', $collected_gems->collect_gem_hour_amount);
                $send_gems = $collected_gems->collect_gem_hour_amount;
            }
        }

        $exist = DailyReceivedFood::where('daily_received_food_user_id', Auth::id())
            ->whereBetween('daily_received_food_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
        if ($exist == null) {
            $foods = Food::select('foods_id')->get();
            $arr = array();
            foreach ($foods as $obj) {
                $arr[] = (object) [
                    'foods_id' => $obj->foods_id,
                    'status' => ''
                ];
                shuffle($arr);
            }
            $arr[0]->status = 'active';
            //increase food-amount of user by food.User can get each 5 foods everyday freely.
            //and also can buy foods. This is to increase food amount of each food by one everyday. 
            //following there is also the same method.
            //this is only for first food.
            UserFood::where([
                'user_food_user_id' => Auth::id(),
                'user_food_food_id' => $arr[0]->foods_id,
            ])->increment('user_food_amount', 1);

            //this is to increae daily receive food.
            //everyday user visit collect page, he will be received 5 different foods.
            //following there is the same method
            DailyReceivedFood::insert([
                'daily_received_food_user_id' => Auth::id(),
                'daily_received_food_created_date' => date('Y:m:d G:i:s'),
                'daily_received_food_array' => json_encode($arr),
            ]);
            $food = Food::where('foods_id', $arr[0]->foods_id)->first()->foods_image;

            return view('collect', [
                'collected_gems' => $send_gems,
                'food' => $food,
                'player_image' => $user->player->player_image,
            ]);
        } else {
            $foods_id_arr = json_decode(DailyReceivedFood::where('daily_received_food_user_id', Auth::id())
                ->whereBetween('daily_received_food_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                ->first()->daily_received_food_array);
            $cnt = 0;

            foreach ($foods_id_arr as $key => $obj) {

                if ($obj->status == '') {
                    $foods_id_arr[$key]->status = 'active';

                    //this is to increae daily receive food.
                    //everyday user visit collect page, he will be received 5 different foods.
                    //above there is the same method
                    DailyReceivedFood::where('daily_received_food_user_id', Auth::id())
                        ->whereBetween('daily_received_food_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                        ->update([
                            'daily_received_food_array' => json_encode($foods_id_arr)
                        ]);

                    //this is to increae the food amount except for first food.
                    //above there is the same method.

                    UserFood::where([
                        'user_food_user_id' => Auth::id(),
                        'user_food_food_id' => $obj->foods_id,
                    ])->increment('user_food_amount', 1);

                    $food = Food::where('foods_id', $obj->foods_id)->first()->foods_image;
                    break;
                }
                if ($cnt == count($foods_id_arr) - 1) {
                    $food = 'none';
                }
                $cnt++;
            }
            if ($send_gems == 0) {
                return redirect()->back()->with('collect_amount', 'There is no collected gems!');
            }
            return view('collect', [
                'collected_gems' => $send_gems,
                'food' => $food,
                'player_image' => $user->player->player_image,
            ]);
        }
    }
    function collectCaptcha(Request $request){
        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            echo 'fail';
        } else {
            echo 'success';
        }
    }
    function foodStore()
    {
        $player = Player::where('player_user_id', Auth::id())->first();
        $current_player_image = Player::where('player_id', Auth::user()->player_id)->first()->player_image;
        //get daily reveived food for current user by day.
        $current_date = date('Y:m:d');
        $food_amount = UserFood::where('user_food_user_id', Auth::id())->sum('user_food_amount');

        if ($food_amount == 0) {
            return redirect()->back()->with('result', 'There is no foods!');
        }
        $foods = UserFood::where('user_food_user_id', Auth::id())->get();
        $attack_status = TotalDailyGem::where('total_daily_gems_user_id', Auth::id())
            ->whereBetween('total_daily_gems_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first()->attack_status;
        return view('food-store', [
            'player' => $player,
            'foods' => $foods,
            'attack_status' => $attack_status,
            'current_player_image' => $current_player_image
        ]);
    }
    function decreaseFoodAmount(Request $request)
    {
        $id = $request->input('id');
        $health = $request->input('health');
        UserFood::where('user_food_id', $id)->decrement('user_food_amount', 1);

        if ($health + Auth::user()->player_health > 100)
            User::where('id', Auth::id())->update(['player_health' => 100]);
        else
            User::where('id', Auth::id())->increment('player_health', $health);
        $food_amount = UserFood::where('user_food_user_id', Auth::id())->sum('user_food_amount');
        if ($food_amount == 0) {
            echo $health;
        } else
            echo 'success';
    }
    function attackGems()
    {
        $current_date = date('Y:m:d');
        $attack_limit = AttackLimit::all()[0];


        $ff = rand($attack_limit->attack_limit_min, $attack_limit->attack_limit_max);
        User::where('id', Auth::id())->update(['player_health' => 0]);
        $player_membership = Player::where('player_id', Auth::user()->player_id)
            ->first()->player_membership;
        if (Auth::user()->referrals && $player_membership == 'free') {
            $this->increaseUserAndReferrerGem(
                $ff * $this->user_percent,
                $ff * $this->referrer_percent,
                $current_date
            );
            echo $ff * $this->user_percent;
        } else {
            $this->increaseUserGem(
                $ff,
                $current_date
            );
            echo $ff;
        }
    }
    function topUp()
    {
        $all_top_ups = array();
        $top_ups = TopUp::all();
        foreach ($top_ups as $key => $top_up) {
            if ($key % 5 == 0) {
                $all_top_ups[intval($key / 5)] = array();
            }
            array_push($all_top_ups[intval($key / 5)], $top_up);
        }

        return view('top-up', ['all_top_ups' => $all_top_ups]);
    }
    function purchase(Request $request)
    {
        $top_up_id = $request->input('top_up_id');
        return view('purchase', ['top_up_id' => $top_up_id]);
    }
    function addToCart(Request $request)
    {
        $player_id = $request->input('player_id');
        $ign = $request->input('ign');
        $count = $request->input('count');
        $top_up_id = $request->input('top_up_id');


        $top_up = TopUp::where('top_up_id', $top_up_id)->first();

        $top_up_first_bonus = $top_up->top_up_first_bonus;

        $top_up_amount = $top_up->top_up_diamond;
        $top_up_order_inr_amount = $top_up->top_up_actual_amount;
        TopUpOrder::insert([
            'top_up_order_user_id' => Auth::id(),
            'top_up_order_offer' => $top_up_id,
            'top_up_order_amount' => $top_up_amount,
            'top_up_order_first_bonus_amount' => $top_up_first_bonus,
            'top_up_order_status' => 'pending',
            'top_up_order_type' => 'direct',
            'top_up_order_ign' => $ign,
            'top_up_order_player_id' => $player_id,
            'top_up_order_count' => $count,
            'top_up_order_inr_amount' => $top_up_order_inr_amount,
            'top_up_order_created_date' => date('Y:m:d h:i:s'),
        ]);
        return redirect()->route('top-up-cart');
    }
       function topUpCart()
    {
        $top_up_order = TopUpOrder::where('top_up_order_user_id', Auth::id())
        ->where('top_up_order_status','pending')
        ->get();
        $total_price = 0;
        $total_count=0;
        foreach ($top_up_order as $item) {
            $total_price += $item->top_up_order_inr_amount * $item->top_up_order_count;
            $total_count +=$item->top_up_order_count;
        }
        Auth::user()->update([
            'total_cart_price'=> $total_price,
            'total_cart_count'=> $total_count,
            ]);
        return view('top-up-cart', [
            'top_up_order' => $top_up_order,
            'total_price' => $total_price,
            'total_count' => $total_count,
        ]);
    }
    function topUpCartDelete(Request $request){
        TopUpOrder::where('top_up_order_id', $request->input('top_up_order_id'))->delete();
        echo 'success';
    }
    function topUpCartUpdate(Request $request){
        TopUpOrder::where('top_up_order_id', $request->input('top_up_order_id'))->update(
            ['top_up_order_count'=>$request->input('count')]
        );
        echo 'success';
    }
    function topUpCartCheckout(Request $request){
        $top_up_order = TopUpOrder::where('top_up_order_user_id', Auth::id())
        ->where('top_up_order_status','pending')
        ->get();
        $total_price = 0;
        $total_count=0;
        foreach ($top_up_order as $item) {
            $total_price += $item->top_up_order_inr_amount * $item->top_up_order_count;
            $total_count +=$item->top_up_order_count;
        }
        if($total_price>Auth::user()->inr){
            echo 'over amount';
        }else{
            TopUpOrder::where('top_up_order_user_id', Auth::id())
            ->where('top_up_order_status','pending')
            ->update(['top_up_order_status'=>'paid']);
            User::where('id',Auth::id())->decrement('inr', $total_price);
            User::where('id',Auth::id())->update([
                'total_cart_price'=> 0,
                'total_cart_count'=> 0,
                ]);
            echo 'success';
        }
    }
    function startServerCount()
    {
        $ff = 1;
        while ($ff < 10) {
            echo '1';
            sleep(1);
            $ff++;
        }
    }
    function startCollectTimer()
    {
        $current_date = date('Y:m:d');
        $collect_gem = CollectGem::where('collect_gem_user_id', Auth::id())
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
        echo $collect_gem->collect_gem_hour_amount;
    }
    function dailyMessageChangeStatus(Request $request)
    {
        $id = $request->input('id');
        $username = $request->input('username');
        if ($username == "allUsers") {
            $checked_users = DailyMessage::where('daily_message_id', $id)->first()->daily_message_checked_users;
            if ($checked_users == null) {
                $checked_users = [];
                array_push($checked_users, Auth::id());
                DailyMessage::where('daily_message_id', $id)->update(['daily_message_checked_users' => json_encode($checked_users)]);
            } else {
                $tmp = json_decode($checked_users);
                array_push($tmp, Auth::id());
                DailyMessage::where('daily_message_id', $id)->update(['daily_message_checked_users' => json_encode($tmp)]);
            }
            echo 'success';
        } else {
            DailyMessage::where('daily_message_id', $id)->update(['daily_message_status' => 1]);
            echo 'success';
        }
    }
    function increaseUserAndReferrerGem($userGem, $refererGem, $currentDate)
    {
        User::where('id', Auth::id())->increment('gems', $userGem);
        Referral::insert([
            'sender' => Auth::id(),
            'receiver' => Auth::user()->referrals,
            'amount' => $refererGem,
            'created_at' => date('Y:m:d G:i:s')
        ]);

        TotalDailyGem::where('total_daily_gems_user_id', Auth::id())
            ->whereBetween('total_daily_gems_created_date', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
            ->increment('total_daily_gems_amount', $userGem);
    }
    function increaseUserGem($userGem, $currentDate)
    {
        User::where('id', Auth::id())->increment('gems', $userGem);
        TotalDailyGem::where('total_daily_gems_user_id', Auth::id())
            ->whereBetween('total_daily_gems_created_date', [$currentDate . " 00:00:00", $currentDate . " 23:59:59"])
            ->increment('total_daily_gems_amount', $userGem);
    }
}
