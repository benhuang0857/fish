<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class player_data extends Model
{
    protected $table = 'player_data';
    protected $fillable = [
        'mac', 'num', 'bet', 'credits'
    ];
    public $timestamps = false;
}
