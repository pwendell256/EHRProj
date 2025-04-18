<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'config';
    protected $fillable = ['imaging', 'laboratory', 'histopath', 'microbiology', 'specialtest'];
}
