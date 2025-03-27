<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
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

        // Fetch configuration for laboratory interval
        $config = Configuration::first();
        $daysToAdd = $config->laboratory; // Get configured days for laboratory tests

        // Get the last laboratory record of the patient
        $lastLaboratory = Laboratory::where('patient_Id', $id)->latest('dateTime')->first();

        if ($lastLaboratory) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastLaboratory->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The laboratory test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastLaboratory->dateTime . ').'
                ])->withInput();
            }
        }

        // Store image if provided
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Laboratory', $request->image);
        }

        // Save new Laboratory record
        $laboratory = new Laboratory();
        $laboratory->patient_Id = $id;
        $laboratory->dateTime = $data['dateTime'];
        $laboratory->result = $data['result'];
        $laboratory->testType = $data['testType'];
        $laboratory->path = $data['image'] ?? null;
        $laboratory->save();

        return redirect()->back()->with('success', 'Laboratory record added successfully.');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the existing Laboratory record
        $laboratory = Laboratory::findOrFail($id);

        // Fetch configuration for laboratory interval
        $config = Configuration::first();
        $daysToAdd = $config->laboratory;

        // Get the last laboratory record of the patient (excluding the current one)
        $lastLaboratory = Laboratory::where('patient_Id', $laboratory->patient_Id)
            ->where('id', '!=', $id)
            ->latest('dateTime')
            ->first();

        if ($lastLaboratory) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastLaboratory->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The laboratory test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastLaboratory->dateTime . ').'
                ])->withInput();
            }
        }

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($laboratory->path) {
                Storage::disk('public')->delete($laboratory->path);
            }

            $data['image'] = Storage::disk('public')->put('MedicalRecords/Laboratory', $request->image);
            $laboratory->path = $data['image']; // Update the path
        }

        // Update record fields
        $laboratory->testType = $data['testType'];
        $laboratory->dateTime = $data['dateTime'];
        $laboratory->result = $data['result'];

        $laboratory->save();

        return redirect()->back()->with('success', 'Laboratory record updated successfully.');
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
