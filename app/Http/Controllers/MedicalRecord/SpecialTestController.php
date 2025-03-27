<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\MedicalRecord\Specialtest;

class SpecialTestController extends Controller
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
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Specialtest', $request->image);
        }
    
        $imaging = new Specialtest();
        $imaging->patient_Id = $id;
        $imaging->dateTime = $data['dateTime'];
        $imaging->result = $data['result'];
        $imaging->testType = $data['testType'];
        $imaging->path = $data['image'];
        $imaging->save();
    
    
        return redirect()->back()->with('success', 'Special Test added successfully.');
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
        $imaging = Specialtest::findOrFail($id);
    
        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            if ($imaging->path) {
                Storage::disk('public')->delete($imaging->path);
            }
    
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Specialtest', $request->image);
            $imaging->path = $data['image']; // Update the path
        }
    
        $imaging->testType = $data['testType'];
        $imaging->dateTime = $data['dateTime'];
        $imaging->result = $data['result'];
        
        $imaging->save();
    
        return redirect()->back()->with('success', 'Special Test record updated successfully.');
    }

    public function destroy(string $id)
{
    $record = Specialtest::findOrFail($id);

    // Delete the stored image if it exists
    if ($record->path) {
        Storage::disk('public')->delete($record->path);
    }

    // Delete the record from the database
    $record->delete();

    return redirect()->back()->with('success', 'Special Test record deleted successfully.');
}
}
