<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Diagnosis;
use App\Models\Discharge;
use App\Models\Doctorprogress;
use App\Models\History;
use App\Models\Labdiagnosis;
use DateTime;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\PatientInfo;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'full_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string',
            'gender' => 'nullable|string|max:10',
            'admission_no' => 'nullable|string|max:50',
            'admission_datetime' => 'nullable|date',
            'room_no' => 'nullable|string|max:10',
            'station' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'condition' => 'nullable|string|max:255',
            'chiefComplaint' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
        ]);

        // Calculate age from birth_date
        $birthdate = new DateTime($validatedData['birth_date']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        // Add age to validated data
        $validatedData['age'] = $age;

        // Create the patient record
        $patient = Patient::create($validatedData);
        $patientinfo = new PatientInfo();
        $patientinfo->patient_Id = $patient->id;
        $patientinfo->save();

        $diagnosis = new Diagnosis();
        $diagnosis->patient_Id = $patient->id;
        $diagnosis->save();

        $labDiagnosis = new Labdiagnosis();
        $labDiagnosis->patient_Id = $patient->id;
        $labDiagnosis->save();

        $assessment = new Assessment();
        $assessment->patient_Id = $patient->id;
        $assessment->save();

        $treatment = new Treatment();
        $treatment->patient_Id = $patient->id;
        $treatment->save();

        $history = new History();
        $history->patient_Id = $patient->id;
        $history->save();

        $discharge = new Discharge();
        $discharge->patient_Id = $patient->id;
        $discharge->save();

        $progress = new Doctorprogress();
        $progress->patient_Id = $patient->id;
        $progress->save();




        return redirect()->route('patient.index')->with('success', 'Patient added successfully.');
    }

    public function update(Request $request, Patient $id)
    {

        $validatedData = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string',
            'gender' => 'nullable|string|max:10',
            'admission_no' => 'nullable|string|max:50',
            'admission_datetime' => 'nullable|date',
            'room_no' => 'nullable|string|max:10',
            'station' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'condition' => 'nullable|string|max:255',
            'chiefComplaint' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',

        ]);

        $birthdate = new DateTime($validatedData['birth_date']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        // Add age to validated data
        $validatedData['age'] = $age;


        $id->update($validatedData);

        return redirect()->route('patient.index')->with('success', 'Patient updated successfully.');
    }

    public function show(Patient $id)
    {

        $patient = $id->with('imagings', 'patientinfo','tprs', 'doctorprogress' ,'ios.iostimes' , 'discharge', 'doctororders', 'medications.override', 'history', 'treatment', 'mar.martimes', 'assessment',  'diagnosis', 'labdiagnosis',  'nursenotes',  'laboratories', 'histopaths', 'microbiologies', 'specialtests', 'allergies', 'medications')->where('id', $id->id)->first();
        return Inertia::render('Auth/Patient/Show', ['patient' => $patient]);
    }

    public function destroy(Patient $id)
    {
        $id->delete();
        return redirect()->route('patient.index')->with('success', 'Patient deleted successfully.');
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $patient = Patient::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($patient->image) {
                Storage::disk('public')->delete($patient->image);
            }

            $path = $request->file('image')->store('Patient/Profile', 'public'); // Corrected the second argument
            $patient->image = $path;
            $patient->save();

            return back()->with('success', 'Profile picture updated successfully.');
        }

        return back()->with('error', 'No file was uploaded.');
    }
}
