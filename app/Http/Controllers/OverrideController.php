<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Override;
use App\Models\Medication;
use Illuminate\Http\Request;

class OverrideController extends Controller
{
    public function store(Request $request, Patient $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'medication' => 'required|string',
            'override_reason' => 'required|string',
            'prescriber_name' => 'required|string',
            'signature' => 'required|image',
            'override_date_time' => 'required|date',
        ]);
    

        $medication = new Medication();
        $medication->patient_Id = $id->id;
        $medication->date = $validated['date'];
        $medication->medication = $validated['medication'];
        $medication->save();

        if ($request->hasFile('signature')) {
            $validated['signature'] = $request->file('signature')->store('allergy/signature', 'public');
        }

        $override = new Override();
        $override->medication_Id = $medication->id;
        $override->name = $validated['prescriber_name'];
        $override->reason = $validated['override_reason'];
        $override->signature = $validated['signature'];
        $override->dateTime = $validated['override_date_time'];
        $override->save();
        
    
        return back()->with('success', 'Override and medication recorded.');
    }
    
}
