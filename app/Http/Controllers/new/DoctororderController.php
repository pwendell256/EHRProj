<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\Doctororder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctororderController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'day_number' => 'required|string',
            'date_time' => 'required|date',
            'orders' => 'required|string',
            'rationale' => 'required|string',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Accepting image files only
        ]);

        $signaturePath = null;
        if ($request->hasFile('signature')) {
            // Store the signature file and get the path
            $signaturePath = $request->file('signature')->store('signatures', 'public');
        }

        
        // Store the doctor order data
        Doctororder::create([
            'patient_Id' => $id,  
            'day_number' => $validated['day_number'],
            'date_time' => $validated['date_time'],
            'order' => $validated['orders'],
            'rationale' => $validated['rationale'],
            'signature' => $signaturePath, 
        ]);

        return redirect()->back()->with('success', 'Doctor order has been added successfully.');
    }
    
    public function update(Request $request, $id)
{
    // Find the doctor order
    $doctororder = Doctororder::findOrFail($id);
        
    // Validate the incoming request data
    $validated = $request->validate([
        'day_number' => 'nullable|integer',
        'date_time' => 'nullable|date',
        'orders' => 'nullable|string',
        'rationale' => 'nullable|string',
        'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional for updates
    ]);
    
    // Handle signature update if provided
    if ($request->hasFile('signature')) {
        // Delete old signature file if it exists
        if ($doctororder->signature && Storage::disk('public')->exists($doctororder->signature)) {
            Storage::disk('public')->delete($doctororder->signature);
        }
        
        // Store the new signature file
        $signaturePath = $request->file('signature')->store('signatures', 'public');
        $validated['signature'] = $signaturePath;
    }

    // Update the doctor order using the array method with specific assignments
    $doctororder->update([
        'day_number' => $validated['day_number'] ?? $doctororder->day_number,
        'date_time' => $validated['date_time'] ?? $doctororder->date_time,
        'order' => $validated['orders'] ?? $doctororder->order,
        'rationale' => $validated['rationale'] ?? $doctororder->rationale,
        'signature' => $validated['signature'] ?? $doctororder->signature,
    ]);
    
    return redirect()->back()->with('success', 'Doctor order has been updated successfully.');
}

}