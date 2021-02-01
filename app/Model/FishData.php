<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FishData extends Model
{
    protected $table = 'fish_data';
    public $timestamps = false;

    protected $fillable = [
        'mac', 'machine_id', 'coin_ratio', 'player_count', 'income', 'payout', 'update_time'
    ];

    public function Machine()
    {
        return $this->belongsTo(MachineBind::class, 'mac', 'bind_mac');
    }

    public function Player()
    {
        return $this->hasMany(PlayerData::class, 'mac', 'mac');
    }

    public function JackpotHistory()
    {
        return $this->belongsTo(JackpotHistory::class, 'mac', 'mac');
    }
}
