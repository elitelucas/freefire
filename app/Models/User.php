<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function player()
    {
        return $this->hasOne('App\Models\Player', 'player_id', 'player_id');    
    }
}
