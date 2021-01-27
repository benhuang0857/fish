<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FishData extends Model
{
    protected $table = 'fish_data';
    public $timestamps = false;

    protected $fillable = [
        'mac', 'machine_id', 'coin_ratio', 'player_count', 'income', 'payout'
    ];

    public function Machine()
    {
        return $this->belongsTo(MachineBind::class, 'mac', 'bind_mac');
    }
}
