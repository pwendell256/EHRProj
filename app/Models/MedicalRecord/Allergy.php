<?php

namespace App\Models\MedicalRecord;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $table = 'allergy';
    protected $fillable = ['dateTime', 'allergy', 'description', 'path'];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
