<?php

namespace App\Http\Controllers;

use App\Models\Discharge;
use Illuminate\Http\Request;

class DischargeController extends Controller
{
    public function update(Request $request, Discharge $id){
        $validated = $request->validate([
            'date' => 'nullable|date',
            'medicine' => 'nullable|string',
            'exercise' => 'nullable|string',
            'treatment' => 'nullable|string',
            'health' => 'nullable|string',
            'followup_visit' => 'nullable|string',
            'diet' => 'nullable|string',
            'spirituality' => 'nullable|string',
        ]);

        $id->update($validated);

        return redirect()->back()->with('success', 'Override and medication recorded.');


    }
}
