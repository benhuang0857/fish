<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlayerData extends Model
{
    protected $table = 'player_data';
    protected $fillable = [
        'mac', 'num', 'bet', 'credits'
    ];
    public $timestamps = false;

    public function FishSeat()
    {
        return $this->belongsTo(FishData::class, 'mac', 'mac');
    }
}
