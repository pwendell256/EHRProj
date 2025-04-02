<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labdiagnosis extends Model
{
    protected $table = 'lab_diagnosis';
    protected $fillable = [
        'patient_Id',
        'wbc',
        'rbc',
        'hemoglobin',
        'hematocrit',
        'mcv',
        'mch',
        'mchc',
        'rbc_width',
        'platelet_count',
        'neutrophils',
        'lymphocytes',
        'monocytes',
        'eosinophils',
        'basophils',
        'chest_pa',
        'impression',
        'advice',
        'advice_path',
        'uri_date',
        'uri_time',
        'transparency',
        'color',
        'sp_gravity',
        'ph',
        'protein',
        'glucose',
        'bilirubin',
        'ery_hb',
        'leukocytes',
        'nitrite',
        'urobilinogen',
        'ketone'
    ];
}
