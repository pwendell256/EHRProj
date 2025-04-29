<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discharge extends Model
{
    //

    protected $table = 'discharge';
    protected $fillable = [
        'date',
        'medicine',
        'exercise',
        'treatment',
        'health',
        'followup_visit',
        'diet',
        'spirituality',
    ];

}
