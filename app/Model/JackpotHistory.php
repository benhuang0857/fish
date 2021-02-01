<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JackpotHistory extends Model
{
    protected $table = 'history_data';

    protected $fillable = [
        'mac', 'player', 'jackpot', 'coins', 'datetime', 'verified'
    ];

    public function Machine()
    {
        return $this->belongsTo(MachineBind::class, 'mac', 'bind_mac');
    }

    public function PlayerData()
    {
        return $this->hasMany(PlayerData::class, 'mac', 'mac');
    }

    public function FishData()
    {
        return $this->hasMany(FishData::class, 'mac', 'mac');
    }
}
