<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table = 'treatment';

    protected $fillable = [
        'short_term',
        'long_term',
        'medication',
        'intervention',
    ];
}
