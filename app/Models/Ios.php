<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ios extends Model
{
    protected $table = 'ios';
    protected $fillable = [
        'patient_Id', 
        'date', 
        'shift', 
        'status', 
        'signature', 
        'total'
    ];

    public function iostimes(){
        return $this->hasMany(Iostime::class, 'ios_Id', 'id');
    }


}
