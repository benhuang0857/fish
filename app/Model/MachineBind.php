<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MachineBind extends Model
{
    protected $table = 'machine';

    protected $fillable = [
        'bind_mac', 'name', 'state', 'category'
    ];

    public function fish()
    {
        return $this->hasMany(FishData::class, 'bind_mac', 'mac');
    }

    public function JackpotHistory()
    {
        return $this->hasMany(JackpotHistory::class, 'bind_mac', 'mac');
    }
}
