<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tpr extends Model
{
    protected $table = 'tpr';
    protected $fillable = [
        'patient_Id',
        'temp',
        'bp',
        'rr',
        'pr',
        'os',
        'date',
        'time'
    ];
    

}
