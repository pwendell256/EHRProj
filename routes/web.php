<?php

use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DischargeController;
use App\Http\Controllers\DoctorProgressController;
use App\Http\Controllers\DoctroprogressController;
use App\Http\Controllers\IosController;
use App\Http\Controllers\MedicalRecord\AllergyController;
use App\Http\Controllers\MedicalRecord\HistopathController;
use App\Http\Controllers\MedicalRecord\ImagingController;
use App\Http\Controllers\MedicalRecord\LaboratoryController;
use App\Http\Controllers\MedicalRecord\MicrobiologyController;
use App\Http\Controllers\MedicalRecord\SpecialTestController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\new\AssessmentController;
use App\Http\Controllers\new\DiagnosisController;
use App\Http\Controllers\new\DoctororderController;
use App\Http\Controllers\new\HistoryController;
use App\Http\Controllers\new\LabDiagnosisController;
use App\Http\Controllers\new\MarController;
use App\Http\Controllers\new\NursenoteController;
use App\Http\Controllers\new\RegistrationController;
use App\Http\Controllers\new\TreatmentController;
use App\Http\Controllers\OverrideController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TPRController;
use App\Models\Doctorprogress;
use App\Models\MedicalRecord\Laboratory;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $usercount = User::all()->count();
    return Inertia::render('Dashboard', ['user' => $usercount]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Patient-Management', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/Patient-Management/{id}', [PatientController::class, 'show'])->name('patient.show');
    Route::post('/Store-patient', [PatientController::class, 'store'])->name('patient.store');
    Route::put('/update-patient/{id}', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('/delete-patient/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');
    Route::post('/patients/{id}/upload', [PatientController::class, 'upload'])->name('patients.upload');


    Route::post('/Imaging-Store/{id}', [ImagingController::class, 'store'])->name('imaging.store');
    Route::post('/Imaging-Update/{id}', [ImagingController::class, 'update'])->name('imaging.update');
    Route::delete('/Imaging-delete/{id}', [ImagingController::class, 'destroy'])->name('imaging.destroy');

    Route::post('/Lab-Store/{id}', [LaboratoryController::class, 'store'])->name('lab.store');
    Route::post('/Lab-Update/{id}', [LaboratoryController::class, 'update'])->name('lab.update');
    Route::delete('/Lab-Update/{id}', [LaboratoryController::class, 'destroy'])->name('lab.destroy');

    Route::post('/histopath-Store/{id}', [HistopathController::class, 'store'])->name('histopath.store');
    Route::post('/histopath-Update/{id}', [HistopathController::class, 'update'])->name('histopath.update');
    Route::delete('/histopath-Update/{id}', [HistopathController::class, 'destroy'])->name('histopath.destroy');

    Route::post('/Microbiology-Store/{id}', [MicrobiologyController::class, 'store'])->name('microbiology.store');
    Route::post('/Microbiology-Update/{id}', [MicrobiologyController::class, 'update'])->name('microbiology.update');
    Route::delete('/Microbiology-Update/{id}', [MicrobiologyController::class, 'destroy'])->name('microbiology.destroy');

    Route::post('/specialtest-Store/{id}', [SpecialTestController::class, 'store'])->name('specialtest.store');
    Route::post('/specialtest-Update/{id}', [SpecialTestController::class, 'update'])->name('specialtest.update');
    Route::delete('/specialtest-Update/{id}', [SpecialTestController::class, 'destroy'])->name('specialtest.destroy');

    Route::post('/allergy-Store/{id}', [AllergyController::class, 'store'])->name('allergy.store');
    Route::post('/allergy-Update/{id}', [AllergyController::class, 'update'])->name('allergy.update');
    Route::delete('/allergy-Update/{id}', [AllergyController::class, 'destroy'])->name('allergy.destroy');

    Route::get('/Configuration', [ConfigurationController::class, 'index'])->name('config.index');
    Route::put('/Configuration-update/{id}', [ConfigurationController::class, 'update'])->name('config.update');


    Route::post('/Medication-Store/{id}', [MedicationController::class, 'store'])->name('medication.store');
    Route::put('/Medication-update/{id}', [MedicationController::class, 'update'])->name('medication.update');
    Route::delete('/Medication-delete/{id}', [MedicationController::class, 'destroy'])->name('medication.destroy');

    Route::get('Account-Management', [AccountManagementController::class, 'index'])->name('account.index');
    Route::post('/accounts', [AccountManagementController::class, 'store'])->name('accounts.store');
    Route::put('/accounts/{id}', [AccountManagementController::class, 'update'])->name('accounts.update');
    Route::delete('/delete-accounts/{id}', [AccountManagementController::class, 'destroy'])->name('accounts.delete');


    Route::put('Registration-update/{id}', [RegistrationController::class, 'update'])->name('registration.update');

    Route::post('Doctor-Order-store/{id}', [DoctororderController::class, 'store'])->name('doctor.store');
    Route::put('/patient/doctor/{id}', [DoctororderController::class, 'update'])->name('doctor.update');
    Route::delete('Doctor-Order-delete/{id}', [DoctororderController::class, 'destroy'])->name('doctor.destroy');


    Route::post('Nurse-note-store/{id}', [NursenoteController::class, 'store'])->name('nurse.store');
    Route::put('Nurse-note-update/{id}', [NursenoteController::class, 'update'])->name('nurse.update');
    Route::delete('Nurse-note-delete/{id}', [NursenoteController::class, 'destroy'])->name('nurse.destroy');


    Route::put('diagnosis/{id}', [DiagnosisController::class, 'update'])->name('diagnosis.update');
    Route::put('lab-diagnosis/{id}', [LabDiagnosisController::class, 'update'])->name('labdiagnosis.update');
    Route::put('assessment/{id}', [AssessmentController::class, 'update'])->name('assessment.update');
    Route::put('treatment/{id}', [TreatmentController::class, 'update'])->name('treatment.update');
    Route::put('history/{id}', [HistoryController::class, 'update'])->name('history.update');

    Route::post('mar/{id}', [MarController::class, 'store'])->name('mar.store');
    Route::post('martime/{id}', [MarController::class, 'martimestore'])->name('martime.store');
    Route::put('mar-update/{id}', [MarController::class, 'update'])->name('mar.update');
    Route::match(['put', 'post'], 'martime-update/{id}', [MarController::class, 'martimeupdate'])->name('martime.update');
    Route::delete('mar-delete/{id}', [MarController::class, 'destroy'])->name('mar.delete');
    Route::delete('martime-delete/{id}', [MarController::class, 'martimedestroy'])->name('martime.delete');


    Route::post('override/{id}', [OverrideController::class, 'store'])->name('override.store');
    Route::put('discharge/{id}', [DischargeController::class, 'update'])->name('discharge.update');

    Route::post('tprs/{id}', [TPRController::class, 'store'])->name('tprs.store');
    Route::put('tprs/{id}', [TPRController::class, 'update'])->name('tprs.update');
    Route::delete('tprs/{id}', [TPRController::class, 'destroy'])->name('tprs.delete');

    Route::post('ios/{id}', [IosController::class, 'store'])->name('ios.store');
    Route::post('ios-updatestatus', [IosController::class, 'updateStatus'])->name('ios.updateStatus');
    Route::delete('ios-delete/{id}', [IosController::class, 'deletegroup'])->name('ios.delete');

    Route::post('ios-updatetime', [IosController::class, 'updatetime'])->name('ios.updatetime');
    Route::delete('ios-deletetime/{id}', [IosController::class, 'deletetime'])->name('ios.deletetime');

    Route::put('doctorprogress-update/{id}', [DoctorProgressController::class, 'update'])->name('doctorprogress.update');


});

require __DIR__ . '/auth.php';
