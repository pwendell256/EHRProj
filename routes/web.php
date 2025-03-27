<?php

use App\Http\Controllers\MedicalRecord\AllergyController;
use App\Http\Controllers\MedicalRecord\HistopathController;
use App\Http\Controllers\MedicalRecord\ImagingController;
use App\Http\Controllers\MedicalRecord\LaboratoryController;
use App\Http\Controllers\MedicalRecord\MicrobiologyController;
use App\Http\Controllers\MedicalRecord\SpecialTestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Models\MedicalRecord\Laboratory;
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
    return Inertia::render('Dashboard');
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
});

require __DIR__.'/auth.php';
