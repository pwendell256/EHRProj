<?php

namespace App\Http\Controllers\MedicalRecord;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Configuration;
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

    // Fetch configuration
    $config = Configuration::first();
    $daysToAdd = $config->imaging; // This holds the value (e.g., 10 days)

    // Get the last imaging record of the patient
    $lastImaging = Imaging::where('patient_Id', $id)->latest('dateTime')->first();

    if ($lastImaging) {
        // Calculate the minimum allowed dateTime
        $minAllowedDateTime = Carbon::parse($lastImaging->dateTime)->addDays($daysToAdd);

        // Convert request dateTime to Carbon instance
        $requestDateTime = Carbon::parse($data['dateTime']);

        if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
            return redirect()->back()->withErrors(['dateTime' => 'The test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastImaging->dateTime . ').']);
        }
    }

    // Store the image if provided
    if ($request->hasFile('image')) {
        $data['image'] = Storage::disk('public')->put('MedicalRecords/Imaging', $request->image);
    }

    // Save new imaging record
    $imaging = new Imaging();
    $imaging->patient_Id = $id;
    $imaging->dateTime = $data['dateTime'];
    $imaging->result = $data['result'];
    $imaging->testType = $data['testType'];
    $imaging->path = $data['image'] ?? null;
    $imaging->save();

    return redirect()->back()->with('success', 'Imaging record added successfully.');
}


public function update(Request $request, string $id)
{
    $data = $request->validate([
        'testType' => 'required|string',
        'dateTime' => 'required|date',
        'result' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the imaging record by ID
    $imaging = Imaging::findOrFail($id);

    // Fetch configuration for imaging interval (e.g., 10 days)
    $config = Configuration::first();
    $daysToAdd = $config->imaging;

    // Get the last imaging record of the patient (excluding the current one)
    $lastImaging = Imaging::where('patient_Id', $imaging->patient_Id)
        ->where('id', '!=', $id)
        ->latest('dateTime')
        ->first();

    if ($lastImaging) {
        // Calculate the minimum allowed dateTime
        $minAllowedDateTime = Carbon::parse($lastImaging->dateTime)->addDays($daysToAdd);

        // Convert request dateTime to Carbon instance
        $requestDateTime = Carbon::parse($data['dateTime']);

        if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
            return redirect()->back()->withErrors([
                'dateTime' => 'The test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastImaging->dateTime . ').'
            ])->withInput();
        }
    }

    // Handle image upload if a new one is provided
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($imaging->path) {
            Storage::disk('public')->delete($imaging->path);
        }

        $data['image'] = Storage::disk('public')->put('MedicalRecords/Imaging', $request->image);
        $imaging->path = $data['image']; // Update the path
    }

    // Update record fields
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
