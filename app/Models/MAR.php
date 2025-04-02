<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MAR extends Model
{
    protected $table = 'mar';

    protected $fillable = [
        'patient_Id',
        'med',
        'dosage',
        'route',
        'time',
        'note',
    ];

public function martimes(){
    return $this->hasMany(Martime::class, 'mar_Id', 'id');
}

}
