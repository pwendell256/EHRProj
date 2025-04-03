<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    protected $table = 'nurse_note';
    protected $fillable = [
        'patient_Id',
        'date',
        'time',
        'observation'
    ];
}
