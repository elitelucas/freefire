<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpOrder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'top_up_order_user_id');    
    }
     public function topUp()
    {
        return $this->hasOne('App\Models\TopUp', 'top_up_id', 'top_up_order_offer');    
    }
}
