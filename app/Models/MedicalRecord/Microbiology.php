<?php

namespace App\Models\MedicalRecord;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Microbiology extends Model
{
    protected $table = 'microbiology';
    protected $fillable = ['dateTime', 'testType', 'result', 'path'];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
