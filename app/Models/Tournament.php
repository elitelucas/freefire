<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    public function type()
    {
        return $this->hasOne('App\Models\TournamentType', 'id', 'tournament_type');    
    }
}
