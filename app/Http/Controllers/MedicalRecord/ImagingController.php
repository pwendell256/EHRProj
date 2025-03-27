<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecord\Imaging;
use Illuminate\Support\Facades\Storage;

class ImagingController extends Controller
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
        $data['image'] = Storage::disk('public')->put('MedicalRecords/Imaging', $request->image);
    }

    $imaging = new Imaging();
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
    $imaging = Imaging::findOrFail($id);

    // Handle image upload if a new one is provided
    if ($request->hasFile('image')) {
        if ($imaging->path) {
            Storage::disk('public')->delete($imaging->path);
        }

        $data['image'] = Storage::disk('public')->put('MedicalRecords/Imaging', $request->image);
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
    $imaging = Imaging::findOrFail($id);

    // Delete the stored image if it exists
    if ($imaging->path) {
        Storage::disk('public')->delete($imaging->path);
    }

    // Delete the record from the database
    $imaging->delete();

    return redirect()->back()->with('success', 'Imaging record deleted successfully.');
}


}
