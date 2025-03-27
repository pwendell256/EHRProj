<?php

namespace App\Models\MedicalRecord;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Imaging extends Model
{
    protected $table = 'imaging';
    protected $fillable = ['dateTime', 'testType', 'result', 'path'];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
