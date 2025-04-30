<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iostime extends Model
{
    protected $table = 'iostime';
    protected $fillabel =[
        'ios_Id',
        'time',
        'source',
        'amount'
    ];
    public function ios(){
        return $this->belongsTo(Ios::class, 'ios_Id', 'id');
    }
}
