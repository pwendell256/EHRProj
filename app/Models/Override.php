<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Override extends Model
{
    protected  $table = 'override';
    protected $fillable = ['medication_Id', 'reason' ,'name', 'signature', 'dateTime'];


    public function medication(){
        return $this->belongsTo(Medication::class,'medication_Id','id');
    }
}
