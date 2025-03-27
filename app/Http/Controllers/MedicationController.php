<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\MedicalRecord\Allergy;

class MedicationController extends Controller
{
    public function store(Request $request, string $id)
    {

        // Validate input
        $validated = $request->validate([
            'date' => 'required|date',
            'medication' => 'required|string',
        ]);

        // Retrieve patient's allergies
        $allergies = Allergy::where('patient_Id', $id)->pluck('allergy')->map(fn($allergy) => strtolower($allergy));

        // Check if medication is in the allergy list (case-insensitive)
        if ($allergies->contains(strtolower($validated['medication']))) {
            return back()->withErrors(['medication' => 'This medication is not allowed due to allergy restrictions.']);
        }

        // If validation passes, proceed with saving the medication
        Medication::create([
            'patient_Id' => $id,
            'date' => $validated['date'],
            'medication' => $validated['medication'],
        ]);
    

        return back()->with('success', 'Medication added successfully.');
    }

    public function update(Request $request, Medication $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'medication' => 'required|string',
        ]);

        // Retrieve patient's allergies
        $allergies = Allergy::where('patient_Id', $id->patient_Id)->pluck('allergy')->map(fn($allergy) => strtolower($allergy));

        if ($allergies->contains(strtolower($validated['medication']))) {
            return back()->withErrors(['medication' => 'This medication is not allowed due to allergy restrictions.']);
        }

        $id->update($validated);

        return back()->with('success', 'Medication updated successfully.');
    }

    public function destroy(Medication $id){
        $id->delete();
        return back()->with('success', 'Medication deleted successfully.');

    }
}
