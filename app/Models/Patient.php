<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected  $table = 'Patients';
    protected $fillable = [
        'full_name',
        'birth_date',
        'gender',
        'age',
        'admission_no',
        'admission_datetime',
        'room_no',
        'station',
        'status',
        'condition',
    ];
    }
