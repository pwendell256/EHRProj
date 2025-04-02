<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInfo extends Model
{
    protected $table = 'patient_info';

    protected $fillable = [
        'registration_no',
        'religion',
        'address',
        'admission_date',
        'diagnosis',
        'other_diagnoses',
        'allergies',
        'reaction',
        'emergency_name',
        'emergency_relationship',
        'emergency_address',
        'emergency_phone',
    ];


    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
