<?php

namespace App\Http\Controllers;

use App\Models\Tpr;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TPRController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_Id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required|string',
            'temp' => 'required|string',
            'bp' => 'required|string',
            'rr' => 'required|string',
            'pr' => 'required|string',
            'os' => 'required|string',
        ]);

        Tpr::create($validated);

        return back()->with('success', 'TPR record added.');
    }


    public function update(Request $request, Tpr $id)
    {
 
            $validated = $request->validate([
                'date' => 'required|date',
                'time' => 'required|string',
                'temp' => 'required|string',
                'bp' => 'required|string',
                'rr' => 'required|string',
                'pr' => 'required|string',
                'os' => 'required|string',
            ]);
    
    
        $id->update($validated);
    
        return back()->with('success', 'TPR record updated.');
    }

    public function destroy(Tpr $id){
        $id->delete();
        return redirect()->back()->with('success', 'TPR record deleted.');

    }
    
}
