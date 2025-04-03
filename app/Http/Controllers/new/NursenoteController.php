<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Http\Request;

class NursenoteController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'observation' => 'required|string',
        ]);
    
        // Create a new nursing note
        Nurse::create([
            'patient_Id' => $id,
            'date' => $request->date,
            'time' => $request->time,
            'observation' => $request->observation,
        ]);
    
        // Redirect back with a success message
        return back()->with('success', 'Nursing note added successfully!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'observation' => 'required|string',
        ]);

        $nurseorder = Nurse::FindOrFail($id);
        $nurseorder->update($request->all());

        return back()->with('success', 'Nursing note updated successfully!');

    }

    public function destroy(Nurse $id){
        $id->delete();

        return back()->with('success', 'Nursing note deleted successfully!');

    }
}
