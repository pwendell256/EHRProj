<?php

namespace App\Http\Controllers;

use DateTime;
use Inertia\Inertia;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'station' => 'nullable|string',
        ]);

        $name = $request->input('name');
        $station = $request->input('station');

        $patients = Patient::query()
            ->when($name, function ($query, $name) {
                return $query->where('full_name', 'like', "%$name%");
            })
            ->when($station, function ($query, $station) {
                return $query->where('station', 'like', "%$station%");
            })
            ->get(); // Ensure we get actual results instead of returning the query

        return Inertia::render('Auth/Patient/Index', ['patients' => $patients]);
    }



    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'admission_no' => 'required|string|max:50',
            'admission_datetime' => 'required|date',
            'room_no' => 'required|string|max:10',
            'station' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'condition' => 'required|string|max:255',
        ]);

        // Calculate age from birth_date
        $birthdate = new DateTime($validatedData['birth_date']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        // Add age to validated data
        $validatedData['age'] = $age;

        // Create the patient record
        Patient::create($validatedData);

        return redirect()->route('patient.index')->with('success', 'Patient added successfully.');
    }

    public function update(Request $request, Patient $id)
    {

        $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'admission_no' => 'required|string|max:50',
            'admission_datetime' => 'required|date',
            'room_no' => 'required|string|max:10',
            'station' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'condition' => 'required|string|max:255',
        ]);

        $id->update($request->all());

        return redirect()->route('patient.index')->with('success', 'Patient updated successfully.');
    }

    public function show(Patient $id)
    {

        $patient = $id->with('imagings', 'laboratories', 'histopaths', 'microbiologies', 'specialtests', 'allergies', 'medications')->where('id', $id->id)->first();
        return Inertia::render('Auth/Patient/Show', ['patient' => $patient]);
    }

    public function destroy(Patient $id)
    {
        $id->delete();
        return redirect()->route('patient.index')->with('success', 'Patient deleted successfully.');
    }
}
