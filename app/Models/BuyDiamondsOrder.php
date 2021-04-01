<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyDiamondsOrder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'buy_diamonds_orders_user_id');    
    }
}
