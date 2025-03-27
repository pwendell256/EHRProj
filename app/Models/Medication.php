<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medication';
    protected $fillable = ['patient_Id','date', 'medication'];


    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_Id', 'id');
    }
}
