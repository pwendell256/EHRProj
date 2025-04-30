<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctorprogress extends Model
{
    protected $table = 'doctorprogress';
    protected $fillable = [
        'patient_Id',
        'introduction',
        'history',
        'presentation',
        'mood',
        'social',
        'physical',
        'plan',
        'closing',
        'pracName',
        'clinicAddress',
        'soap_subjective',
        'soap_objective',
        'soap_assessment',
        'soap_plan',
        'birp_behavior',
        'birp_intervention',
        'birp_response',
        'birp_plan',
        'dap_data',
        'dap_assessment',
        'dap_plan',
    ];

    
}
