<?php

namespace App\Http\Controllers\MedicalRecord;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\MedicalRecord\Histopath;
use Illuminate\Support\Facades\Storage;

class HistopathController extends Controller
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
        $daysToAdd = $config->histopath; // Get configured days for histopath tests

        // Get the last histopath record of the patient
        $lastHistopath = Histopath::where('patient_Id', $id)->latest('dateTime')->first();

        if ($lastHistopath) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastHistopath->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The histopath test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastHistopath->dateTime . ').'
                ])->withInput();
            }
        }

        // Store image if provided
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('MedicalRecords/Histopath', $request->image);
        }

        // Save new Histopath record
        $histopath = new Histopath();
        $histopath->patient_Id = $id;
        $histopath->dateTime = $data['dateTime'];
        $histopath->result = $data['result'];
        $histopath->testType = $data['testType'];
        $histopath->path = $data['image'] ?? null;
        $histopath->save();

        return redirect()->back()->with('success', 'Histopath record added successfully.');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'testType' => 'required|string',
            'dateTime' => 'required|date',
            'result' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the existing Histopath record
        $histopath = Histopath::findOrFail($id);

        // Fetch configuration for histopath interval
        $config = Configuration::first();
        $daysToAdd = $config->histopath;

        // Get the last histopath record of the patient (excluding the current one)
        $lastHistopath = Histopath::where('patient_Id', $histopath->patient_Id)
            ->where('id', '!=', $id)
            ->latest('dateTime')
            ->first();

        if ($lastHistopath) {
            // Calculate the minimum allowed dateTime
            $minAllowedDateTime = Carbon::parse($lastHistopath->dateTime)->addDays($daysToAdd);
            $requestDateTime = Carbon::parse($data['dateTime']);

            if ($requestDateTime->lessThanOrEqualTo($minAllowedDateTime)) {
                return redirect()->back()->withErrors([
                    'dateTime' => 'The histopath test date must be at least ' . $daysToAdd . ' days after the last recorded test (' . $lastHistopath->dateTime . ').'
                ])->withInput();
            }
        }

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($histopath->path) {
                Storage::disk('public')->delete($histopath->path);
            }

            $data['image'] = Storage::disk('public')->put('MedicalRecords/Histopath', $request->image);
            $histopath->path = $data['image']; // Update the path
        }

        // Update record fields
        $histopath->testType = $data['testType'];
        $histopath->dateTime = $data['dateTime'];
        $histopath->result = $data['result'];

        $histopath->save();

        return redirect()->back()->with('success', 'Histopath record updated successfully.');
    }

    public function destroy(string $id)
    {
        $record = Histopath::findOrFail($id);

        // Delete the stored image if it exists
        if ($record->path) {
            Storage::disk('public')->delete($record->path);
        }

        // Delete the record from the database
        $record->delete();

        return redirect()->back()->with('success', 'Histopath record deleted successfully.');
    }
}
