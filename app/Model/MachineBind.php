<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MachineBind extends Model
{
    protected $table = 'machine';

    protected $fillable = [
        'bind_mac', 'name', 'state',
    ];

    public function fish()
    {
        return $this->hasMany(FishData::class, 'bind_mac', 'mac');
    }
}
