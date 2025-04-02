<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function update(Request $request, Assessment $id)
{
    $validated = $request->validate([
        'patient_Id' => 'nullable|integer|exists:patients,id',
        'conductor' => 'nullable|string|max:255',
        'date' => 'nullable|date',
        'time' => 'nullable|string|max:255',
        'orientation_level' => 'nullable|string|max:255',
        'person' => 'nullable|string|max:255',
        'place' => 'nullable|string|max:255',
        'situation' => 'nullable|string|max:255',
        'temperature' => 'nullable|string|max:255',
        'blood_pressure' => 'nullable|string|max:255',
        'respiratory_rate' => 'nullable|string|max:255',
        'pulse_rate' => 'nullable|string|max:255',
        'oxygen_saturation' => 'nullable|string|max:255',
        'hair' => 'nullable|string|max:255',
        'eyes' => 'nullable|string|max:255',
        'perrla' => 'nullable|boolean',
        'nose' => 'nullable|string|max:255',
        'ears' => 'nullable|string|max:255',
        'mouth' => 'nullable|string|max:255',
        'midline_tongue' => 'nullable|boolean',
        'moist' => 'nullable|boolean',
        'lesions' => 'nullable|boolean',
        'dentition' => 'nullable|boolean',
        'carotid_pulse' => 'nullable|boolean',
        'jugular_vein_distention' => 'nullable|boolean',
        'trachea_midline' => 'nullable|boolean',
        'muffled' => 'nullable|boolean',
        'arrhythmia' => 'nullable|boolean',
        'anterior' => 'nullable|boolean',
        'posterior' => 'nullable|boolean',
        'lateral' => 'nullable|boolean',
        'chest_symmetry' => 'nullable|boolean',
        'skin_turgor' => 'nullable|boolean',
        'inspection' => 'nullable|string|max:255',
        'palpation' => 'nullable|string|max:255',
        'auscultation' => 'nullable|string|max:255',
        'luq' => 'nullable|string|max:255',
        'ruq' => 'nullable|string|max:255',
        'llq' => 'nullable|string|max:255',
        'rlq' => 'nullable|string|max:255',
        'radial_pulses' => 'nullable|string|max:255',
        'radial_other' => 'nullable|string|max:255',
        'temperaturetrunk' => 'nullable|string|max:255',
        'grip' => 'nullable|string|max:255',
        'capillary_refill' => 'nullable|string|max:255',
        'hair_present' => 'nullable|boolean',
        'edema' => 'nullable|string|max:255',
        'foot_strength' => 'nullable|string|max:255',
        'yellowed' => 'nullable|boolean',
        'thickened' => 'nullable|boolean',
        'ingrown' => 'nullable|boolean',
        'upper_r1' => 'nullable|string|max:255',
        'upper_r2' => 'nullable|string|max:255',
        'upper_l1' => 'nullable|string|max:255',
        'upper_l2' => 'nullable|string|max:255',
        'lower_r1' => 'nullable|string|max:255',
        'lower_r2' => 'nullable|string|max:255',
        'lower_l1' => 'nullable|string|max:255',
        'lower_l2' => 'nullable|string|max:255',
        'sensation' => 'nullable|string|max:255',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'bmi' => 'nullable|numeric',
        'type' => 'nullable|string|max:255',
        'intensity' => 'nullable|integer|min:1',
        'location' => 'nullable|string|max:255',
        'duration' => 'nullable|string|max:255',
        'characteristics' => 'nullable|string|max:255',
        'precipitation' => 'nullable|string|max:255',
        'frequency' => 'nullable|string|max:255',
        'nonverbals' => 'nullable|string|max:255',
        'relief_factors' => 'nullable|string|max:255',
        'sleep' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'created_at' => 'nullable|date',
        'updated_at' => 'nullable|date',
    ]);

    $id->update($validated);

    return redirect()->back()->with('success', 'Diagnosis updated successfully');
}

    
}
