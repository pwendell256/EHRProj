<?php

namespace App\Models\MedicalRecord;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Histopath extends Model
{
    protected $table = 'histopath';
    protected $fillable = ['dateTime', 'testType', 'result', 'path'];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
