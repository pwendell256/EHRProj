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

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Allergy', $request->image);
        }

        // Create new Allergy record
        $allergy = new Allergy();
        $allergy->patient_Id = $id;
        $allergy->dateTime = $data['dateTime'];
        $allergy->description = $data['description'];
        $allergy->allergy = $data['allergy'];
        $allergy->path = $data['image'] ?? null; // Ensure path is stored only if an image is uploaded
        $allergy->save();

        return redirect()->back()->with('success', 'Allergy record added successfully.');
    }


    public function update(Request $request, string $id)
{
    $data = $request->validate([
        'allergy' => 'required|string',
        'dateTime' => 'required|date',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the existing Allergy record
    $allergy = Allergy::findOrFail($id);

    // Handle image upload if a new one is provided
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($allergy->path) {
            Storage::disk('public')->delete($allergy->path);
        }

        $data['image'] = Storage::disk('public')->put('MedicalRecords/Allergy', $request->image);
        $allergy->path = $data['image']; // Update the path
    }

    // Update record fields
    $allergy->allergy = $data['allergy'];
    $allergy->dateTime = $data['dateTime'];
    $allergy->description = $data['description'];

    $allergy->save();

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
