<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\PatientInfo;
use Illuminate\Http\Request;
use Exception;

class RegistrationController extends Controller
{
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'registration_no' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'admission_date' => 'nullable|date',
            'diagnosis' => 'nullable|string|max:255',
            'other_diagnoses' => 'nullable|string|max:255',
            'allergies' => 'nullable|string|max:255',
            'reaction' => 'nullable|string|max:255',
            'emergency_name' => 'nullable|string|max:255',
            'emergency_relationship' => 'nullable|string|max:255',
            'emergency_address' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:255',
        ]);

            $patient = PatientInfo::findOrFail($id);
        
            $patient->update($validatedData);
        
            return redirect()->back()->with('success', 'Patient updated successfully.');
    }
}
