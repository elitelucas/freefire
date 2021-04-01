<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gems','diamond','inr','ign','ig_id','player_id','foods',
        'referrals','star','status','first_top_up','ip_address','block','role','player_health',
        'find_us','player_changed_date','phone_number','phone_verified','total_cart_price','total_cart_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /*Login with Socialite*/
    public function socialProviders()
    {
        return $this->hasMany(socialProvider::class);
    }
}
