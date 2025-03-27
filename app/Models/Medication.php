<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medication';
    protected $fillable = ['date', 'medication'];


    public function patient(){
        return $this->belongsTo(Patient::class, 'patiend_Id', 'id');
    }
}
