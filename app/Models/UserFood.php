<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFood extends Model
{
    use HasFactory;
    public function food()
    {
        return $this->hasOne('App\Models\Food', 'foods_id', 'user_food_food_id');    
    }
}
