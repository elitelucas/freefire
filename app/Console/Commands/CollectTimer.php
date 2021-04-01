<?php

namespace App\Console\Commands;

use App\Models\ActiveUser;
use App\Models\CollectGem;
use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Auth;

class CollectTimer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Server collecting timer is started.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_date=date('Y:m:d');

        $all_users=User::all();

        foreach($all_users as $user){
            $collect_exist = CollectGem::where('collect_gem_user_id', $user->id)
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();
            
            $player=Player::where('player_id',$user->player_id)->first();

            $incrementAmount=$player->player_minute;

            if ($collect_exist == null) {
                //create collect_gem table row of new user
                CollectGem::insert([
                    'collect_gem_user_id' => $user->id,
                    'collect_gem_hour_amount' => 0,
                    'collect_gem_daily_amount' => 0,
                    'collect_gem_timer_minute' => 0,
                    'collect_gem_created_date' => date('Y:m:d G:i:s'),
                    'updated_at' => date('Y:m:d G:i:s'),
                ]);
            }

            $collect_gem =CollectGem::where('collect_gem_user_id', $user->id)
            ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
            ->first();

            if($collect_gem->collect_gem_hour_amount<$player->player_capacity){
                if($collect_gem->collect_gem_hour_amount+$incrementAmount>$player->player_capacity){
                    CollectGem::where('collect_gem_user_id', $user->id)
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->update(['collect_gem_hour_amount'=>$player->player_capacity]);  
                }else{
                    CollectGem::where('collect_gem_user_id', $user->id)
                    ->whereBetween('collect_gem_created_date', [$current_date . " 00:00:00", $current_date . " 23:59:59"])
                    ->increment('collect_gem_hour_amount',$incrementAmount);
                }
           
            }
        }
                 
    }
}
