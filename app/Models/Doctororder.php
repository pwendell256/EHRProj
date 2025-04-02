<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctororder extends Model
{
    protected $table = 'doctor_order';

    // Allow mass assignment for these fields
    protected $fillable = [
        'patient_Id',  
        'day_number',
        'date_time',
        'order',
        'rationale',
        'signature', // Store the file path of the signature image
    ];
    
}
