<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\MedicalRecord\Microbiology;
use Illuminate\Support\Facades\Storage;

class MicrobiologyController extends Controller
{
    public function store(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fetch configuration for microbiology interval
        $config = Configuration::first();
        $daysToAdd = $config->microbiology; // Get configured days for microbiology tests

        // Get the last microbiology record of the patient
        $lastMicrobiology = Microbiology::where('patient_Id', $id)->latest('dateTime')->first();

        if ($lastMicrobiology) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastMicrobiology->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The microbiology test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastMicrobiology->dateTime . ').'
                ])->withInput();
            }
        }

        // Store image if provided
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Microbiology', $request->image);
        }

        // Save new Microbiology record
        $microbiology = new Microbiology();
        $microbiology->patient_Id = $id;
        $microbiology->dateTime = $data['dateTime'];
        $microbiology->result = $data['result'];
        $microbiology->testType = $data['testType'];
        $microbiology->path = $data['image'] ?? null;
        $microbiology->save();

        return redirect()->back()->with('success', 'Microbiology record added successfully.');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the existing Microbiology record
        $microbiology = Microbiology::findOrFail($id);

        // Fetch configuration for microbiology interval
        $config = Configuration::first();
        $daysToAdd = $config->microbiology;

        // Get the last microbiology record of the patient (excluding the current one)
        $lastMicrobiology = Microbiology::where('patient_Id', $microbiology->patient_Id)
            ->where('id', '!=', $id)
            ->latest('dateTime')
            ->first();

        if ($lastMicrobiology) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastMicrobiology->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The microbiology test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastMicrobiology->dateTime . ').'
                ])->withInput();
            }
        }

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($microbiology->path) {
                Storage::disk('public')->delete($microbiology->path);
            }

            $data['image'] = Storage::disk('public')->put('MedicalRecords/Microbiology', $request->image);
            $microbiology->path = $data['image']; // Update the path
        }

        // Update record fields
        $microbiology->testType = $data['testType'];
        $microbiology->dateTime = $data['dateTime'];
        $microbiology->result = $data['result'];

        $microbiology->save();

        return redirect()->back()->with('success', 'Microbiology record updated successfully.');
    }

    public function destroy(string $id)
    {
        $microbiology = Microbiology::findOrFail($id);

        // Delete the stored image if it exists
        if ($microbiology->path) {
            Storage::disk('public')->delete($microbiology->path);
        }

        // Delete the record from the database
        $microbiology->delete();

        return redirect()->back()->with('success', 'Microbiology record deleted successfully.');
    }
}
