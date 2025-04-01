<?php

namespace App\Models;

use App\Models\MedicalRecord\Allergy;
use App\Models\MedicalRecord\Histopath;
use App\Models\MedicalRecord\Imaging;
use App\Models\MedicalRecord\Laboratory;
use App\Models\MedicalRecord\Microbiology;
use App\Models\MedicalRecord\Specialtest;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected  $table = 'Patients';
    protected $fillable = [
        'full_name',
        'birth_date',
        'gender',
        'age',
        'admission_no',
        'admission_datetime',
        'room_no',
        'station',
        'status',
        'condition',
        'chiefComplaint',
        'image',
    ];

    public function imagings(){
        return $this->hasMany(Imaging::class, 'patient_Id', 'id');
    }
    public function laboratories(){
        return $this->hasMany(Laboratory::class, 'patient_Id', 'id');

    }
    public function histopaths(){
        return $this->hasMany(Histopath::class, 'patient_Id', 'id');

    }
    public function microbiologies(){
        return $this->hasMany(Microbiology::class, 'patient_Id', 'id');

    }
    public function specialtests(){
        return $this->hasMany(Specialtest::class, 'patient_Id', 'id');

    }
    public function allergies(){
        return $this->hasMany(Allergy::class, 'patient_Id', 'id');
 
    }
    public function medications(){
        return $this->hasMany(Medication::class, 'patient_Id', 'id');
 
    }

    public function patientinfo(){
        return $this->hasOne(PatientInfo::class, 'patient_Id', 'id');
    }
    
    public function doctororders(){
        return $this->hasMany(Doctororder::class, 'patient_Id', 'id');
    }
    }
