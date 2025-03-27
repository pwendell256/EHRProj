<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecord\Laboratory;
use Illuminate\Support\Facades\Storage;

class LaboratoryController extends Controller
{
    public function store(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Laboratory', $request->image);
        }
    
        $imaging = new Laboratory();
        $imaging->patient_Id = $id;
        $imaging->dateTime = $data['dateTime'];
        $imaging->result = $data['result'];
        $imaging->testType = $data['testType'];
        $imaging->path = $data['image'];
        $imaging->save();
    
    
        return redirect()->back()->with('success', 'Recommendation Letter added successfully.');
    }
    
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the record by ID
        $imaging = Laboratory::findOrFail($id);
    
        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            if ($imaging->path) {
                Storage::disk('public')->delete($imaging->path);
            }
    
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Laboratory', $request->image);
            $imaging->path = $data['image']; // Update the path
        }
    
        $imaging->testType = $data['testType'];
        $imaging->dateTime = $data['dateTime'];
        $imaging->result = $data['result'];
        
        $imaging->save();
    
        return redirect()->back()->with('success', 'Imaging record updated successfully.');
    }

    public function destroy(string $id)
{
    $laboratory = Laboratory::findOrFail($id);

    // Delete the stored image if it exists
    if ($laboratory->path) {
        Storage::disk('public')->delete($laboratory->path);
    }

    // Delete the record from the database
    $laboratory->delete();

    return redirect()->back()->with('success', 'Laboratory record deleted successfully.');
}

}
