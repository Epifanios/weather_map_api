<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $table = 'forecast';

    protected $fillable = [
        'dt', 'temp', 'dt_txt', 'city_id'
    ];
}
