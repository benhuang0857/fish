<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class alias_data extends Model
{
    protected $table = 'alias_data';
    protected $fillable = [
        'mac'
    ];
}
