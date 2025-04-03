<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Martime extends Model
{
    protected $table = 'mar_time';

    protected $fillable = [
        'mar_Id',
        'date',
        'time',
        'adm',
        'path',
    ];
    
}
