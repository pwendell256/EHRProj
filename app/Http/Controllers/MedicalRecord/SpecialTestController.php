<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\MedicalRecord\Specialtest;
use Illuminate\Support\Facades\Storage;

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

        // Fetch configuration for special test interval
        $config = Configuration::first();
        $daysToAdd = $config->specialtest; // Get configured days for special tests

        // Get the last special test record of the patient
        $lastSpecialTest = Specialtest::where('patient_Id', $id)->latest('dateTime')->first();

        if ($lastSpecialTest) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastSpecialTest->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The special test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastSpecialTest->dateTime . ').'
                ])->withInput();
            }
        }

        // Store image if provided
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Specialtest', $request->image);
        }

        // Save new Special Test record
        $specialTest = new Specialtest();
        $specialTest->patient_Id = $id;
        $specialTest->dateTime = $data['dateTime'];
        $specialTest->result = $data['result'];
        $specialTest->testType = $data['testType'];
        $specialTest->path = $data['image'] ?? null;
        $specialTest->save();

        return redirect()->back()->with('success', 'Special Test record added successfully.');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the existing Special Test record
        $specialTest = Specialtest::findOrFail($id);

        // Fetch configuration for special test interval
        $config = Configuration::first();
        $daysToAdd = $config->specialtest;

        // Get the last special test record of the patient (excluding the current one)
        $lastSpecialTest = Specialtest::where('patient_Id', $specialTest->patient_Id)
            ->where('id', '!=', $id)
            ->latest('dateTime')
            ->first();

        if ($lastSpecialTest) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastSpecialTest->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The special test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastSpecialTest->dateTime . ').'
                ])->withInput();
            }
        }

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($specialTest->path) {
                Storage::disk('public')->delete($specialTest->path);
            }

            $data['image'] = Storage::disk('public')->put('MedicalRecords/Specialtest', $request->image);
            $specialTest->path = $data['image']; // Update the path
        }

        // Update record fields
        $specialTest->testType = $data['testType'];
        $specialTest->dateTime = $data['dateTime'];
        $specialTest->result = $data['result'];

        $specialTest->save();

        return redirect()->back()->with('success', 'Special Test record updated successfully.');
    }

    public function destroy(string $id)
    {
        $specialTest = Specialtest::findOrFail($id);

        // Delete the stored image if it exists
        if ($specialTest->path) {
            Storage::disk('public')->delete($specialTest->path);
        }

        // Delete the record from the database
        $specialTest->delete();

        return redirect()->back()->with('success', 'Special Test record deleted successfully.');
    }
}
