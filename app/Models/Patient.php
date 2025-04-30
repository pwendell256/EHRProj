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
        'birth_place',
        'gender',
        'age',
        'admission_no',
        'admission_datetime',
        'room_no',
        'station',
        'status',
        'condition',
        'chiefComplaint',
        'education',
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
    public function nursenotes(){
        return $this->hasMany(Nurse::class, 'patient_Id', 'id');
    }
    public function diagnosis(){
        return $this->hasOne(Diagnosis::class, 'patient_Id', 'id');
    }

    public function labdiagnosis(){
        return $this->hasOne(Labdiagnosis::class, 'patient_Id', 'id');
    }
    public function assessment(){
        return $this->hasOne(Assessment::class, 'patient_Id', 'id');
    }
    public function treatment(){
        return $this->hasOne(Treatment::class, 'patient_Id', 'id');
    }
    public function mar(){
        return $this->hasMany(MAR::class, 'patient_Id', 'id');
    }
    public function history(){
        return $this->hasOne(History::class, 'patient_Id', 'id');
    }

    public function discharge(){
        return $this->hasOne(Discharge::class, 'patient_Id', 'id');
    }
    public function tprs(){
        return $this->hasMany(Tpr::class, 'patient_Id', 'id');
    }
    public function ios(){
        return $this->hasMany(Ios::class, 'patient_Id', 'id');
    }

    public function doctorprogress(){
        return $this->hasOne(Doctorprogress::class, 'patient_Id', 'id');
    }
    }
