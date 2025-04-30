<?php

namespace App\Http\Controllers;

use App\Models\Doctorprogress;
use Illuminate\Http\Request;

class DoctorProgressController extends Controller
{
    public function update(Request $request, Doctorprogress $id){
        $validated = $request->validate([
            'introduction' => 'nullable',
            'history' => 'nullable',
            'presentation' => 'nullable',
            'mood' => 'nullable',
            'social' => 'nullable',
            'physical' => 'nullable',
            'plan' => 'nullable',
            'closing' => 'nullable',
            'pracName' => 'nullable',
            'clinicAddress' => 'nullable',
            'soap_subjective' => 'nullable',
            'soap_objective' => 'nullable',
            'soap_assessment' => 'nullable',
            'soap_plan' => 'nullable',
            'birp_behavior' => 'nullable',
            'birp_intervention' => 'nullable',
            'birp_response' => 'nullable',
            'birp_plan' => 'nullable',
            'dap_data' => 'nullable',
            'dap_assessment' => 'nullable',
            'dap_plan' => 'nullable',
        ]);
    
        $id->update($validated);
    
        return redirect()->back()->with('success', 'Doctor progress updated successfully.');
    }
}
