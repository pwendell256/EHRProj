<?php

namespace App\Http\Controllers\new;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosisController extends Controller
{
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'initial' => 'required|string|max:255',
        'tc' => 'nullable|string|max:255', 
        'ro' => 'nullable|string|max:255', 
        'final' => 'required|string|max:255',
    ]);

    // Find the diagnosis record
    $diagnosis = Diagnosis::findOrFail($id);

    // Update the diagnosis record
    $diagnosis->update($validated);

    // Optionally, redirect or return response
    return redirect()->back()->with('success', 'Diagnosis updated successfully');
}

}
