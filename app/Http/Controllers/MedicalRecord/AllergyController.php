<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecord\Allergy;
use Illuminate\Support\Facades\Storage;

class AllergyController extends Controller
{
    public function store(Request $request, string $id)
    {
        $data = $request->validate([
            'allergy' => 'required|string',
            'dateTime' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Allergy', $request->image);
        }
    
        $imaging = new Allergy();
        $imaging->patient_Id = $id;
        $imaging->dateTime = $data['dateTime'];
        $imaging->description = $data['description'];
        $imaging->allergy = $data['allergy'];
        $imaging->path = $data['image'];
        $imaging->save();
    
    
        return redirect()->back()->with('success', 'Allergy added successfully.');
    }
    
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'allergy' => 'required|string',
            'dateTime' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the record by ID
        $imaging = Allergy::findOrFail($id);
    
        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            if ($imaging->path) {
                Storage::disk('public')->delete($imaging->path);
            }
    
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Allergy', $request->image);
            $imaging->path = $data['image']; // Update the path
        }
    
        $imaging->allergy = $data['allergy'];
        $imaging->dateTime = $data['dateTime'];
        $imaging->description = $data['description'];
        
        $imaging->save();
    
        return redirect()->back()->with('success', 'Allergy record updated successfully.');
    }

    public function destroy(string $id)
{
    $record = Allergy::findOrFail($id);

    // Delete the stored image if it exists
    if ($record->path) {
        Storage::disk('public')->delete($record->path);
    }

    // Delete the record from the database
    $record->delete();

    return redirect()->back()->with('success', 'Allergy record deleted successfully.');
}
}
